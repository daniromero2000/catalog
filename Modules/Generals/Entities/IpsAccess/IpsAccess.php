<?php

namespace Modules\Generals\Entities\IpsAccess;

use Illuminate\Http\Request;

class IpsAccess
{
    public static function checkIpAccess(Request $r)
    {
        $ses_name    = config('ipsaccess.ses_name');
        $return_link = $r->url();
        $return_link = $return_link . '?' . $ses_name . '=yes';

        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $data['ip'] = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $data['ip'] = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $data['ip'] = $_SERVER['REMOTE_ADDR'];
        }

        $allowedIps = [
            '127.0.0.1',
            //principal Admini
            '181.129.222.18',
            '181.129.222.19',
            '181.129.222.20',
            '181.129.222.21',
            '181.129.222.22',
            //principal Rooms
            '200.91.220.66',
            '200.91.220.67',
            '200.91.220.68',
            '200.91.220.69',
            '200.91.220.70',
            //Lago
            '181.129.213.132',
            '181.129.213.131',
            '181.129.213.133',
            '181.129.213.134',
            '181.129.213.130',
            '181.129.213.122',
            '181.129.213.123',
            '181.129.213.124',
            '181.129.213.125',
            '181.129.213.126',
            //Manizales
            '200.91.220.178',
            '200.91.220.179',
            '200.91.220.180',
            '200.91.220.181',
            '200.91.220.182',
            //Santa Monica
            '200.91.224.50',
            '200.91.224.51',
            '200.91.224.52',
            '200.91.224.53',
            '200.91.224.54',
            //Andrés Socio Manizales
            '181.133.86.112',
            '186.83.184.174'
        ];

        if (in_array($data['ip'], $allowedIps)) {
            $return_link = $return_link . '?' . $ses_name . '=no';
            $r[$ses_name] = 'no';

            return $return_link;
        }

        $return_link = $return_link . '?' . $ses_name . '=yes';
        $r[$ses_name] = 'yes';

        return $return_link;
    }
}
