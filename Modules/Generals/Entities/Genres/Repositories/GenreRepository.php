<?php

namespace Modules\Generals\Entities\Genres\Repositories;

use Illuminate\Support\Collection;
use Modules\Generals\Entities\Genres\Genre;
use Modules\Generals\Entities\Genres\Repositories\Interfaces\GenreRepositoryInterface;

class GenreRepository implements GenreRepositoryInterface
{
    protected $model;
    private $columns = ['id', 'genre'];

    public function __construct(Genre $Genre)
    {
        $this->model = $Genre;
    }

    public function getAllGenresNames(): Collection
    {
        return $this->model->orderBy('genre', 'asc')->get($this->columns);
    }
}
