<?php

namespace Modules\CamStudio\Entities\CammodelBannedCountries\Repositories;

use Illuminate\Database\QueryException;
use Illuminate\Pagination\LengthAwarePaginator;
use Modules\CamStudio\Entities\CammodelBannedCountries\CammodelBannedCountry;
use Modules\CamStudio\Entities\CammodelBannedCountries\Repositories\Interfaces\CammodelBannedCountryRepositoryInterface;
use Modules\CamStudio\Entities\CammodelBannedCountries\Exceptions\CreateCammodelBannedCountryErrorException;

class CammodelBannedCountryRepository implements CammodelBannedCountryRepositoryInterface
{
    protected $model;
    private $columns = ['id', 'country_id', 'cammodel_id'];

    public function __construct(CammodelBannedCountry $cammodelBannedCountry)
    {
        $this->model = $cammodelBannedCountry;
    }

    public function createCammodelBannedCountry(array $data): CammodelBannedCountry
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new CreateCammodelBannedCountryErrorException($e->getMessage());
        }
    }

    public function searchCammodelBannedCountries(string $text = null, int $subsidiaryId = null): LengthAwarePaginator
    {
        if (is_null($text)) {
            return $this->listCammodelBannedCountries($subsidiaryId);
        } else {
            return $this->model->searchCammodelBannedCountries($text)
                ->with(['cammodel', 'country'])
                ->whereHas('cammodel', function ($q) use ($subsidiaryId) {
                    if ($subsidiaryId != null) {
                        $q->whereHas('employee', function ($k) use ($subsidiaryId) {
                            $k->where('subsidiary_id', $subsidiaryId);
                        });
                    }
                })->select($this->columns)->paginate(10);
        }
    }

    private function listCammodelBannedCountries(int $subsidiaryId = null): LengthAwarePaginator
    {
        return  $this->model->select($this->columns)
            ->with(['cammodel', 'country'])
            ->whereHas('cammodel', function ($q) use ($subsidiaryId) {
                if ($subsidiaryId != null) {
                    $q->whereHas('employee', function ($k) use ($subsidiaryId) {
                        $k->where('subsidiary_id', $subsidiaryId);
                    });
                }
            })->paginate(10);
    }
}
