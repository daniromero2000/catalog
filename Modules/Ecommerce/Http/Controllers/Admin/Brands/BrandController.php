<?php

namespace Modules\Ecommerce\Http\Controllers\Admin\Brands;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Modules\Ecommerce\Entities\Brands\Repositories\BrandRepository;
use Modules\Ecommerce\Entities\Brands\Repositories\Interfaces\BrandRepositoryInterface;
use Modules\Ecommerce\Entities\Brands\Requests\CreateBrandRequest;
use Modules\Ecommerce\Entities\Brands\Requests\UpdateBrandRequest;
use Modules\Generals\Entities\Tools\ToolRepositoryInterface;

class BrandController extends Controller
{
    private $brandInterface, $toolsInterface;

    public function __construct(
        BrandRepositoryInterface $brandRepository,
        ToolRepositoryInterface $toolRepositoryInterface
    ) {
        $this->middleware(['permission:brands, guard:employee']);
        $this->brandInterface = $brandRepository;
        $this->toolsInterface = $toolRepositoryInterface;
        $this->module         = 'Marcas';
    }

    public function index(Request $request)
    {
        $skip = request()->input('skip') ? request()->input('skip') : 0;
        $from = request()->input('from') ? request()->input('from') . " 00:00:01" : Carbon::now()->subMonths(1);
        $to   = request()->input('to') ? request()->input('to') . " 23:59:59" : Carbon::now();

        if (request()->has('q') != '' && (request()->input('from') == '' || request()->input('to') == '')) {
            $list     = $this->brandInterface->searchBrands(request()->input('q'), $skip * 10);
            $paginate = $this->brandInterface->countBrands(request()->input('q'), '');
            $request->session()->flash('message', config('messaging.searching'));
        } else if ((request()->has('t') != '' || request()->input('from') != '' || request()->input('to') != '')) {
            $list     = $this->brandInterface->searchBrands(request()->input('q'), $skip * 10, $from, $to);
            $paginate = $this->brandInterface->countBrands(request()->input('q'), $from, $to);
            $request->session()->flash('message', config('messaging.searching'));
        } else {
            $paginate = $this->brandInterface->countBrands(null);
            $list     = $this->brandInterface->list($skip * 10);
        }

        $getPaginate = $this->toolsInterface->getPaginate($paginate, $skip);

        return view('ecommerce::admin.brands.list', [
            'brands'        => $list,
            'optionsRoutes' =>  config('generals.optionRoutes'),
            'module'        => $this->module,
            'skip'          => $skip,
            'headers'       => ['Nombre', 'Estado', 'Logo', 'Opciones'],
            'paginate'      => $getPaginate['paginate'],
            'position'      => $getPaginate['position'],
            'page'          => $getPaginate['page'],
            'limit'         => $getPaginate['limit']
        ]);
    }

    public function create()
    {
        return view('ecommerce::admin.brands.create', [
            'optionsRoutes' =>  config('generals.optionRoutes'),
            'module'        => $this->module
        ]);
    }

    public function store(CreateBrandRequest $request)
    {
        $this->brandInterface->createBrand($request->all());

        return redirect()->route('admin.brands.index')
            ->with('message', config('messaging.create'));
    }

    public function edit($id)
    {
        return view('ecommerce::admin.brands.edit', [
            'brand' => $this->brandInterface->findBrandById($id)
        ]);
    }

    public function update(UpdateBrandRequest $request, $id)
    {
        $brand = $this->brandInterface->findBrandById($id);

        $requestData = $request->except(
            '_token',
            '_method',
        );

        $brandRepository = new BrandRepository($brand);

        if ($request->hasFile('logo')) {
            if ($brand->logo) {
                $this->toolsInterface->deleteThumbFromServer($brand->logo);
            }
            $requestData['logo'] = $brandRepository->saveBrandLogo($request->file('logo'), $brand->name);
        }

        $brandRepository->updateBrand($requestData);
        return back()->with('message', config('messaging.update'));
    }

    public function destroy($id)
    {
        $brandRepository = new BrandRepository($this->brandInterface->findBrandById($id));
        $brandRepository->dissociateProducts();
        $brandRepository->deleteBrand();

        return redirect()->route('admin.brands.index')
            ->with('message', config('messaging.delete'));
    }
}
