<?php

namespace Modules\Ecommerce\Http\Controllers\Admin\Couriers;

use Modules\Ecommerce\Entities\Couriers\Repositories\CourierRepository;
use Modules\Ecommerce\Entities\Couriers\Repositories\Interfaces\CourierRepositoryInterface;
use Modules\Ecommerce\Entities\Couriers\Requests\CreateCourierRequest;
use Modules\Ecommerce\Entities\Couriers\Requests\UpdateCourierRequest;
use App\Http\Controllers\Controller;

class CourierController extends Controller
{
    private $courierRepo;

    public function __construct(CourierRepositoryInterface $courierRepository)
    {
        $this->middleware(['permission:couriers, guard:employee']);
        $this->courierRepo  = $courierRepository;
        $this->module       = 'Transportadoras';
    }

    public function index()
    {
        return view('ecommerce::admin.couriers.list', [
            'couriers'      => $this->courierRepo->listCouriers('name', 'asc'),
            'optionsRoutes' =>  config('generals.optionRoutes'),
            'module'        => $this->module
        ]);
    }

    public function create()
    {
        return view('ecommerce::admin.couriers.create', [
            'optionsRoutes' =>  config('generals.optionRoutes'),
            'module'        => $this->module
        ]);
    }

    public function store(CreateCourierRequest $request)
    {
        $this->courierRepo->createCourier($request->all());
        return redirect()->route('admin.couriers.index')->with('message', config('messaging.create'));
    }

    public function edit(int $id)
    {
        return view('ecommerce::admin.couriers.edit', [
            'courier' => $this->courierRepo->findCourierById($id)
        ]);
    }

    public function update(UpdateCourierRequest $request, $id)
    {
        $update = new CourierRepository($this->courierRepo->findCourierById($id));
        $update->updateCourier($request->all());
        return redirect()->route('admin.couriers.edit', $id)->with('message', config('messaging.update'));
    }

    public function destroy(int $id)
    {
        $courierRepo = new CourierRepository($this->courierRepo->findCourierById($id));
        $courierRepo->delete();
        return redirect()->route('admin.couriers.index')->with('message', config('messaging.delete'));
    }
}
