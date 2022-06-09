<?php

namespace Modules\Streamings\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class StreamingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Streamings\Entities\Streamings\Streaming::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'streaming' => 'Chaturbate',
            'url'       => 'www.chaturbate.com'
        ];
    }
}
