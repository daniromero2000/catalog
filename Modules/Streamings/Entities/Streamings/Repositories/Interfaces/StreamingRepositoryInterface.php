<?php

namespace Modules\Streamings\Entities\Streamings\Repositories\Interfaces;

use Illuminate\Http\UploadedFile;
use Illuminate\Pagination\LengthAwarePaginator;
use Modules\Streamings\Entities\Streamings\Streaming;
use Illuminate\Support\Collection;

interface StreamingRepositoryInterface
{
    public function createStreaming(array $data): Streaming;

    public function findStreamingByName(string $name): Streaming;

    public function searchStreaming(string $text = null): LengthAwarePaginator;

    public function findStreamingById(int $streamingId): Streaming;

    public function deleteStreaming(): bool;

    public function getAllStreamingNames(): Collection;

    public function saveStreamingIcon(UploadedFile $file, $streaming): string;

    public function getStreamingCommission(int $streamingId);
}
