<?php

namespace Modules\CamStudio\Http\Controllers\Admin\CammodelCategories;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\CamStudio\Entities\CammodelCategories\Repositories\CammodelCategoryRepository;
use Modules\CamStudio\Entities\CammodelCategories\Repositories\Interfaces\CammodelCategoryRepositoryInterface;
use Modules\CamStudio\Entities\CammodelCategories\UseCases\Interfaces\CammodelCategoryUseCaseInterface;

class CammodelCategoriesController extends Controller
{
    private $cammodelCategoryInterf, $cammodelCategoryServiceInterface;

    public function __construct(
        CammodelCategoryUseCaseInterface $cammodelCategoryUseCaseInterface,
        CammodelCategoryRepositoryInterface $cammodelCategoryInterface
    ) {
        $this->cammodelCategoryServiceInterface = $cammodelCategoryUseCaseInterface;
        $this->cammodelCategoryInterf  = $cammodelCategoryInterface;
    }

    public function index(Request $request): View
    {
        $response = $this->cammodelCategoryServiceInterface->listCammodelCategories(['search' => $request->input()]);

        if ($response['search']) {
            $request->session()->flash('message', config('messaging.searching'));
        }

        return view('camstudio::admin.cammodel-categories.list', $response['data']);
    }

    public function create(): View
    {
        return view('camstudio::admin.cammodel-categories.create', $this->cammodelCategoryServiceInterface->createCammodelCategory());
    }

    public function store(Request $request)
    {
        $this->cammodelCategoryInterf->createCammodelCategory($request->except('_token', '_method'));

        return redirect()->route('admin.cammodel-categories.index')
            ->with('message', config('messaging.create'));
    }

    public function show($id): View
    {
        $category = $this->cammodelCategoryInterf->findCammodelCategoryById($id);

        return view('camstudio::admin.cammodel-categories.show', [
            'category'   => $category,
            'categories' => $category->children,
            'models'     => (new CammodelCategoryRepository($category))->findCammodelOrder()
        ]);
    }

    public function edit($id): View
    {
        return view('camstudio::admin.cammodel-categories.edit', [
            'categories' => $this->cammodelCategoryInterf->findCammodelCategories('name', 'asc', $id),
            'category'   => $this->cammodelCategoryInterf->findCammodelCategoryById($id)
        ]);
    }

    public function update(Request $request, $id)
    {
        $update   = new CammodelCategoryRepository($this->cammodelCategoryInterf->findCammodelCategoryById($id));
        $update->updateCammodelCategory($request->except('_token', '_method'));
        return redirect()->route('admin.cammodel-categories.edit', $id)->with('message', config('messaging.update'));
    }

    public function destroy(int $id)
    {
        $category = $this->cammodelCategoryInterf->findCammodelCategoryById($id);
        $category->delete();
        return redirect()->route('admin.cammodel-categories.index')->with('message', config('messaging.delete'));
    }

    public function removeImage(Request $request)
    {
        $this->cammodelCategoryInterf->deleteFile($request->only('category'));
        return redirect()->route('admin.cammodel-categories.edit', $request->input('category'))->with('message', config('messaging.delete'));
    }

    public function updateSortOrder(Request $request, int $id)
    {
        $data = $request->json();
        foreach ($data as $key => $value) {
            $res = $this->cammodelCategoryInterf->updateSortOrder($value);
        }
        return $res;
    }
}
