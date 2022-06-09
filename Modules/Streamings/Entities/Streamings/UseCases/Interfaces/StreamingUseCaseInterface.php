<?php

namespace Modules\Streamings\Entities\Streamings\UseCases\Interfaces;

interface StreamingUseCaseInterface
{
    public function listStreamings(array $data): array;

    public function createStreaming(): array;

    public function storeStreaming(array $requestData): void;

    public function updateStreaming($request, int $streamingId): Void;

    public function destroyStreaming(int $streamingId): Void;

    public function dollarCalculator($tokens, $usdTokenRate);

    public function streamingsCommissions($chaseTransfer);
}
