<?php

namespace Modules\Generals\Entities\SocialMedias\Repositories;

use Illuminate\Support\Collection;
use Modules\Generals\Entities\SocialMedias\Repositories\Interfaces\SocialMediaRepositoryInterface;
use Modules\Generals\Entities\SocialMedias\SocialMedia;
use Nicolaslopezj\Searchable\SearchableTrait;
use Modules\Generals\Entities\Tools\UploadableTrait;

class SocialMediaRepository  implements SocialMediaRepositoryInterface
{
    use SearchableTrait, UploadableTrait;
    protected $model, $socialmedia;
    private $columns = ['id', 'social', 'url', 'icon'];

    public function __construct(SocialMedia $socialmedia)
    {
        $this->model = $socialmedia;
    }

    public function getAllSocialMedias(): Collection
    {
        return $this->model->orderBy('id', 'asc')->get($this->columns);
    }
}
