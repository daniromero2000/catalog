<?php

namespace Modules\CamStudio\Entities\CammodelStreamingIncomes;

use Illuminate\Database\Eloquent\Model;

class ChaturbateMasterAccount extends Model
{
    public function __construct()
    {
        $this->masterAccounts   = ['studioslefemme', 'maschichaslindas'];
        $this->masterTokens     = ['V3SeH9aL4soWC3nNA8ZJyTDs', '53568wfpF6IH4AwfIY8KAwbv'];
        $this->otherAccountsIds = ['11'];
    }

    public function getMasterAccounts()
    {
        return $this->masterAccounts;
    }

    public function getMasterTokens()
    {
        return $this->masterTokens;
    }

    public function getOtherAccountsIds()
    {
        return $this->otherAccountsIds;
    }
}
