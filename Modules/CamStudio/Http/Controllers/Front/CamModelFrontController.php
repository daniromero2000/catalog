<?php

namespace Modules\CamStudio\Http\Controllers\Front;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\View;
use Illuminate\Routing\Controller;
use Modules\CamStudio\Entities\Cammodels\Exceptions\CammodelNotFoundErrorException;
use Modules\CamStudio\Entities\Cammodels\Repositories\Interfaces\CammodelRepositoryInterface;


class CamModelFrontController extends Controller
{
    private $camModelInterface;

    public function __construct(CammodelRepositoryInterface $cammodelRepositoryInterface)
    {
        $this->camModelInterface = $cammodelRepositoryInterface;
    }

    public function getCamModel($slug): View
    {
        try {
            return view('camstudio::front.profile-model', [
                'camModel' => $this->camModelInterface->findCammodelBySlug($slug)
            ]);
        } catch (CammodelNotFoundErrorException $e) {
            request()->session()->flash('error', 'La modelo que estás buscando no se encuentra');
            return redirect()->route('/');
        }

        return view('camstudio::front.profile-model', [
            'camModel' => $this->camModelInterface->findCammodelBySlug($slug)
        ]);
    }

    public function getCamModelWishlists($slug): View
    {
        try {
            $camModel = $this->camModelInterface->findCammodelBySlug($slug);
        } catch (CammodelNotFoundErrorException $e) {
            request()->session()->flash('error', 'La modelo que estás buscando no se encuentra');
            return redirect()->route('/');
        }

        return view('camstudio::front.wishlists-model', [
            'camModel'  => $camModel,
            'wishlists' => $camModel->employee->customer->wishlist
        ]);
    }
}
