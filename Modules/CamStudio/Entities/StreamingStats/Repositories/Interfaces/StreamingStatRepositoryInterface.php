<?php

namespace Modules\CamStudio\Entities\StreamingStats\Repositories\Interfaces;

use Illuminate\Support\Collection;
use Modules\CamStudio\Entities\StreamingStats\StreamingStat;

interface StreamingStatRepositoryInterface
{
    public function createStreamingStat(array $data): StreamingStat;

    public function updateStreamingStat(array $data): bool;

    public function findStreamingStatById(int $id): StreamingStat;

    public function findStreamingStatsByCammodelId($cammodel, $from = null, $to = null): Collection;

    public function listStreamingStats(): Collection;

    public function deleteStreamingStat(): bool;

    public function getStreamingsApiStats($streamingAccounts);

    public function getCammodelsIds($from = null, $to = null);

    public function getStudioChaturbateStats();

    public function getCammodelStreamingStats($from, $to, int $id): Collection;

    public function findStreamingStatsByAccount(int $accountId): Collection;

    public function getCammodelsStreamingStats($dates): Collection;
}
