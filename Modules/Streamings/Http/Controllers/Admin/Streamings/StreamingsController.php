<?php

namespace Modules\Streamings\Http\Controllers\Admin\Streamings;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Modules\Streamings\Entities\Streamings\Requests\CreateStreamingRequest;
use Modules\Streamings\Entities\Streamings\Requests\UpdateStreamingRequest;
use Modules\Streamings\Entities\Streamings\UseCases\Interfaces\StreamingUseCaseInterface;

class StreamingsController extends Controller
{
    private $streamingUseCaseInterface;

    public function __construct(
        StreamingUseCaseInterface $streamingUseCaseInterface
    ) {
        $this->middleware(['permission:contracts, guard:employee']);
        $this->streamingUseCaseInterface = $streamingUseCaseInterface;
    }

    public function index(Request $request): View
    {
        $response = $this->streamingUseCaseInterface->listStreamings(['search' => $request->input()]);

        if ($response['search']) {
            $request->session()->flash('message', config('messaging.searching'));
        }

        return view('streamings::admin.streamings.list', $response['data']);
    }

    public function create(): View
    {
        return view('streamings::admin.streamings.create', $this->streamingUseCaseInterface->createStreaming());
    }

    public function store(CreateStreamingRequest $request)
    {
        $this->streamingUseCaseInterface->storeStreaming($request->except('_token', '_method'));

        return redirect()->route('admin.streamings.index')
            ->with('message', config('messaging.create'));
    }

    public function show(int $streamingId)
    {
        return redirect()->route('admin.streamings.index')
            ->with('error', config('messaging.not_found'));
    }

    public function update(UpdateStreamingRequest $request, int $streamingId)
    {
        $this->streamingUseCaseInterface->updateStreaming($request, $streamingId);
        return back()->with('message', config('messaging.update'));
    }

    public function destroy(int $streamingId)
    {
        $this->streamingUseCaseInterface->destroyStreaming($streamingId);
        return back()->with('message', config('messaging.delete'));
    }
}
