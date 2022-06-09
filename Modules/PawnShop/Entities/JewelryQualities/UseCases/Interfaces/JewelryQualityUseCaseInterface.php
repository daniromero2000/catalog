<?php

namespace Modules\PawnShop\Entities\JewelryQualities\UseCases\Interfaces;

interface JewelryQualityUseCaseInterface
{
    public function listJewelryQualities(array $data): array;

    public function createJewelryQuality();

    public function storeJewelryQuality(array $requestData);

    public function updateJewelryQuality($request, int $id);

    public function destroyJewelryQuality(int $id);
}
