<?php

namespace Modules\TusDatos\Providers;


use Illuminate\Support\ServiceProvider;
use Modules\TusDatos\Entities\TusDatosConsultations\Repositories\Interfaces\TusDatosConsultationRepositoryInterface;
use Modules\TusDatos\Entities\TusDatosConsultations\Repositories\TusDatosConsultationRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            TusDatosConsultationRepositoryInterface::class,
            TusDatosConsultationRepository::class
        );
    }
}
