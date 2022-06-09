<?php

namespace Modules\CamStudio\Entities\StreamingStats\UseCases\Interfaces;

use Illuminate\Http\Request;

interface StreamingStatUseCaseInterface
{
    public function listStreamingStats(Request $request): array;
}
