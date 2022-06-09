<?php

namespace Modules\XisfoPay\Entities\XisfoPayParameters;

use Illuminate\Database\Eloquent\Model;

class XisfoPayParameter extends Model
{
    protected $cuatroXmil, $retentionPercentage, $gainEnsurance, $advancePercentage;
    protected $iva;

    public function __construct()
    {
        $this->cuatroXmil          = 0.004;
        $this->retentionPercentage = 0.07;
        $this->gainEnsurance       = 0.03;
        $this->iva                 = 0.19;
        $this->advancePercentage   = 0.70;
    }

    public function getcuatroXmil()
    {
        return $this->cuatroXmil;
    }

    public function getretentionPercentage()
    {
        return $this->retentionPercentage;
    }

    public function getgainEnsurance()
    {
        return $this->gainEnsurance;
    }

    public function getIva()
    {
        return $this->iva;
    }

    public function getAdvancePercentage()
    {
        return $this->advancePercentage;
    }
}
