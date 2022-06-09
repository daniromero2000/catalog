<?php

namespace Modules\Ecommerce\Http\Controllers\Admin\Attributes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Ecommerce\Entities\Attributes\Exceptions\CreateAttributeErrorException;
use Modules\Ecommerce\Entities\Attributes\Repositories\AttributeRepository;
use Modules\Ecommerce\Entities\Attributes\Repositories\Interfaces\AttributeRepositoryInterface;
use Modules\Ecommerce\Entities\Attributes\Requests\CreateAttributeRequest;
use Modules\Ecommerce\Entities\Attributes\Requests\UpdateAttributeRequest;
use Modules\Ecommerce\Entities\Attributes\UseCases\Interfaces\AttributeUseCaseInterface;
use Modules\Ecommerce\Entities\AttributeValues\Repositories\Interfaces\AttributeValueRepositoryInterface;
use Modules\Generals\Entities\Tools\ToolRepositoryInterface;

class AttributeController extends Controller
{
    private $attributeInterface, $toolsInterface, $attributeServiceInterface;

    public function __construct(
        AttributeRepositoryInterface $attributeRepositoryInterface,
        ToolRepositoryInterface $toolRepositoryInterface,
        AttributeValueRepositoryInterface $attributeValueRepositoryInterface,
        AttributeUseCaseInterface $attributeUseCaseInterface
    ) {
        $this->middleware(['permission:attributes, guard:employee']);
        $this->attributeInterface        = $attributeRepositoryInterface;
        $this->toolsInterface            = $toolRepositoryInterface;
        $this->attributeValuesInterface  = $attributeValueRepositoryInterface;
        $this->attributeServiceInterface = $attributeUseCaseInterface;
        $this->module                    = 'Atributos';
    }

    public function index(Request $request)
    {
        $response = $this->attributeServiceInterface->listAttributes(['search' => $request->input()]);

        if ($response['search']) {
            $request->session()->flash('message', config('messaging.searching'));
        }

        return view('ecommerce::admin.attributes.list', $response['data']);
    }

    public function create()
    {
        return view('ecommerce::admin.attributes.create', $this->attributeServiceInterface->createAttribute());
    }

    public function store(CreateAttributeRequest $request)
    {
        try {
            $this->attributeServiceInterface->storeAttribute($request->except('_token', '_method'));
        } catch (CreateAttributeErrorException $e) {
            return back()
                ->with('error', 'No se pudo crear el Atributo');
        }

        return redirect()->route('admin.attributes.index')
            ->with('message', config('messaging.create'));
    }

    public function show($id)
    {
        $skip                = request()->input('skip') ? request()->input('skip') : 0;
        $skip                = intval($skip);
        $attribute           = $this->attributeInterface->findAttributeById($id);
        $attributeRepository = new AttributeRepository($attribute);
        $paginate            = $this->attributeValuesInterface->countAttributeValues($attribute->id);
        $getPaginate         = $this->toolsInterface->getPaginate($paginate, $skip);

        return view('ecommerce::admin.attributes.show', [
            'attribute'     => $attribute,
            'values'        => $attributeRepository->listAttributeValues($skip * 10),
            'module'        => 'Atributos',
            'optionsRoutes' =>  config('generals.optionRoutes'),
            'skip'          => $skip,
            'paginate'      => $getPaginate['paginate'],
            'position'      => $getPaginate['position'],
            'page'          => $getPaginate['page'],
            'limit'         => $getPaginate['limit']
        ]);
    }

    public function edit($id)
    {
        return redirect()->route('admin.attributes.index')
            ->with('error', config('messaging.not_found'));
    }

    public function update(UpdateAttributeRequest $request, $id)
    {
        $this->attributeServiceInterface->updateAttribute($request->except('_token', '_method'), $id);

        return redirect()->route('admin.attributes.index')
            ->with('message', config('messaging.update'));
    }

    public function destroy($id)
    {
        $this->attributeServiceInterface->destroyAttribute($id);

        return redirect()->route('admin.attributes.index')
            ->with('message', config('messaging.delete'));
    }
}
