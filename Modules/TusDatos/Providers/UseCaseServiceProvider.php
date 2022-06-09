<?php

namespace Modules\TusDatos\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\TusDatos\Entities\TusDatosConsultations\UseCases\Interfaces\TusDatosConsultationUseCaseInterface;
use Modules\TusDatos\Entities\TusDatosConsultations\UseCases\TusDatosConsultationUseCase;

class UseCaseServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            TusDatosConsultationUseCaseInterface::class,
            TusDatosConsultationUseCase::class
        );
    }
}
