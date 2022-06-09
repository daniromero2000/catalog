<?php

namespace Modules\Generals\Entities\Tools;

interface ToolRepositoryInterface
{
    public function getSkip($RequestSkip);

    public function getPaginate($paginate, $skip): array;

    public function getClientServerData(array $paymentDataRequest): array;

    public function deleteThumbFromServer(string $src): bool;

    public function setSearchParameters($data);

    public function setSearchParametersRefactor($data);

    public function getCammodelStatsPeriodDates(): array;

    public function getPayrollPeriodDates(): array;

    public function getPastFortnightDates(int $backFortnights = 0): array;

    public function getMonthName(int $month): string;

    public function getTrimesterPosition(array $request): array;

    public function getFortnightsGap($request);

    public function calculateChangeRate($actualValue, $previousValue);

    public function setSignedUser();
}
