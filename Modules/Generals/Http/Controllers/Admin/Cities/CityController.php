<?php

namespace Modules\Generals\Http\Controllers\Admin\Cities;

use Modules\Generals\Entities\Cities\Repositories\Interfaces\CityRepositoryInterface;
use App\Http\Controllers\Controller;

class CityController extends Controller
{
    public function __construct(
        CityRepositoryInterface $cityRepositoryInterface
    ) {
        $this->cityInterface = $cityRepositoryInterface;
    }
}
