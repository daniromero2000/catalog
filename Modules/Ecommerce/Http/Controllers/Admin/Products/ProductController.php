<?php

namespace Modules\Ecommerce\Http\Controllers\Admin\Products;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Ecommerce\Entities\Products\Product;
use Modules\Generals\Entities\Tools\UploadableTrait;
use Modules\Generals\Entities\Tools\ToolRepositoryInterface;
use Modules\Ecommerce\Entities\ProductAttributes\ProductAttribute;
use Modules\Ecommerce\Entities\Products\Requests\CreateProductRequest;
use Modules\Ecommerce\Entities\Products\Repositories\ProductRepository;
use Modules\Ecommerce\Entities\Products\Transformations\ProductTransformable;
use Modules\Ecommerce\Entities\Attributes\Repositories\Interfaces\AttributeRepositoryInterface;
use Modules\Ecommerce\Entities\Brands\Repositories\Interfaces\BrandRepositoryInterface;
use Modules\Ecommerce\Entities\Products\Repositories\Interfaces\ProductRepositoryInterface;
use Modules\Ecommerce\Entities\AttributeValues\Repositories\Interfaces\AttributeValueRepositoryInterface;
use Modules\Ecommerce\Entities\Categories\Repositories\Interfaces\CategoryRepositoryInterface;
use Modules\Ecommerce\Entities\ProductGroups\Repositories\Interfaces\ProductGroupRepositoryInterface;
use Modules\Ecommerce\Entities\ProductAttributes\Repositories\ProductAttributeRepositoryInterface;
use Modules\Ecommerce\Entities\Products\Exports\ExportProductAttributes;
use Modules\Ecommerce\Entities\Products\Exports\ExportProducts;
use Modules\Ecommerce\Entities\Products\Imports\ImportProductAttributes;
use Modules\Ecommerce\Entities\Products\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    use ProductTransformable, UploadableTrait;
    private $productRepo, $categoryRepo, $attributeRepo, $attributeValueRepository;
    private $productAttribute, $brandRepo, $productGroupInterface, $productAttributeInterface;
    private $toolsInterface;

    public function __construct(
        ProductAttribute $productAttribute,
        BrandRepositoryInterface $brandRepository,
        ProductRepositoryInterface $productRepository,
        CategoryRepositoryInterface $categoryRepository,
        ToolRepositoryInterface $toolRepositoryInterface,
        AttributeRepositoryInterface $attributeRepository,
        AttributeValueRepositoryInterface $attributeValueRepository,
        ProductGroupRepositoryInterface $productGroupRepositoryInterface,
        ProductAttributeRepositoryInterface $productAttributeRepositoryInterface
    ) {
        $this->middleware(['permission:products, guard:employee']);
        $this->brandRepo                 = $brandRepository;
        $this->productAttribute          = $productAttribute;
        $this->productRepo               = $productRepository;
        $this->categoryRepo              = $categoryRepository;
        $this->attributeRepo             = $attributeRepository;
        $this->toolsInterface            = $toolRepositoryInterface;
        $this->attributeValueRepository  = $attributeValueRepository;
        $this->productGroupInterface     = $productGroupRepositoryInterface;
        $this->productAttributeInterface = $productAttributeRepositoryInterface;
        $this->module                    = 'Productos';
    }

    public function index(Request $request)
    {
        $skip = request()->input('skip') ? request()->input('skip') : 0;
        $from = request()->input('from') ? request()->input('from') . " 00:00:01" : Carbon::now()->subMonths(1);
        $to   = request()->input('to') ? request()->input('to') . " 23:59:59" : Carbon::now();

        if (request()->input('q') != '' && (request()->input('from') == '' || request()->input('to') == '')) {
            $list     = $this->productRepo->searchProduct(request()->input('q'), $skip * 10);
            $paginate = $this->productRepo->countProduct(request()->input('q'), '');
            $request->session()->flash('message', config('messaging.searching'));
        } elseif ((request()->input('q') != '' || request()->input('from') != '' || request()->input('to') != '')) {
            $list     = $this->productRepo->searchProduct(request()->input('q'), $skip * 10, $from, $to);
            $paginate = $this->productRepo->countProduct(request()->input('q'), $from, $to);
            $request->session()->flash('message', config('messaging.searching'));
        } else {
            $paginate = $this->productRepo->countProduct(null);
            $list     = $this->productRepo->listProducts($skip * 10);
        }

        $getPaginate = $this->toolsInterface->getPaginate($paginate, $skip);

        $products = $list->map(function (Product $item) {
            return $this->transformProduct($item);
        })->all();

        return view('ecommerce::admin.products.list', [
            'products'      => $products,
            'optionsRoutes' =>  config('generals.optionRoutes'),
            'module'        => $this->module,
            'skip'          => $skip,
            'paginate'      => $getPaginate['paginate'],
            'position'      => $getPaginate['position'],
            'page'          => $getPaginate['page'],
            'limit'         => $getPaginate['limit']
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
            return redirect()->route('admin.products.edit', [$product->id]);
        }

        return view('ecommerce::admin.products.edit', [
            'qty'               => $qty,
            'brands'            => $this->brandRepo->listBrands(['*'], 'name', 'asc'),
            'weight'            => $product->weight,
            'images'            => $product->images()->get(['src']),
            'product'           => $product,
            'categories'        => $this->categoryRepo->listCategories('name', 'asc')->toTree(),
            'attributes'        => $this->attributeRepo->listAttributeNames(),
            'selectedIds'       => $product->categories()->pluck('category_id')->all(),
            'weight_units'      => Product::MASS_UNIT,
            'default_weight'    => $product->mass_unit,
            'product_groups'    => $this->productGroupInterface->listproductGroups(),
            'selectedGroupIds'  => $product->productGroups()->pluck('product_group_id')->all(),
            'productAttributes' => $productAttributes
        ]);
    }

    public function update(UpdateProductRequest $request, int $id)
    {
        $product = $this->productRepo->findProductById($id);
        $productRepo = new ProductRepository($product);

        if ($request->has('attributeValue')) {
            $this->saveProductCombinations($request, $product);
            return redirect()->route('admin.products.edit', [$id])
                ->with('message', config('messaging.create'));
        }

        if ($request->has('attributeId')) {
            $this->updateProductCombinations($request, $product);
            return redirect()->route('admin.products.edit', [$id])
                ->with('message', config('messaging.update'));
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
            'combination',
            'pAQuantity',
            'pAPrice',
            'pASalePrice',
            'attributeId',
            'attribute',
            'salePrice'
        );

        $data['slug'] = str_slug($request->input('name'));

        if ($request->hasFile('cover')) {
            if ($product->coverNoPath) {
                $this->toolsInterface->deleteThumbFromServer($product->coverNoPath);
            }
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
        $this->toolsInterface->deleteThumbFromServer($request->input('src'));
        $this->productRepo->deleteThumb($request->input('src'));
        return back()->with('message', config('messaging.delete'));
    }

    private function saveProductCombinations(Request $request, Product $product): bool
    {
        $fields = $request->only(
            'productAttributeQuantity',
            'productAttributePrice',
            'default'
        );
        $fields += ['sale_price'  => $request['salePrice']];

        if ($errors = $this->validateFields($fields)) {
            return redirect()->route('admin.products.edit', [$product->id])
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

    private function updateProductCombinations(Request $request, Product $product): bool
    {
        $fields = $request->only(
            'pAQuantity',
            'pAPrice',
            'pASalePrice',
            'attributeId',
            'pAattribute',
            'pAattributeValue'
        );

        $productAttribute = $this->productAttributeInterface->findProductAttributeById($fields['attributeId']);

        if ($request->has('pAattribute')) {
            $attributeValues = $fields['pAattributeValue'];
            $productAttribute->attributesValues()->detach();
            collect($attributeValues)->each(function ($attributeValueId) use ($productAttribute) {
                $attribute = $this->attributeValueRepository->find($attributeValueId);
                return $this->productRepo->saveCombination($productAttribute, $attribute);
            })->count();
        }

        if ($errors = $this->validateUpdateFields($fields)) {
            return redirect()->route('admin.products.edit', [$product->id])
                ->withErrors($errors);
        }

        $productAttribute->quantity = $fields['pAQuantity'];
        $productAttribute->price = $fields['pAPrice'];
        $productAttribute->sale_price = $fields['pASalePrice'];
        $productAttribute->update();
        return  true;
    }

    private function validateUpdateFields(array $data)
    {
        $validator = Validator::make($data, [
            'pAQuantity' => 'required'
        ]);

        if ($validator->fails()) {
            return $validator;
        }
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

    public function duplicateProduct(Request $request)
    {
        $newProduct = $this->productRepo->duplicateProduct($request->input('id'));

        return redirect()->route('admin.products.edit', [$newProduct->id])
            ->with('message', 'Producto Clonado Exitosamente');
    }

    public function updateSortOrder(Request $request, int $id)
    {
        $data = $request->json();
        foreach ($data as $key => $value) {
            $res = $this->productRepo->updateSortOrder($value);
        }
        return $res;
    }

    public function exportProducts()
    {
        return Excel::download(new ExportProductAttributes(), 'products.xlsx');
    }

    public function importProducts(Request $request)
    {
        if ($request->hasFile('cover')) {

            Excel::import(new ImportProductAttributes, $request->file('cover'));
        }

        return back()->with('message', 'Datos Cargados Satisfactoriamente!');
    }
}
