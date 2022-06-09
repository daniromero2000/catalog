<?php

namespace Modules\Generals\Http\Controllers\Admin\Provinces;

use Modules\Generals\Entities\Provinces\Repositories\Interfaces\ProvinceRepositoryInterface;
use App\Http\Controllers\Controller;
use Modules\Generals\Entities\Cities\Repositories\Interfaces\CityRepositoryInterface;
use Modules\Generals\Entities\Tools\ToolRepositoryInterface;

class ProvinceController extends Controller
{
    protected $provincesInterface, $cityInterface, $toolsInterface;

    public function __construct(
        ProvinceRepositoryInterface $provinceRepositoryInterface,
        CityRepositoryInterface $cityRepositoryInterface,
        ToolRepositoryInterface $toolRepositoryInterface
    ) {
        $this->provincesInterface = $provinceRepositoryInterface;
        $this->cityInterface      = $cityRepositoryInterface;
        $this->toolsInterface     = $toolRepositoryInterface;
    }

    public function show(int $countryId, int $provinceId)
    {
        $skip        = request()->input('skip') ? request()->input('skip') : 0;
        $skip        = intval($skip);
        $province    = $this->provincesInterface->findProvinceById($provinceId);
        $cities      = $this->cityInterface->listCities($provinceId, $skip * 10);
        $paginate    = $this->cityInterface->countCities($provinceId);
        $getPaginate = $this->toolsInterface->getPaginate($paginate, $skip);

        return view('generals::admin.provinces.show', [
            'province'      => $province,
            'countryId'     => $countryId,
            'cities'        => $cities,
            'optionsRoutes' =>  config('generals.optionRoutes'),
            'skip'          => $skip,
            'paginate'      => $getPaginate['paginate'],
            'position'      => $getPaginate['position'],
            'page'          => $getPaginate['page'],
            'limit'         => $getPaginate['limit']
        ]);
    }
    public function getProvince($id)
    {
        if ($id > 0) {
            return $this->cityInterface->findCityByProvince($id);
        }
    }
}
