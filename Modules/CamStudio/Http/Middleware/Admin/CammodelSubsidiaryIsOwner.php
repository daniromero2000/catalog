<?php

namespace Modules\CamStudio\Http\Middleware\Admin;

use Closure;
use Modules\CamStudio\Entities\Cammodels\Exceptions\CammodelNotFoundErrorException;
use Modules\CamStudio\Entities\Cammodels\Repositories\Interfaces\CammodelRepositoryInterface;

class CammodelSubsidiaryIsOwner
{
    private $cammodelInterface;

    public function __construct(
        CammodelRepositoryInterface $cammodelRepositoryInterface
    ) {
        $this->auth = auth()->guard('employee')->user();
        $this->cammodelInterface = $cammodelRepositoryInterface;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try {
            $cammodel = $this->cammodelInterface->findCammodelById($request->segments()[2]);
        } catch (CammodelNotFoundErrorException $e) {
            return redirect()->route('admin.dashboard')
                ->with('error', config('messaging.not_found'));
        }

        if (auth()->guard('employee')->user()->hasRole('studio_admin|studio_manager|subsidiary_supervisor') && $cammodel->employee->subsidiary_id !== $this->auth->subsidiary_id) {
            return back();
        }

        return $next($request);
    }
}
