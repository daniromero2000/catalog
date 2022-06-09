<?php

namespace Modules\Generals\Http\Controllers\Admin\Countries;

use Modules\Generals\Entities\Countries\Repositories\Interfaces\CountryRepositoryInterface;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Modules\Generals\Entities\Provinces\Repositories\Interfaces\ProvinceRepositoryInterface;
use Modules\Generals\Entities\Tools\ToolRepositoryInterface;

class CountryController extends Controller
{
    private $countryInterface, $toolsInterface, $provincesInterface;

    public function __construct(
        CountryRepositoryInterface $countryRepositoryInterface,
        ProvinceRepositoryInterface $provinceRepositoryInterface,
        ToolRepositoryInterface $toolRepositoryInterface
    ) {
        $this->countryInterface   = $countryRepositoryInterface;
        $this->provincesInterface = $provinceRepositoryInterface;
        $this->toolsInterface     = $toolRepositoryInterface;
    }

    public function index(Request $request)
    {
        $skip = request()->input('skip') ? request()->input('skip') : 0;
        $from = request()->input('from') ? request()->input('from') . " 00:00:01" : Carbon::now()->subMonths(1);
        $to   = request()->input('to') ? request()->input('to') . " 23:59:59" : Carbon::now();

        if (request()->has('q') != '' && (request()->input('from') == '' || request()->input('to') == '')) {
            $list     = $this->countryInterface->searchCountry(request()->input('q'), $skip * 10);
            $paginate = $this->countryInterface->countCountry(request()->input('q'), '');
            $request->session()->flash('message', config('messaging.searching'));
        } else if ((request()->has('t') != '' || request()->input('from') != '' || request()->input('to') != '')) {
            $list     = $this->countryInterface->searchCountry(request()->input('q'), $skip * 10, $from, $to);
            $paginate = $this->countryInterface->countCountry(request()->input('q'), $from, $to);
            $request->session()->flash('message', config('messaging.searching'));
        } else {
            $paginate = $this->countryInterface->countCountry(null);
            $list     = $this->countryInterface->listCountries($skip * 10);
        }

        $getPaginate = $this->toolsInterface->getPaginate($paginate, $skip);

        return view('generals::admin.countries.list', [
            'countries'     => $list,
            'optionsRoutes' =>  config('generals.optionRoutes'),
            'module'        => 'Paises',
            'skip'          => $skip,
            'headers'       => ['Nombre', 'Iso', 'Iso-3', 'Numcode', 'Phone code'],
            'paginate'      => $getPaginate['paginate'],
            'position'      => $getPaginate['position'],
            'page'          => $getPaginate['page'],
            'limit'         => $getPaginate['limit']
        ]);
    }

    public function show(int $id)
    {
        $skip        = request()->input('skip') ? request()->input('skip') : 0;
        $skip        = intval($skip);
        $country     = $this->countryInterface->findCountryById($id);
        $provinces   = $this->provincesInterface->listProvinces($skip * 10);
        $paginate    = $this->provincesInterface->countProvinces($country->id);
        $getPaginate = $this->toolsInterface->getPaginate($paginate, $skip);

        return view('generals::admin.countries.show', [
            'country'       => $country,
            'provinces'     => $provinces,
            'optionsRoutes' =>  config('generals.optionRoutes'),
            'skip'          => $skip,
            'headers'       => ['Iso', 'Iso-3', 'Numcode', 'Phone code'],
            'paginate'      => $getPaginate['paginate'],
            'position'      => $getPaginate['position'],
            'page'          => $getPaginate['page'],
            'limit'         => $getPaginate['limit']
        ]);
    }

    public function getCountry($id)
    {
        if ($id > 0) {
            $provinces = $this->countryInterface->findCountryById($id)->provinces;
            return $this->countryInterface->findCountryById($id)->provinces;
        }
    }
}
