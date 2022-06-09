<?php

namespace Modules\CamStudio\Entities\SocialStats\Repositories\Interfaces;

use Illuminate\Support\Collection;
use Modules\CamStudio\Entities\SocialStats\SocialStat;

interface SocialStatRepositoryInterface
{
    public function createSocialStat(array $data): SocialStat;

    public function updateSocialStat(array $data): bool;

    public function findSocialStatById(int $id): SocialStat;

    public function findAllSocialStats($from = null, $to = null): Collection;

    public function findSocialStatsByCammodelId($cammodel, $from = null, $to = null): Collection;

    public function listSocialStats(): Collection;

    public function deleteSocialStat(): bool;

    public function searchSocialStat(string $text = null, $cammodels, $from = null, $to = null): Collection;

    public function getSocialApiStats($socialMedias);

    public function getCammodelsIds($cammodels, $from = null, $to = null): array;

    public function getCammodelSocialStats($from, $to, int $id): Collection;

    public function findSocialStatsByAccount(int $accountId): Collection;
}
