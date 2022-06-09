<?php

namespace Modules\Generals\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Generals\Entities\SocialMedias\SocialMedia;

class SocialMediaTableSeeder extends Seeder
{
    public function run()
    {
        Model::unguard();

        SocialMedia::factory()->create([
            'social' => 'Facebook',
            'url'    => 'www.facebook.com'
        ]);

        SocialMedia::factory()->create([
            'social' => 'Instagram',
            'url'    => 'www.instagram.com'
        ]);

        SocialMedia::factory()->create([
            'social' => 'Twitter',
            'url'    => 'www.twitter.com'
        ]);

        SocialMedia::factory()->create([
            'social' => 'Linkedin',
            'url'    => 'www.linkedin.com'
        ]);

        SocialMedia::factory()->create([
            'social' => 'Skype',
            'url'    => 'www.Skype.com'
        ]);

        SocialMedia::factory()->create([
            'social' => 'SnapChat',
            'url'    => 'www.SnapChat.com'
        ]);
    }
}
