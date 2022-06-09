<?php

namespace Modules\CamStudio\Entities\BannedCountriesProtectionBanner;

use Illuminate\Http\Request;
use Modules\CamStudio\Entities\Cammodels\Repositories\CammodelRepository;

class BannedCountriesProtectionBanner
{
    public static function generate_accept_link(Request $r)
    {
        $cammodelSlug = $r->route()->slug;
        $ses_name     = config('bannedcountriesprotectionbanner.ses_name');
        $return_link  = $r->url();

        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $data['ip'] = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $data['ip'] = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $data['ip'] = $_SERVER['REMOTE_ADDR'];
        }

        $xml                     = simplexml_load_file("http://www.geoplugin.net/xml.gp?ip=" . $data['ip']);
        $country                 = (string)strtolower($xml->geoplugin_countryName);
        $cammodelBannedCountries = CammodelRepository::findCammodelBySlugStatic($cammodelSlug)->cammodelBannedCountries;

        foreach ($cammodelBannedCountries as $key => $value) {
            $cammodelBannedCountry = (string)strtolower($value->country->name);

            if ($country == $cammodelBannedCountry) {
                $return_link = $return_link . '?' . $ses_name . '=yes';
                $r[$ses_name] = 'yes';

                return $return_link;
            }
        }

        $return_link = $return_link . '?' . $ses_name . '=no';
        $r[$ses_name] = 'no';

        return $return_link;
    }
}
