<?php

namespace Modules\CamStudio\Http\Controllers\Admin\CammodelTipperSocialMedias;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\CamStudio\Entities\CammodelTipperSocialMedias\Requests\CreateCammodelTipperSocialMediaRequest;
use Modules\CamStudio\Entities\CammodelTipperSocialMedias\UseCases\Interfaces\CammodelTipperSocialMediaUseCaseInterface;

class CammodelTipperSocialMediasController extends Controller
{
    private $cammodelTipperSocialMediaServiceInterface;

    public function __construct(
        CammodelTipperSocialMediaUseCaseInterface $cammodelTipperSocialMediaUseCaseInterface
    ) {
        $this->middleware(['permission:cammodel_tipper_social_media|cammodel_tipper, guard:employee']);
        $this->cammodelTipperSocialMediaServiceInterface = $cammodelTipperSocialMediaUseCaseInterface;
        $this->module                                    = 'Redes sociales de modelo';
    }

    public function index(Request $request): View
    {
        $response = $this->cammodelTipperSocialMediaServiceInterface->listCammodelTipperSocialMedias(['search' => $request->input()]);

        return view('camstudio::admin.cammodel-tipper-social-medias.list', $response['data']);
    }

    public function create(): View
    {
        return view('camstudio::admin.cammodel-tipper-social-medias.create', $this->cammodelTipperSocialMediaServiceInterface->createCammodelTipperSocialMedia());
    }

    public function store(CreateCammodelTipperSocialMediaRequest $request)
    {
        $this->cammodelTipperSocialMediaServiceInterface->storeCammodelTipperSocialMedia($request->input());
        return back()->with('message', config('messaging.create'));
    }

    public function show(int $CammodelTipperSocialMediaId)
    {
        return redirect()->route('admin.cammodel-tipper-social-medias.index')
            ->with('error', config('messaging.not_found'));
    }

    public function update(Request $request, $CammodelTipperSocialMediaId)
    {
        $this->cammodelTipperSocialMediaServiceInterface->updateCammodelTipperSocialMedia($request, $CammodelTipperSocialMediaId);
        return back()->with('message', config('messaging.update'));
    }

    public function destroy($CammodelTipperSocialMediaId)
    {
        $this->cammodelTipperSocialMediaServiceInterface->destroyCammodelTipperSocialMedia($CammodelTipperSocialMediaId);
        return back()->with('message', config('messaging.delete'));
    }
}
