<?php

namespace Modules\Streamings\Entities\Streamings\Repositories;

use Illuminate\Http\UploadedFile;
use Modules\Streamings\Entities\Streamings\Streaming;
use Modules\Streamings\Entities\Streamings\Repositories\Interfaces\StreamingRepositoryInterface;
use Modules\Streamings\Entities\Streamings\Exceptions\CreateStreamingErrorException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Modules\Streamings\Entities\Streamings\Exceptions\DeletingStreamingErrorException;
use Modules\Streamings\Entities\Streamings\Exceptions\StreamingNotFoundException;
use Modules\Streamings\Entities\Streamings\Exceptions\UpdateStreamingErrorException;

class StreamingRepository implements StreamingRepositoryInterface
{
    protected $model;
    private $columns = [
        'id', 'streaming', 'url', 'icon', 'usd_commission',
        'usd_token_rate', 'is_active', 'created_at'
    ];

    public function __construct(Streaming $streamings)
    {
        $this->model = $streamings;
    }

    public function createStreaming(array $data): Streaming
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new CreateStreamingErrorException($e->getMessage());
        }
    }

    public function findStreamingByName(string $name): Streaming
    {
        try {
            return $this->model->where('streaming', $name)->get('id')->first();
        } catch (ModelNotFoundException $e) {
            throw new StreamingNotFoundException($e->getMessage());
        }
    }

    public function findStreamingById(int $streamingId): Streaming
    {
        try {
            return $this->model->findOrFail($streamingId, $this->columns);
        } catch (ModelNotFoundException $e) {
            throw new StreamingNotFoundException($e->getMessage());
        }
    }

    public function updateStreaming(array $data): bool
    {
        try {
            return $this->model->update($data);
        } catch (QueryException $e) {
            throw new UpdateStreamingErrorException($e->getMessage());
        }
    }

    public function deleteStreaming(): bool
    {
        try {
            return $this->model->delete();
        } catch (QueryException $e) {
            throw new DeletingStreamingErrorException($e->getMessage());
        }
    }

    public function getAllStreamingNames(): Collection
    {
        return $this->model->where('is_active', 1)->orderBy('streaming', 'asc')
            ->get(['id', 'streaming', 'url', 'is_active',]);
    }

    public function getStreamingCommission($streamingId)
    {
        return   Streaming::select('usd_commission')->where('id', $streamingId)->first();
    }

    public function saveStreamingIcon(UploadedFile $file, $streaming): string
    {
        return $file->store('streamings/' . $streaming, ['disk' => 'public']);
    }

    public function searchStreaming(string $text = null): LengthAwarePaginator
    {
        if (is_null($text)) {
            return $this->listStreamings();
        } else {
            return $this->model->searchStreaming($text)->select($this->columns)
                ->orderBy('streaming', 'desc')->paginate(10);
        }
    }

    private function listStreamings(): LengthAwarePaginator
    {
        return  $this->model->select($this->columns)->orderBy('streaming', 'asc')
            ->paginate(10);
    }
}
