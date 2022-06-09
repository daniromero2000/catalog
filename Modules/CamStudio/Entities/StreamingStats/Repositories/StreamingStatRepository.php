<?php

namespace Modules\CamStudio\Entities\StreamingStats\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use Modules\CamStudio\Entities\StreamingStats\StreamingStat;
use Modules\CamStudio\Entities\StreamingStats\Exceptions\CreateStreamingStatErrorException;
use Modules\CamStudio\Entities\StreamingStats\Exceptions\DeletingStreamingStatErrorException;
use Modules\CamStudio\Entities\StreamingStats\Exceptions\StreamingStatNotFoundException;
use Modules\CamStudio\Entities\StreamingStats\Exceptions\UpdateStreamingStatErrorException;
use Modules\CamStudio\Entities\StreamingStats\Repositories\Interfaces\StreamingStatRepositoryInterface;

class StreamingStatRepository implements StreamingStatRepositoryInterface
{
    protected $model;
    private $columns = [
        'id',
        'cammodel_stream_account_id',
        'num_followers',
        'last_broadcast',
        'votes_up',
        'votes_down',
        'created_at'
    ];

    public function __construct(StreamingStat $contractStatus)
    {
        $this->model = $contractStatus;
    }

    public function createStreamingStat(array $data): StreamingStat
    {
        try {
            return $this->model->create($data);
        } catch (QueryException $e) {
            throw new CreateStreamingStatErrorException($e->getMessage());
        }
    }

    public function updateStreamingStat(array $data): bool
    {
        try {
            return $this->model->update($data);
        } catch (QueryException $e) {
            throw new UpdateStreamingStatErrorException($e->getMessage());
        }
    }

    public function findStreamingStatById(int $id): StreamingStat
    {
        try {
            return $this->model->findOrFail($id, $this->columns);
        } catch (ModelNotFoundException $e) {
            throw new StreamingStatNotFoundException($e->getMessage());
        }
    }

    public function findStreamingStatsByCammodelId($cammodel, $from = null, $to = null): Collection
    {
        return $this->model->where('cammodel_stream_account_id', $cammodel)
            ->whereBetween('created_at', [$from, $to])
            ->with('cammodelStreamAccount')->orderBy('created_at', 'desc')
            ->get($this->columns);
    }

    public function findLastStreamingStatsByCammodel($cammodel, $from = null, $to = null): StreamingStat
    {
        return $this->model->where('cammodel_stream_account_id', $cammodel)
            ->whereBetween('created_at', [$from, $to])
            ->with('cammodelStreamAccount')->first();
    }

    public function findActualStreamingStatsByCammodelId($cammodel, $to = null): StreamingStat
    {
        $today = $to->format('Y-m-d');
        return $this->model->where('cammodel_stream_account_id', $cammodel)
            ->with('cammodelStreamAccount')
            ->where('created_at', 'LIKE', $today . '%')
            ->orderBy('created_at', 'desc')->first();
    }

    public function listStreamingStats(): Collection
    {
        $agoDate = \Carbon\Carbon::now()->subWeek()->format('Y-m-d');
        $nowDate = \Carbon\Carbon::now()->add(1, 'day')->format('Y-m-d');
        return $this->model->with('cammodelStreamAccount')
            ->whereBetween('created_at', [$agoDate, $nowDate])
            ->get($this->columns);
    }

    public function deleteStreamingStat(): bool
    {
        try {
            return $this->model->delete();
        } catch (QueryException $e) {
            throw new DeletingStreamingStatErrorException($e->getMessage());
        }
    }

    public function getStreamingsApiStats($streamingAccounts)
    {
        $streamingAccounts->each(function ($streamingAccount) {
            switch ($streamingAccount->streaming_id) {
                case '1':
                    $obj = $this->getChaturbateStatsForCammodel($streamingAccount);
                    break;
                case '2':
                    $obj = $this->getMyFreeCamsFollowersForCammodel($streamingAccount);
                    dd($obj);
                    break;
                case '4':
                    $obj = $this->getCamSodaFollowersForCammodel($streamingAccount);
                    dd($obj);
                    break;
                case '5':
                    $obj = $this->getBongacamsFollowersForCammodel($streamingAccount);
                    dd($obj);
                    break;
                default:
                    break;
            }
            $obj['cammodel_stream_account_id'] = $streamingAccount->id;
            if (array_key_exists('num_followers', $obj)) {
                $this->model->create($obj);
            }
        });
    }

    public function getChaturbateStatsForCammodel($streamingAccount)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $streamingAccount->account_api_token);
        $result = curl_exec($ch);
        curl_close($ch);
        return json_decode($result, true);
    }

    public function url_get_contents($url, $useragent = 'cURL', $headers = false, $follow_redirects = true, $debug = false)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_USERAGENT, $useragent);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        if ($headers == true) {
            curl_setopt($ch, CURLOPT_HEADER, 1);
        }
        if ($headers == 'headers only') {
            curl_setopt($ch, CURLOPT_NOBODY, 1);
        }
        if ($follow_redirects == true) {
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        }
        if ($debug == true) {
            $result['contents'] = curl_exec($ch);
            $result['info'] = curl_getinfo($ch);
        } else $result = curl_exec($ch);

        curl_close($ch);
        return $result;
    }

    public function getBongacamsFollowersForCammodel($streamingAccount)
    {
        $raw = $this->url_get_contents('https://es.bongacams.com/maryevans-');
        preg_match('/id="sLovers">\s?([0-9]+)/', $raw, $m);
        //$obj['followers_count']            = $m[1];
        dd($m);
        //return $obj;
    }

    public function getMyFreeCamsFollowersForCammodel($streamingAccount)
    {
        $raw = $this->url_get_contents('https://profiles.myfreecams.com/' . $streamingAccount->profile);
        preg_match('/admirers:\s?([0-9]+)/', $raw, $m);
        $obj['followers_count']            = $m[1];
        return $obj;
    }

    public function getCamSodaFollowersForCammodel($streamingAccount)
    {
        $raw = $this->url_get_contents('https://es.camsoda.com/' . $streamingAccount->profile);
        preg_match('/"followers":"\s?([0-9]+)/', $raw, $m);
        $obj['followers_count']            = $m[1];
        return $obj;
    }

    public function getCammodelsIds($from = null, $to = null, array $ids = null)
    {
        return $this->model->whereBetween('created_at', [$from, $to])
            ->where('deleted_at', null)
            ->distinct()->get(['cammodel_stream_account_id']);
    }

    public function getStudioChaturbateStats()
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // https://es.chaturbate.com/affiliates/apistats/?username=maschichaslindas&token=53568wfpF6IH4AwfIY8KAwbv&stats_breakdown=sub_account__username&campaign=&search_criteria=1&period=0&date_day=27&date_month=2&date_year=2022&start_date_day=1&start_date_month=1&start_date_year=2021&end_date_day=28&end_date_month=2&end_date_year=2021&download_stats_json=Download%20Stats%20as%20JSON
        curl_setopt($ch, CURLOPT_URL, 'https://es.chaturbate.com/affiliates/apistats/?' .
            'username=maschichaslindas' .
            '&token=53568wfpF6IH4AwfIY8KAwbv' .
            '&stats_breakdown=sub_account__username' .
            '&campaign=' .
            '&search_criteria=3' .
            '&period=0' .
            '&date_day=1' .
            '&date_month=3' .
            '&date_year=2021' .
            '&start_date_day=1' .
            '&start_date_month=3' .
            '&start_date_year=2021' .
            '&end_date_day=5' .
            '&end_date_month=3' .
            '&end_date_year=2021' .
            '&download_stats_json=Download%20Stats%20as%20JSON');
        $result = curl_exec($ch);
        curl_close($ch);
        $result = json_decode($result, true);
        dd($result);
    }

    public function getCammodelStreamingStats($from, $to, int $id): Collection
    {
        return $this->model
            ->whereBetween('created_at', [$from, $to])
            ->where('cammodel_stream_account_id', $id)
            ->get($this->columns);
    }

    public function findStreamingStatsByAccount(int $accountId): Collection
    {
        return $this->model
            ->where('cammodel_stream_account_id', $accountId)
            ->get($this->columns);
    }

    public function getCammodelsStreamingStats($dates): Collection
    {
        return $this->model
            ->with('cammodelStreamAccount')
            ->whereBetween('created_at', $dates)
            ->whereHas('cammodelStreamAccount', function ($q) {
                $q->where('is_active', 1)->where('streaming_id', '1');
            })
            ->get($this->columns);
    }
}
