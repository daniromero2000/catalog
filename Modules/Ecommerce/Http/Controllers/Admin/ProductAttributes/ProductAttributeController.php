<?php

namespace Modules\Ecommerce\Http\Controllers\Admin\ProductAttributes;

use Modules\Ecommerce\Entities\Attributes\Repositories\Interfaces\AttributeRepositoryInterface;
use Modules\Ecommerce\Entities\AttributeValues\Repositories\Interfaces\AttributeValueRepositoryInterface;
use Modules\Ecommerce\Entities\Brands\Repositories\Interfaces\BrandRepositoryInterface;
use Modules\Ecommerce\Entities\Categories\Repositories\Interfaces\CategoryRepositoryInterface;
use Modules\Ecommerce\Entities\ProductAttributes\ProductAttribute;
use Modules\Ecommerce\Entities\Products\Product;
use Modules\Ecommerce\Entities\Products\Repositories\Interfaces\ProductRepositoryInterface;
use Modules\Ecommerce\Entities\Products\Repositories\ProductRepository;
use Modules\Ecommerce\Entities\Products\Requests\CreateProductRequest;
use Modules\Ecommerce\Entities\Products\Requests\UpdateProductRequest;
use App\Http\Controllers\Controller;
use Modules\Ecommerce\Entities\Products\Transformations\ProductTransformable;
use Modules\Generals\Entities\Tools\UploadableTrait;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Modules\Ecommerce\Entities\ProductGroups\Repositories\Interfaces\ProductGroupRepositoryInterface;

class ProductAttributeController extends Controller
{
    use ProductTransformable, UploadableTrait;
    private $productRepo, $categoryRepo, $attributeRepo, $attributeValueRepository;
    private $productAttribute, $brandRepo, $productGroupInterface;

    public function __construct(
        ProductRepositoryInterface $productRepository,
        CategoryRepositoryInterface $categoryRepository,
        AttributeRepositoryInterface $attributeRepository,
        AttributeValueRepositoryInterface $attributeValueRepository,
        ProductAttribute $productAttribute,
        BrandRepositoryInterface $brandRepository,
        ProductGroupRepositoryInterface $productGroupRepositoryInterface
    ) {
        $this->middleware(['permission:products, guard:employee']);
        $this->productRepo              = $productRepository;
        $this->categoryRepo             = $categoryRepository;
        $this->attributeRepo            = $attributeRepository;
        $this->attributeValueRepository = $attributeValueRepository;
        $this->productAttribute         = $productAttribute;
        $this->brandRepo                = $brandRepository;
        $this->productGroupInterface    = $productGroupRepositoryInterface;
        $this->module                   = 'Atributos de producto';
    }

    public function index()
    {
        if (request()->has('q') && request()->input('q') != '') {
            $list = $this->productRepo->searchProduct(request()->input('q'));
        } else {
            $list = $this->productRepo->listProducts('id');
        }

        $products = $list->map(function (Product $item) {
            return $this->transformProduct($item);
        })->all();

        return view('ecommerce::admin.products.list', [
            'products' => $products
        ]);
    }

    public function create()
    {
        return view('ecommerce::admin.products.create', [
            'optionsRoutes'  =>  config('generals.optionRoutes'),
            'module'         => $this->module,
            'categories'     => $this->categoryRepo->listCategories('name', 'asc'),
            'brands'         => $this->brandRepo->listBrands(['*'], 'name', 'asc'),
            'default_weight' => env('SHOP_WEIGHT'),
            'weight_units'   => Product::MASS_UNIT,
            'product'        => new Product
        ]);
    }

    public function store(CreateProductRequest $request)
    {
        $data = $request->except('_token', '_method');
        $data['slug'] = str_slug($request->input('name'));
        $data['company_id'] = auth()->guard('employee')->user()->company_id;
        $data['tax_id'] = 1;

        if ($request->hasFile('cover') && $request->file('cover') instanceof UploadedFile) {
            $data['cover'] = $this->productRepo->saveCoverImage($request->file('cover'));
        }
        $data['company_id'] = 1;

        $product = $this->productRepo->createProduct($data);
        $productRepo = new ProductRepository($product);

        if ($request->hasFile('image')) {
            $productRepo->saveProductImages(collect($request->file('image')));
        }

        if ($request->has('categories')) {
            $productRepo->syncCategories($request->input('categories'));
        } else {
            $productRepo->detachCategories();
        }

        return redirect()->route('admin.products.edit', $product->id)
            ->with('message', config('messaging.create'));
    }

    public function show(int $id)
    {
        return view('ecommerce::admin.products.show', [
            'product' =>  $this->productRepo->findProductById($id)
        ]);
    }

    public function edit(int $id)
    {
        $product = $this->productRepo->findProductById($id);
        $productAttributes = $product->attributes()->get();

        $qty = $productAttributes->map(function ($item) {
            return $item->quantity;
        })->sum();

        if (request()->has('delete') && request()->has('pa')) {
            $pa = $productAttributes->where('id', request()->input('pa'))->first();
            $pa->attributesValues()->detach();
            $pa->delete();

            request()->session()->flash('message', 'Delete successful');
            return redirect()->route('admin.products.edit', [$product->id, 'combination' => 1]);
        }

        return view('ecommerce::admin.products.edit', [
            'product' => $product,
            'images' => $product->images()->get(['src']),
            'categories' => $this->categoryRepo->listCategories('name', 'asc')->toTree(),
            'product_groups' => $this->productGroupInterface->listproductGroups(),
            'selectedIds' => $product->categories()->pluck('category_id')->all(),
            'selectedGroupIds' => $product->productGroups()->pluck('product_group_id')->all(),
            'attributes' => $this->attributeRepo->listAttributeNames(),
            'productAttributes' => $productAttributes,
            'qty' => $qty,
            'brands' => $this->brandRepo->listBrands(['*'], 'name', 'asc'),
            'weight' => $product->weight,
            'default_weight' => $product->mass_unit,
            'weight_units' => Product::MASS_UNIT
        ]);
    }

    public function update(UpdateProductRequest $request, int $id)
    {
        $product = $this->productRepo->findProductById($id);
        $productRepo = new ProductRepository($product);

        if ($request->has('attributeValue')) {
            $this->saveProductCombinations($request, $product);
            return redirect()->route('admin.products.edit', [$id, 'combination' => 1])
                ->with('message', config('messaging.create'));
        }

        $data = $request->except(
            'categories',
            'product_groups',
            '_token',
            '_method',
            'default',
            'image',
            'productAttributeQuantity',
            'productAttributePrice',
            'attributeValue',
            'combination'
        );

        $data['slug'] = str_slug($request->input('name'));

        if ($request->hasFile('cover')) {
            $data['cover'] = $productRepo->saveCoverImage($request->file('cover'));
        }

        if ($request->hasFile('image')) {
            $productRepo->saveProductImages(collect($request->file('image')));
        }

        if ($request->has('categories')) {

            $productRepo->syncCategories($request->input('categories'));
        } else {

            $productRepo->detachCategories();
        }

        if ($request->has('product_groups')) {
            $productRepo->syncProducGroups($request->input('product_groups'));
        } else {
            $productRepo->detachProductGroup();
        }

        $productRepo->updateProduct($data);

        return redirect()->route('admin.products.edit', $id)
            ->with('message', config('messaging.update'));
    }

    public function destroy($id)
    {
        $product = $this->productRepo->findProductById($id);
        $product->categories()->sync([]);
        $productAttr = $product->attributes();

        $productAttr->each(function ($pa) {
            DB::table('attribute_value_product_attribute')->where('product_attribute_id', $pa->id)->delete();
        });

        $productAttr->where('product_id', $product->id)->delete();

        $productRepo = new ProductRepository($product);
        $productRepo->removeProduct();

        return redirect()->route('admin.products.index')
            ->with('message', config('messaging.delete'));
    }

    public function removeImage(Request $request)
    {
        $this->productRepo->deleteFile($request->only('product', 'image'), 'uploads');
        return back()->with('message', config('messaging.delete'));
    }

    public function removeThumbnail(Request $request)
    {
        $this->productRepo->deleteThumb($request->input('src'));
        return back()->with('message', config('messaging.delete'));
    }

    private function saveProductCombinations(Request $request, Product $product): bool
    {
        $fields = $request->only(
            'productAttributeQuantity',
            'productAttributePrice',
            'sale_price',
            'default'
        );

        if ($errors = $this->validateFields($fields)) {
            return redirect()->route('admin.products.edit', [$product->id, 'combination' => 1])
                ->withErrors($errors);
        }

        $quantity = $fields['productAttributeQuantity'];
        $price = $fields['productAttributePrice'];

        $sale_price = null;
        if (isset($fields['sale_price'])) {
            $sale_price = $fields['sale_price'];
        }

        $attributeValues = $request->input('attributeValue');
        $productRepo = new ProductRepository($product);

        $hasDefault = $productRepo->listProductAttributes()->where('default', 1)->count();

        $default = 0;
        if ($request->has('default')) {
            $default = $fields['default'];
        }

        if ($default == 1 && $hasDefault > 0) {
            $default = 0;
        }

        $productAttribute = $productRepo->saveProductAttributes(
            new ProductAttribute(compact('quantity', 'price', 'sale_price', 'default'))
        );

        if ($request->hasFile('image')) {
            $productRepo->saveAttributeProductImages(collect($request->file('image')), $productAttribute->id);
        }

        // save the combinations
        return collect($attributeValues)->each(function ($attributeValueId) use ($productRepo, $productAttribute) {
            $attribute = $this->attributeValueRepository->find($attributeValueId);
            return $productRepo->saveCombination($productAttribute, $attribute);
        })->count();
    }


    private function validateFields(array $data)
    {
        $validator = Validator::make($data, [
            'productAttributeQuantity' => 'required'
        ]);

        if ($validator->fails()) {
            return $validator;
        }
    }
}
