<?php

namespace Modules\Banking\Entities\Trms\UseCases;

use Carbon\Carbon;
use Modules\Banking\Entities\Trms\UseCases\Interfaces\TrmUseCaseInterface;

class TrmUseCase implements TrmUseCaseInterface
{
    public function __construct()
    {
        $this->module = 'Trms';
    }

    public function listTrms(array $data)
    {
    }

    public function createTrm()
    {
    }

    public function storeTrm(array $requestData)
    {
    }

    public function updateTrm(array $requestData, $id)
    {
    }

    public function destroyTrm(int $id)
    {
    }

    private function getTrm(int $id)
    {
    }

    public function getOnlineTRM()
    {
        $date = Carbon::now()->Format('Y-m-d');
        $obj =  $this->trmConection($date);
        $count = 1;

        while ($obj == null) {
            $date = Carbon::now()->subDays($count)->Format('Y-m-d');
            $obj = $this->trmConection($date);
            $count++;
        }

        return !$obj == null ? floatval($obj[0]->valor) : 0;
    }

    private function trmConection($date)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, 'https://www.datos.gov.co/resource/32sa-8pi3.json?vigenciahasta=' . $date  . 'T00:00:00.000');
        $result = curl_exec($ch);
        curl_close($ch);
        return json_decode($result);
    }
}
