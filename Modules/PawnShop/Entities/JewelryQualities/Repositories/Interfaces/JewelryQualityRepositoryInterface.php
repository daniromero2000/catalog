<?php

namespace Modules\PawnShop\Entities\JewelryQualities\Repositories\Interfaces;

use Modules\PawnShop\Entities\JewelryQualities\JewelryQuality;

interface JewelryQualityRepositoryInterface
{
    public function createJewelryQuality(array $data): JewelryQuality;

    public function updateJewelryQuality(array $data): bool;

    public function findJewelryQualityById(int $id): JewelryQuality;

    public function deleteJewelryQuality(): bool;

    public function searchJewelryQuality(string $text = null);

    public function getAllJewelryQualityNames();
}
