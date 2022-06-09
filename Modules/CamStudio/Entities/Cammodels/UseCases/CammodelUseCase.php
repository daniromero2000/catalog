<?php

namespace Modules\CamStudio\Entities\Cammodels\UseCases;

use Modules\CamStudio\Entities\Cammodels\Repositories\CammodelRepository;
use Modules\CamStudio\Entities\Cammodels\Repositories\Interfaces\CammodelRepositoryInterface;
use Modules\CamStudio\Entities\Cammodels\UseCases\Interfaces\CammodelUseCaseInterface;
use Modules\Companies\Entities\Employees\Repositories\Interfaces\EmployeeRepositoryInterface;
use Modules\Generals\Entities\Tools\ToolRepositoryInterface;
use Modules\Generals\Entities\Cities\Repositories\Interfaces\CityRepositoryInterface;
use Modules\Generals\Entities\Countries\Repositories\Interfaces\CountryRepositoryInterface;
use Modules\CamStudio\Entities\CammodelCategories\Repositories\Interfaces\CammodelCategoryRepositoryInterface;
use Modules\CamStudio\Entities\CammodelImages\Repositories\Interfaces\CammodelImageRepositoryInterface;
use Modules\CamStudio\Entities\Cammodels\Cammodel;
use Modules\Companies\Entities\Shifts\Repositories\Interfaces\ShiftRepositoryInterface;
use Modules\CamStudio\Entities\SocialStats\Repositories\Interfaces\SocialStatRepositoryInterface;
use Modules\CamStudio\Entities\StreamingStats\Repositories\Interfaces\StreamingStatRepositoryInterface;

class CammodelUseCase implements CammodelUseCaseInterface
{
    private $cammodelRepositoryInterface, $toolsInterface, $employeeInterface;
    private $cammodelCategoryInterf, $cityInterface, $countryInterface, $shiftInterface;
    private $cammmodelImageInterface;

    public function __construct(
        CammodelRepositoryInterface $cammodelRepositoryInterface,
        ToolRepositoryInterface $toolRepositoryInterface,
        EmployeeRepositoryInterface $employeeRepositoryInterface,
        CammodelCategoryRepositoryInterface $cammodelCategoryInterface,
        CityRepositoryInterface $cityRepositoryInterface,
        CountryRepositoryInterface $countryRepositoryInterface,
        ShiftRepositoryInterface $shiftRepositoryInterface,
        SocialStatRepositoryInterface $socialStatRepositoryInterface,
        StreamingStatRepositoryInterface $streamingStatRepositoryInterface,
        CammodelImageRepositoryInterface $cammodelImageImageRepositoryInterface
    ) {
        $this->cammodelRepositoryInterface = $cammodelRepositoryInterface;
        $this->countryInterface            = $countryRepositoryInterface;
        $this->toolsInterface              = $toolRepositoryInterface;
        $this->employeeInterface           = $employeeRepositoryInterface;
        $this->cityInterface               = $cityRepositoryInterface;
        $this->cammodelCategoryInterf      = $cammodelCategoryInterface;
        $this->shiftInterface              = $shiftRepositoryInterface;
        $this->socialStatInterface         = $socialStatRepositoryInterface;
        $this->streamingStatInterface      = $streamingStatRepositoryInterface;
        $this->cammmodelImageInterface     = $cammodelImageImageRepositoryInterface;
        $this->module                      = 'Perfiles Modelos';
    }

    public function listCammodels(array $data): array
    {
        $searchData = $this->toolsInterface->setSearchParametersRefactor($data);
        $searchData['q'] = $searchData['q'] == '' ? null : $searchData['q'];

        if (auth()->guard('employee')->user()->hasRole('studio_admin|studio_manager|subsidiary_supervisor')) {
            $subsidiaryId = auth()->guard('employee')->user()->subsidiary_id;
            $list     = $this->cammodelRepositoryInterface->searchSubsidiaryCammodel($searchData['q'], $subsidiaryId);
        } else {
            $list     = $this->cammodelRepositoryInterface->searchCammodel($searchData['q']);
        }

        return [
            'data' => [
                'cammodels'     => $list,
                'optionsRoutes' => config('generals.optionRoutes'),
                'module'        => $this->module,
                'headers'       => ['NickName', 'Nombre', 'Opciones'],
            ],
            'search'  =>  $searchData['search']
        ];
    }

    public function listInactiveCammodels(array $data): array
    {
        $searchData      = $this->toolsInterface->setSearchParametersRefactor($data);
        $searchData['q'] = $searchData['q'] == '' ? null : $searchData['q'];

        return [
            'data' => [
                'cammodels'     => $this->cammodelRepositoryInterface->searchCammodel($searchData['q'], 0),
                'optionsRoutes' => config('generals.optionRoutes'),
                'module'        => 'Perfiles Modelos Inactivas',
                'headers'       => ['NickName', 'Nombre', 'Opciones'],
            ],
            'search'  =>  $searchData['search']
        ];
    }

    public function createCammodel(): array
    {
        return [
            'model_employees' => $this->employeeInterface->getAllEmployeesModel(),
            'optionsRoutes'   => config('generals.optionRoutes'),
            'module'          => $this->module
        ];
    }

    public function storeCammodel(array $requestData): Cammodel
    {
        return $this->cammodelRepositoryInterface->createCammodel($requestData);
    }

    public function showCammodel(int $cammodelId): array
    {
        $cammodel = $this->getCammodel($cammodelId);

        return  [
            'cammodel'        => $cammodel,
            'projectUrl'      => config('app.url'),
            'images'          => $cammodel->images()->get(['src']),
            'shifts'          => $this->shiftInterface->getAllShiftNames(),
            'cities'          => $this->cityInterface->getAllCityNames(),
            'countries'       => $this->countryInterface->getAllCountriesNames(),
            'categories'      => $this->cammodelCategoryInterf->findCammodelCategories('name', 'asc')->toTree(),
            'selectedIds'     => $cammodel->categories()->pluck('cammodel_category_id')->all(),
            'bannedCountries' => $cammodel->cammodelBannedCountries
        ];
    }

    public function updateCammodel($request, int $cammodelId): bool
    {
        $data = $request->except(
            'categories',
            'selected',
            'verifyPass',
            'passStreaming',
            '_token',
            '_method',
        );

        $cammodel     = $this->getCammodel($cammodelId);
        $cammodelRepo = new CammodelRepository($cammodel);
        $data['slug'] = $this->setCammodelSlug($request, $cammodel->nickname);
        $data         = $this->saveCammodelImages($request, $cammodel, $cammodelRepo, $data);
        $this->setCammodelCategories($request, $cammodelRepo);
        return $cammodelRepo->updateCammodel($data);
    }

    private function setCammodelSlug($request, string $cammodelNickanme): string
    {
        if ($request->input('nickname')) {
            return str_slug($request->input('nickname'));
        } else {
            return str_slug($cammodelNickanme);
        }
    }

    private function saveCammodelImages($request, $cammodel, $cammodelRepo, $data): array
    {
        if ($request->hasFile('cover_page')) {
            if ($cammodel->cover_page) {
                $this->toolsInterface->deleteThumbFromServer($cammodel->cover_page);
            }
            $data['cover_page'] = $cammodelRepo->saveCoverPageImage($request->file('cover_page'), $cammodel->slug);
        }

        if ($request->hasFile('cover')) {
            if ($cammodel->cover) {
                $this->toolsInterface->deleteThumbFromServer($cammodel->cover);
            }
            $data['cover'] = $cammodelRepo->saveCoverPageImage($request->file('cover'), $cammodel->slug);
        }

        if ($request->hasFile('image')) {
            $cammodelRepo->saveCammodelImages(collect($request->file('image')), $cammodel->slug);
        }

        if ($request->hasFile('image_tks')) {
            if ($cammodel->image_tks) {
                $this->toolsInterface->deleteThumbFromServer($cammodel->image_tks);
            }
            $data['image_tks'] = $cammodelRepo->saveCoverPageImage($request->file('image_tks'), $cammodel->slug);
        }

        return $data;
    }

    private function setCammodelCategories($request, $cammodelRepo)
    {
        if ($request->has('categories')) {
            $cammodelRepo->syncCategories($request->input('categories'));
        } else {
            $cammodelRepo->detachCategories();
        }
    }

    public function setCammodelTippers($tippers, int $cammodelId)
    {
        $cammodelRepo = $this->getCammodelRepository($cammodelId);

        if ($tippers) {
            $cammodelRepo->syncTippers($tippers);
        }
    }

    public function removeCamModelThumbnail(string $src): bool
    {
        $this->toolsInterface->deleteThumbFromServer($src);
        return $this->cammmodelImageInterface->deleteThumb($src);
    }

    public function getCammodelProfile(): int
    {
        return auth()->guard('employee')->user()->cammodels->id;
    }

    public function deactivateCammodel(int $cammodelId, int $activate)
    {
        $cammodel = $this->getCammodel($cammodelId);
        $cammodel->is_active = $activate;
        $cammodel->save();
        $cammodel->employee->is_active = $activate;
        $cammodel->employee->save();
        if ($activate == 1) {
            foreach ($cammodel->cammodelInactiveStreamAccounts as $streamAccount) {
                $streamAccount->is_active = $activate;
                $streamAccount->save();
            }
        } else {
            foreach ($cammodel->cammodelStreamAccounts as $streamAccount) {
                $streamAccount->is_active = $activate;
                $streamAccount->save();
            }
        }
        foreach ($cammodel->cammodelSocialMedia as $socialAccount) {
            $socialAccount->is_active = $activate;
            $socialAccount->save();
        }
    }

    public function getCammodelNames(array $filterData)
    {
        if (auth()->guard('employee')->user()->hasRole('studio_admin|studio_manager|operative_leader_aux|partner|subsidiary_supervisor')) {
            return $this->cammodelRepositoryInterface->getSubsidiaryCammodelNames(auth()->guard('employee')->user()->subsidiary_id);
        }
        if ($filterData['subsidiary_id'] != null) {
            return $this->cammodelRepositoryInterface->getSubsidiaryCammodelNames($filterData['subsidiary_id']);
        }

        return $this->cammodelRepositoryInterface->getAllCammodelNames();
    }

    public function destroyCammodel(int $cammodelId): bool
    {
        return $this->getCammodelRepository($cammodelId)->deleteCammodel();
    }

    private function getCammodelRepository(int $cammodelId): CammodelRepository
    {
        return new CammodelRepository($this->getCammodel($cammodelId));
    }

    private function getCammodel(int $cammodelId): Cammodel
    {
        return $this->cammodelRepositoryInterface->findCammodelById($cammodelId);
    }
}
