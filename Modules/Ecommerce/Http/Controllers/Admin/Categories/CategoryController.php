<?php

namespace Modules\Ecommerce\Http\Controllers\Admin\Categories;

use Modules\Ecommerce\Entities\Categories\Repositories\CategoryRepository;
use Modules\Ecommerce\Entities\Categories\Repositories\Interfaces\CategoryRepositoryInterface;
use Modules\Ecommerce\Entities\Categories\Requests\CreateCategoryRequest;
use Modules\Ecommerce\Entities\Categories\Requests\UpdateCategoryRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Generals\Entities\Tools\ToolRepositoryInterface;

class CategoryController extends Controller
{
    private $categoryRepo, $toolsInterface;

    public function __construct(
        CategoryRepositoryInterface $categoryRepository,
        ToolRepositoryInterface $toolRepositoryInterface
    ) {
        // $this->middleware(['permission:categories, guard:employee']);
        $this->categoryRepo   = $categoryRepository;
        $this->toolsInterface = $toolRepositoryInterface;
        $this->module         = 'Categorias Productos';
    }

    public function index()
    {
        return view('ecommerce::admin.categories.list', [
            'categories'    => $this->categoryRepo->rootCategories(),
            'optionsRoutes' =>  config('generals.optionRoutes'),
            'module'        => $this->module
        ]);
    }

    public function create()
    {
        return view('ecommerce::admin.categories.create', [
            'categories'    => $this->categoryRepo->listCategories('name', 'asc'),
            'optionsRoutes' =>  config('generals.optionRoutes'),
            'module'        => $this->module
        ]);
    }

    public function store(CreateCategoryRequest $request)
    {
        $this->categoryRepo->createCategory($request->except('_token', '_method'));

        return redirect()->route('admin.categories.index')
            ->with('message', config('messaging.create'));
    }

    public function show($id)
    {
        $category = $this->categoryRepo->findCategoryById($id);
        $cat      = new CategoryRepository($category);

        return view('ecommerce::admin.categories.show', [
            'category'   => $category,
            'categories' => $category->children,
            'products'   => $cat->findProductsOrder()
        ]);
    }

    public function edit($id)
    {
        return view('ecommerce::admin.categories.edit', [
            'categories' => $this->categoryRepo->listCategories('name', 'asc', $id),
            'category'   => $this->categoryRepo->findCategoryById($id)
        ]);
    }

    public function update(UpdateCategoryRequest $request, $id)
    {
        $update  = new CategoryRepository($this->categoryRepo->findCategoryById($id));
        $update->updateCategory($request->except('_token', '_method'));
        return redirect()->route('admin.categories.edit', $id)->with('message', config('messaging.update'));
    }

    public function destroy(int $id)
    {
        $category = $this->categoryRepo->findCategoryById($id);
        $category->products()->sync([]);
        $category->delete();
        return redirect()->route('admin.categories.index')->with('message', config('messaging.delete'));
    }

    public function removeImage(Request $request)
    {
        $this->toolsInterface->deleteThumbFromServer($request->input('src'));
        $category = $this->categoryRepo->findCategoryById($request->category);
        $category->cover = null;
        $category->save();
        return redirect()->route('admin.categories.edit', $request->input('category'))->with('message', config('messaging.delete'));
    }

    public function updateSortOrder(Request $request, int $id)
    {
        $data = $request->json();
        foreach ($data as $key => $value) {
            $res = $this->categoryRepo->updateSortOrder($value);
        }
        return $res;
    }
}
