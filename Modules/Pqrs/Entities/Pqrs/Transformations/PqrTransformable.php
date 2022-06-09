<?php

namespace Modules\Pqrs\Entities\Pqrs\Transformations;

use Modules\Pqrs\Entities\Pqrs\Pqr;
use Modules\Generals\Entities\Cities\Repositories\CityRepository;
use Modules\Generals\Entities\Cities\City;

trait PqrTransformable
{
    protected function transformPqr(Pqr $pqr)
    {
        $prop             = new Pqr;
        $prop->id         = (int) $pqr->id;
        $prop->cedula     = $pqr->cedula;
        $prop->name       = $pqr->name;
        $prop->lead       = $pqr->lead;
        $prop->created_at = $pqr->created_at;
        $prop->email      = $pqr->email;
        $prop->phone      = $pqr->phone;
        $prop->pqr        = $pqr->pqr;
        $prop->asunto     = $pqr->asunto;
        $prop->mensaje    = $pqr->mensaje;
        $prop->city       = $pqr->city_id;
        $prop->status     = (int) $pqr->status;
        $prop->status_id  = $pqr->pqrStatus;
        $pqrCityRepo      = new CityRepository(new City());
        $prop->pqr_city   = $pqrCityRepo->findCityById($pqr->city_id);
        return $prop;
    }
}
