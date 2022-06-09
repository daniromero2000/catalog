<?php

namespace Modules\Generals\Entities\SocialMedias\Repositories\Interfaces;

use Illuminate\Support\Collection;

interface SocialMediaRepositoryInterface
{
    public function getAllSocialMedias(): Collection;
}
