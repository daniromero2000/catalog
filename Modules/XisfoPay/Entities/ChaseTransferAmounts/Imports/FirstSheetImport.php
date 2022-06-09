<?php

namespace Modules\XisfoPay\Entities\ChaseTransferAmounts\Imports;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Modules\Streamings\Entities\Streamings\Exceptions\StreamingNotFoundException;
use Modules\Streamings\Entities\Streamings\Streaming;
use Modules\XisfoPay\Entities\ChaseTransferAmounts\ChaseTransferAmount;
use Modules\XisfoPay\Entities\ChaseTransferAmounts\Exceptions\CreateChaseTransferAmountErrorException;

class FirstSheetImport implements ToCollection
{
    private $chaseTransferId;

    public function __construct(
        int $chaseTransferId
    ) {
        $this->chaseTransferId = $chaseTransferId;
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $key => $row) {
            if ($key > 0) {
                try {
                    $streaming = $this->getStreamingId($row[1]);
                } catch (StreamingNotFoundException $e) {
                    throw new CreateChaseTransferAmountErrorException($e->getMessage());
                }

                try {
                    ChaseTransferAmount::create([
                        'chase_transfer_id' => $this->chaseTransferId,
                        'created_at'        => Carbon::parse($row[0]),
                        'streaming_id'      => $streaming->id,
                        'amount'            => $row[2],
                    ]);
                } catch (QueryException $e) {
                    throw new CreateChaseTransferAmountErrorException($e->getMessage());
                }
            }
        }
    }

    private function getStreamingId($streamingName)
    {
        try {
            return Streaming::select(['id'])->where('streaming', $streamingName)->firstOrFail();
        } catch (ModelNotFoundException $e) {
            throw new StreamingNotFoundException($e->getMessage());
        }
    }
}
