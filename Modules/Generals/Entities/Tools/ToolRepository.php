<?php

namespace Modules\Generals\Entities\Tools;

use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Modules\Generals\Entities\Tools\ToolRepositoryInterface;

class ToolRepository implements ToolRepositoryInterface
{
    public function getSkip($RequestSkip)
    {
        if ($RequestSkip == null) {
            return 0;
        } else {
            return $RequestSkip;
        }
    }

    public function getClientServerData(array $data): array
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $data['ip'] = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $data['ip'] = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $data['ip'] = $_SERVER['REMOTE_ADDR'];
        }

        $data['USER_AGENT']        = $_SERVER['HTTP_USER_AGENT'];
        $data['DEVICE_SESSION_ID'] = session_id() . microtime();
        $data['PAYER_COOKIE']      = session()->getId();

        return $data;
    }

    public function getPaginate($paginate, $skip): array
    {
        $count = ceil($paginate  / 10);
        $pageList = ($skip + 1) / 5;
        if (is_int($pageList) || $pageList > 1) {
            $page = $skip - 5;
            $max  = $skip + 6 > $count ? intval($skip + ($count - $skip)) : $skip + 6;
        } else {
            $page = 0;
            $max  = $skip + 5 > $count ? intval($skip + ($count - $skip)) : $skip + 5;
        }

        return [
            'paginate'  => $count,
            'position'  => $page,
            'page'      => $pageList,
            'limit'     => $max
        ];
    }

    public function deleteThumbFromServer(string $src): bool
    {
        if (File::exists(storage_path('app/public/' . $src))) {
            return  unlink(storage_path('app/public/' . $src));
        } else {
            return false;
        }
    }

    public function setSearchParameters($data)
    {
        $searchData = [];
        $searchData['skip']        = array_key_exists('skip', $data['search']) ? $data['search']['skip'] : 0;
        $searchData['fromOrigin']  = array_key_exists('from', $data['search']) && $data['search']['from'] != null ? $data['search']['from'] . " 00:00:01" : '';
        $searchData['toOrigin']    = array_key_exists('to', $data['search']) && $data['search']['to'] != null ? $data['search']['to'] . " 23:59:59" : '';
        $searchData['q']           = array_key_exists('q', $data['search']) ? $data['search']['q'] : '';
        $searchData['search']      = false;

        return $searchData;
    }

    public function setSearchParametersRefactor($data)
    {
        $searchData = [];
        $searchData['fromOrigin']  = array_key_exists('from', $data['search']) && $data['search']['from'] != null ? $data['search']['from'] . " 00:00:01" : null;
        $searchData['toOrigin']    = array_key_exists('to', $data['search']) && $data['search']['to'] != null ? $data['search']['to'] . " 23:59:59" : null;
        $searchData['q']           = array_key_exists('q', $data['search']) ? $data['search']['q'] : '';
        $searchData['search']      = array_key_exists('q', $data['search']) ? true : false;

        return $searchData;
    }

    public function getCammodelStatsPeriodDates(): array
    {
        $thisMonth1      = Carbon::now()->day(1)->format('Y-m-d 00:00:00');
        $thisMonth15     = Carbon::now()->day(15)->format('Y-m-d 00:00:00');
        $diffThisMonth1  = Carbon::now()->diffInDays($thisMonth1, false);
        $diffThisMonth15 = Carbon::now()->diffInDays($thisMonth15, false);

        if ($diffThisMonth1 < 0 && $diffThisMonth15 > 0) {
            return [
                Carbon::now()->day(1)->format('Y-m-d 00:00:00'),
                Carbon::now()->day(15)->format('Y-m-d 23:59:59')
            ];
        } elseif ($diffThisMonth1 < 0 && $diffThisMonth15 < 0) {
            return [
                Carbon::now()->day(16)->format('Y-m-d 00:00:00'),
                Carbon::now()->day(1)->addMonths(1)->format('Y-m-d 00:00:00')
            ];
        } elseif ($diffThisMonth1 > 0 && $diffThisMonth15 > 0) {
            return [
                Carbon::now()->day(1)->format('Y-m-d 00:00:00'),
                Carbon::now()->day(15)->format('Y-m-d 23:59:59')
            ];
        } elseif ($diffThisMonth1 == 0 || $diffThisMonth15 == 0) {
            return [
                Carbon::now()->day(1)->format('Y-m-d 00:00:00'),
                Carbon::now()->day(15)->format('Y-m-d 23:59:59')
            ];
        }
    }

    public function getPastFortnightDates(int $backFortnights = 0): array
    {
        $referenceDay = now();
        if ($backFortnights < 0) {
            $referenceDay->subMonths(intdiv($backFortnights - 1, 2));
        } else {
            $referenceDay->subMonths(intdiv($backFortnights, 2));
        }

        $thisMonth1      = $referenceDay->copy()->day(1)->format('Y-m-d 00:00:00');
        $thisMonth15     = $referenceDay->copy()->day(15)->format('Y-m-d 00:00:00');
        $diffThisMonth1  = $referenceDay->copy()->diffInDays($thisMonth1, false);
        $diffThisMonth15 = $referenceDay->copy()->diffInDays($thisMonth15, false);

        if ($diffThisMonth1 < 0 && $diffThisMonth15 < 0) {
            if ($backFortnights % 2 != 0) {
                return [
                    $referenceDay->copy()->day(1)->format('Y-m-d 00:00:00'),
                    $referenceDay->copy()->day(15)->format('Y-m-d 23:59:59')
                ];
            } else {
                return [
                    $referenceDay->copy()->day(16)->format('Y-m-d 00:00:00'),
                    $referenceDay->copy()->day(1)->addMonths(1)->format('Y-m-d 00:00:00')
                ];
            }
        } else {
            if ($backFortnights % 2 != 0) {
                $referenceDay->subMonth();
                return [
                    $referenceDay->copy()->day(16)->format('Y-m-d,00:00:00'),
                    $referenceDay->copy()->day(1)->addMonths(1)->format('Y-m-d 00:00:00')
                ];
            } else {
                return [
                    $referenceDay->copy()->day(1)->format('Y-m-d 00:00:00'),
                    $referenceDay->copy()->day(15)->format('Y-m-d 23:59:59')
                ];
            }
        }
    }

    public function getPayrollPeriodDates(): array
    {
        $dates      = $this->getCammodelStatsPeriodDates();
        $firstDate  = new Carbon($dates[0]);
        $secondDate = new Carbon($dates[1]);

        return [
            $secondDate->subMonth(1)->format('Y-m-d 00:00:00'),
            $firstDate->format('Y-m-d 00:00:00')
        ];
    }

    public function getMonthName(int $month): string
    {
        switch ($month) {
            case '1':
                return 'Enero';
            case '2':
                return 'Febrero';
            case '3':
                return 'Marzo';
            case '4':
                return 'Abril';
            case '5':
                return 'Mayo';
            case '6':
                return 'Junio';
            case '7':
                return 'Julio';
            case '8':
                return 'Agosto';
            case '9':
                return 'Septiembre';
            case '10':
                return 'Octubre';
            case '11':
                return 'Noviembre';
            case '12':
                return 'Diciembre';
        }
    }

    public function getTrimesterPosition(array $request): array
    {
        $actualMonth = array_key_exists('month', $request) && $request['month'] != '' ?
            Carbon::parse($request['month'] . '-01')->month :
            now()->month;

        $trimester = $actualMonth / 3;

        $year = array_key_exists('month', $request) && $request['month'] != '' ?
            Carbon::parse($request['month'] . '-01')->year :
            now()->year;

        return [$trimester, $year];
    }

    public function getFortnightsGap($request)
    {
        if ($request->has('month')) {
            if ($request['month'] != null) {
                $actualMonth    = now();
                $requestedMonth = Carbon::parse($request['month'] . '-01');
                $monthsDiff     = $actualMonth->diffInMonths($requestedMonth);
                $fortnightsGap  = $monthsDiff > 0 ? ($monthsDiff * 2) - 1 : 0;
                if ($actualMonth->day >= 16) {
                    $fortnightsGap = $fortnightsGap + 1;
                }
                return $fortnightsGap;
            }
        }

        if ($request->has('from')) {
            if ($request['from'] != null) {
                $actualMonth    = now();
                $requestedMonth = Carbon::parse($request['from']);
                $monthsDiff     = $actualMonth->diffInMonths($requestedMonth);
                $fortnightsGap  = $monthsDiff > 0 ? ($monthsDiff * 2) - 1 : 0;
                if ($actualMonth->day >= 16 && $requestedMonth->day < 16) {
                    $fortnightsGap = $fortnightsGap + 1;
                }
                return $fortnightsGap;
            }
        }

        return 0;
    }

    public function calculateChangeRate($actualValue, $previousValue)
    {
        $change_rate = $previousValue != 0 ?
            round((($actualValue -
                $previousValue) /
                $previousValue) * 100, 3) :
            "";

        return $change_rate;
    }

    public function setSignedUser()
    {
        return auth()->guard('employee')->user() ? auth()->guard('employee')->user() : auth()->guard('web')->user();
    }

    public static function setStaticSignedUser()
    {
        return auth()->guard('employee')->user() ? auth()->guard('employee')->user() : auth()->guard('web')->user();
    }

    public static function logException($errors)
    {
        if ($errors) {
            $logchannel = config('logging.channels.exceptions.name');

            if ($logchannel == null) {
                return false;
            }

            $user = ToolRepository::setStaticSignedUser();

            if ($user) {
                $message = 'User: ' . $user->name . ' ' . $user->last_name . ': ' . $errors;
            } else {
                $message = 'User: ' . 'No Usuario' . ': ' . $errors;
            }

            Log::channel($logchannel)->error($message);
        }
    }
}
