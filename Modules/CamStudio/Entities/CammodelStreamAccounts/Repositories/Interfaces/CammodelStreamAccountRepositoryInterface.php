<?php

namespace Modules\CamStudio\Entities\CammodelStreamAccounts\Repositories\Interfaces;

use Illuminate\Support\Collection;
use Modules\CamStudio\Entities\CammodelStreamAccounts\CammodelStreamAccount;

interface CammodelStreamAccountRepositoryInterface
{
    public function createCammodelStreamAccount(array $data): CammodelStreamAccount;

    public function updateCammodelStreamAccount(array $data): bool;

    public function findCammodelStreamAccountById(int $CammodelStreamAccountId): CammodelStreamAccount;

    public function listCammodelStreamAccounts(int $totalView): Collection;

    public function deleteCammodelStreamAccount(): bool;

    public function searchCammodelStreamAccounts(string $text = null, int $totalView, $from = null, $to = null): Collection;

    public function countCammodelStreamAccounts(string $text = null,  $from = null, $to = null);

    public function getCammodelsStreamAccounts($streamingId = null);

    public function getCammodelChaturbateAccountId(int $CammodelId);

    public function findStreamingAccountByProfile(string $profile, int $streamingId = 1);

    public function getAccountsByStreaming(int $streamingId);

    public function findStreamAccountByCammodel(int $cammodelId);
}
