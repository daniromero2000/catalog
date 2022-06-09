<?php

namespace Modules\CamStudio\Entities\SocialStats\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use Modules\CamStudio\Entities\SocialStats\SocialStat;
use Modules\CamStudio\Entities\SocialStats\Exceptions\CreateSocialStatErrorException;
use Modules\CamStudio\Entities\SocialStats\Exceptions\DeletingSocialStatErrorException;
use Modules\CamStudio\Entities\SocialStats\Exceptions\SocialStatNotFoundException;
use Modules\CamStudio\Entities\SocialStats\Exceptions\UpdateSocialStatErrorException;
use Modules\CamStudio\Entities\SocialStats\Repositories\Interfaces\SocialStatRepositoryInterface;

class SocialStatRepository implements SocialStatRepositoryInterface
{
    protected $model;
    private $columns = [
        'id',
        'cammodel_social_media_id',
        'followers_count',
        'created_at'
    ];

    public function __construct(SocialStat $socialStat)
    {
        $this->model = $socialStat;
    }

    public function createSocialStat(array $data): SocialStat
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new CreateSocialStatErrorException($e->getMessage());
        }
    }

    public function updateSocialStat(array $data): bool
    {
        try {
            return $this->model->update($data);
        } catch (QueryException $e) {
            throw new UpdateSocialStatErrorException($e->getMessage());
        }
    }

    public function findSocialStatById(int $id): SocialStat
    {
        try {
            return $this->model->findOrFail($id, $this->columns);
        } catch (ModelNotFoundException $e) {
            throw new SocialStatNotFoundException($e->getMessage());
        }
    }

    public function findAllSocialStats($from = null, $to = null): Collection
    {
        return $this->model->whereBetween('created_at', [$from, $to])
            ->with('cammodelSocialMedia')->orderBy('created_at', 'desc')
            ->get($this->columns);
    }

    public function findSocialStatsByCammodelId($cammodel, $from = null, $to = null): Collection
    {
        return $this->model->where('cammodel_social_media_id', $cammodel)
            ->whereBetween('created_at', [$from, $to])
            ->with('cammodelSocialMedia')->orderBy('created_at', 'desc')
            ->get($this->columns);
    }

    public function findLastSocialStatsByCammodel($cammodel, $from = null, $to = null): SocialStat
    {
        return $this->model->where('cammodel_social_media_id', $cammodel)
            ->whereBetween('created_at', [$from, $to])
            ->with('cammodelSocialMedia')->first($this->columns);
    }

    public function findActualSocialStatsByCammodelId($cammodel, $to = null): SocialStat
    {
        $today = $to->format('Y-m-d');
        return $this->model->where('cammodel_social_media_id', $cammodel)
            ->with('cammodelSocialMedia')
            ->where('created_at', 'LIKE', $today . '%')
            ->orderBy('created_at', 'desc')->first($this->columns);
    }

    public function listSocialStats(): Collection
    {
        $agoDate = \Carbon\Carbon::now()->subWeek()->format('Y-m-d');
        $nowDate = \Carbon\Carbon::now()->add(1, 'day')->format('Y-m-d');
        return $this->model->with('cammodelSocialMedia')
            ->whereBetween('created_at', [$agoDate, $nowDate])
            ->get($this->columns);
    }

    public function deleteSocialStat(): bool
    {
        try {
            return $this->model->delete();
        } catch (QueryException $e) {
            throw new DeletingSocialStatErrorException($e->getMessage());
        }
    }

    public function searchSocialStat(string $text = null, $cammodels, $from = null, $to = null): Collection
    {
        $cammodels_stats = new Collection();
        $today = $to->format('Y-m-d');
        $ids = $this->model->whereIn('cammodel_social_media_id', $cammodels)->where('created_at', 'LIKE', $today . '%')
            ->where('deleted_at', null)->orderBy('followers_count', 'desc')->distinct()->get('cammodel_social_media_id');
        foreach ($ids as $cammodel) {
            $actual                = $this->findActualSocialStatsByCammodelId($cammodel->cammodel_social_media_id, $to);
            $past                  = $this->findLastSocialStatsByCammodel($cammodel->cammodel_social_media_id, $from, $to);
            $actual['bounce_rate'] = (($actual['followers_count'] - $past['followers_count']) / $past['followers_count'] * 100);
            $actual['bounce_rate'] = round($actual['bounce_rate'], 2);
            $cammodels_stats->push($actual);
        }
        return $cammodels_stats;
    }

    public function getSocialApiStats($socialMedias)
    {
        $socialMedias->each(function ($socialMedia) {
            $followers_count = "0";
            switch ($socialMedia->social_media_id) {
                case '2':
                    $followers_count = $this->getInstagramFollowsForCammodel($socialMedia->profile);
                    break;
                case '3':
                    $followers_count = $this->getTwitterApiStats($socialMedia->profile);
                    break;
                default:
                    # code...
                    break;
            }

            if ($followers_count != 0) {
                $data['followers_count'] = $followers_count;
                $data['cammodel_social_media_id'] = $socialMedia->id;

                try {
                    $this->createSocialStat($data);
                } catch (\Throwable $th) {
                    dd($th);
                }
            }
        });
    }

    public function getTwitterApiStats($profile)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, 'https://cdn.syndication.twimg.com/widgets/followbutton/info.json?screen_names=' . $profile);
        $result = curl_exec($ch);
        curl_close($ch);
        $obj = json_decode($result, true);
        if (empty($obj)) {
            return 0;
        } else {
            return $obj[0]['followers_count'];
        }
    }

    public function getInstagramFollowsForCammodel($profile)
    {
        $raw = file_get_contents('https://www.instagram.com/' . $profile); //replace with user
        preg_match('/\"edge_followed_by\"\:\s?\{\"count\"\:\s?([0-9]+)/', $raw, $m);
        if (empty($m)) {
            return 0;
        } else {
            return $m[1];
        }
    }

    public function getCammodelsIds($cammodels, $from = null, $to = null): array
    {
        $idsCollection =  $this->model->whereBetween('created_at', [$from, $to])
            ->whereIn('cammodel_social_media_id', $cammodels)
            ->where('deleted_at', null)
            ->distinct()->get('cammodel_social_media_id');

        $ids_array = [];

        foreach ($idsCollection as $value) {
            array_push($ids_array, $value->cammodel_social_media_id);
        }

        return $ids_array;
    }

    public function getCammodelSocialStats($from, $to, int $id): Collection
    {
        return $this->model->whereBetween('created_at', [$from, $to])
            ->where('cammodel_social_media_id', $id)
            ->get($this->columns);
    }

    public function findSocialStatsByAccount(int $accountId): Collection
    {
        return $this->model->where('cammodel_social_media_id', $accountId)
            ->get($this->columns);
    }
}
