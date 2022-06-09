<?php

namespace Modules\Streamings\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Streamings\Entities\Streamings\Streaming;

class StreamingTableSeeder extends Seeder
{
    public function run()
    {
        Model::unguard();
        Streaming::factory()->create([
            'streaming' => 'Chaturbate',
            'url'    => 'www.Chaturbate.com'
        ]);

        Streaming::factory()->create([
            'streaming' => 'MyFreeCams',
            'url'    => 'www.MyFreeCams.com'
        ]);

        Streaming::factory()->create([
            'streaming' => 'Cam4',
            'url'    => 'www.Cam4.com'
        ]);

        Streaming::factory()->create([
            'streaming' => 'CamSoda',
            'url'    => 'www.CamSoda.com'
        ]);

        Streaming::factory()->create([
            'streaming' => 'BongaCams',
            'url'    => 'www.BongaCams.com'
        ]);

        Streaming::factory()->create([
            'streaming' => 'Naked',
            'url'    => 'www.Naked.com'
        ]);

        Streaming::factory()->create([
            'streaming' => 'StripChat',
            'url'    => 'www.StripChat.com'
        ]);

        Streaming::factory()->create([
            'streaming' => 'Streamate',
            'url'    => 'www.Streamate.com'
        ]);

        Streaming::factory()->create([
            'streaming' => 'LiveJasmin',
            'url'    => 'www.LiveJasmin.com'
        ]);

        Streaming::factory()->create([
            'streaming' => 'Camlicious',
            'url'    => 'www.Camlicious.com'
        ]);

        Streaming::factory()->create([
            'streaming' => 'Ufancyme',
            'url'    => 'www.Ufancyme.com'
        ]);

        Streaming::factory()->create([
            'streaming' => 'StreamRay',
            'url'    => 'www.streamray.com'
        ]);

        Streaming::factory()->create([
            'streaming' => 'Flirt4Free',
            'url'    => 'www.Flirt4Free.com'
        ]);

        Streaming::factory()->create([
            'streaming' => 'SkyPrivate',
            'url'    => 'www.SkyPrivate.com'
        ]);

        Streaming::factory()->create([
            'streaming' => 'ManyVids',
            'url'    => 'www.ManyVids.com'
        ]);

        Streaming::factory()->create([
            'streaming' => 'Factoring',
            'url'    => 'www.Xisfo.com'
        ]);

        Streaming::factory()->create([
            'streaming' => 'EpayService',
            'url'    => 'www.EpayService.com'
        ]);

        Streaming::factory()->create([
            'streaming' => 'MyDirtyHobby',
            'url'    => 'www.MyDirtyHobby.com'
        ]);

        Streaming::factory()->create([
            'streaming' => 'XloveCam',
            'url'    => 'www.xlovecam.com/'
        ]);
    }
}
