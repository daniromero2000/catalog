<?php

namespace Modules\Ecommerce\Http\Controllers\Admin\AttributeValues;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Ecommerce\Entities\AttributeValues\Requests\UpdateAttributeValueRequest;
use Modules\Ecommerce\Entities\AttributeValues\Requests\CreateAttributeValueRequest;
use Modules\Ecommerce\Entities\AttributeValues\UseCases\Interfaces\AttributeValueUseCaseInterface;

class AttributeValueController extends Controller
{
    private $attributeValueServiceInterface;

    public function __construct(
        AttributeValueUseCaseInterface $attributeValueUseCaseInterface
    ) {
        $this->middleware(['permission:attributes, guard:employee']);
        $this->attributeValueServiceInterface = $attributeValueUseCaseInterface;
    }

    public function index(Request $request)
    {
        return redirect()->route('admin.attributes.index')
            ->with('error', config('messaging.not_found'));
    }

    public function create()
    {
        return redirect()->route('admin.attributes.index')
            ->with('error', config('messaging.not_found'));
    }

    public function store(CreateAttributeValueRequest $request)
    {
        $this->attributeValueServiceInterface->storeAttributeValue($request->except('_token', '_method'));
        return back()->with('message', config('messaging.create'));
    }

    public function show(int $id)
    {
        return redirect()->route('admin.attributes.index')
            ->with('error', config('messaging.not_found'));
    }

    public function update(UpdateAttributeValueRequest $request, int $id)
    {
        $this->attributeValueServiceInterface->updateAttributeValue($request->except('_token', '_method'), $id);
        return back()->with('message', config('messaging.update'));
    }

    public function destroy(int $id)
    {
        $this->attributeValueServiceInterface->destroyAttributeValue($id);
        return back()->with('message', config('messaging.delete'));
    }
}
