<?php

namespace Modules\Ecommerce\Database\Seeders;

use Modules\Ecommerce\Entities\Attributes\Attribute;
use Modules\Ecommerce\Entities\AttributeValues\AttributeValue;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class AttributeTableSeeder extends Seeder
{
    public function run()
    {
        Model::unguard();

        $sizeAttr = Attribute::factory()->create(['name' => 'Tamaño']);
        AttributeValue::factory()->create([
            'value' => 'S',
            'description' => 'Pequeño',
            'attribute_id' => $sizeAttr->id,
            'sort_order' => 1
        ]);

        AttributeValue::factory()->create([
            'value' => 'M',
            'description' => 'Mediano',
            'attribute_id' => $sizeAttr->id,
            'sort_order' => 2
        ]);

        AttributeValue::factory()->create([
            'value' => 'L',
            'description' => 'Grande',
            'attribute_id' => $sizeAttr->id,
            'sort_order' => 3
        ]);

        $tallaAttr = Attribute::factory()->create(['name' => 'Talla']);
        AttributeValue::factory()->create([
            'value' => 19,
            'attribute_id' => $tallaAttr->id,
            'sort_order' => 1
        ]);

        AttributeValue::factory()->create([
            'value' => 20,
            'attribute_id' => $tallaAttr->id,
            'sort_order' => 2
        ]);

        AttributeValue::factory()->create([
            'value' => 21,
            'attribute_id' => $tallaAttr->id,
            'sort_order' => 3
        ]);

        AttributeValue::factory()->create([
            'value' => 22,
            'attribute_id' => $tallaAttr->id,
            'sort_order' => 4
        ]);

        AttributeValue::factory()->create([
            'value' => 23,
            'attribute_id' => $tallaAttr->id,
            'sort_order' => 5
        ]);

        AttributeValue::factory()->create([
            'value' => 24,
            'attribute_id' => $tallaAttr->id,
            'sort_order' => 6
        ]);

        AttributeValue::factory()->create([
            'value' => 25,
            'attribute_id' => $tallaAttr->id,
            'sort_order' => 7
        ]);

        AttributeValue::factory()->create([
            'value' => 26,
            'attribute_id' => $tallaAttr->id,
            'sort_order' => 8
        ]);

        AttributeValue::factory()->create([
            'value' => 27,
            'attribute_id' => $tallaAttr->id,
            'sort_order' => 9
        ]);

        AttributeValue::factory()->create([
            'value' => 28,
            'attribute_id' => $tallaAttr->id,
            'sort_order' => 10
        ]);

        AttributeValue::factory()->create([
            'value' => 29,
            'attribute_id' => $tallaAttr->id,
            'sort_order' => 10
        ]);

        AttributeValue::factory()->create([
            'value' => 30,
            'attribute_id' => $tallaAttr->id,
            'sort_order' => 11
        ]);

        AttributeValue::factory()->create([
            'value' => 31,
            'attribute_id' => $tallaAttr->id,
            'sort_order' => 12
        ]);

        AttributeValue::factory()->create([
            'value' => 32,
            'attribute_id' => $tallaAttr->id,
            'sort_order' => 13
        ]);

        AttributeValue::factory()->create([
            'value' => 33,
            'attribute_id' => $tallaAttr->id,
            'sort_order' => 14
        ]);

        AttributeValue::factory()->create([
            'value' => 34,
            'attribute_id' => $tallaAttr->id,
            'sort_order' => 15
        ]);

        AttributeValue::factory()->create([
            'value' => 35,
            'attribute_id' => $tallaAttr->id,
            'sort_order' => 16
        ]);

        AttributeValue::factory()->create([
            'value' => 36,
            'attribute_id' => $tallaAttr->id,
            'sort_order' => 17
        ]);

        AttributeValue::factory()->create([
            'value' => 37,
            'attribute_id' => $tallaAttr->id,
            'sort_order' => 18
        ]);

        AttributeValue::factory()->create([
            'value' => 38,
            'attribute_id' => $tallaAttr->id,
            'sort_order' => 19
        ]);

        AttributeValue::factory()->create([
            'value' => 39,
            'attribute_id' => $tallaAttr->id,
            'sort_order' => 20
        ]);

        AttributeValue::factory()->create([
            'value' => 40,
            'attribute_id' => $tallaAttr->id,
            'sort_order' => 21
        ]);

        AttributeValue::factory()->create([
            'value' => 41,
            'attribute_id' => $tallaAttr->id,
            'sort_order' => 22
        ]);

        AttributeValue::factory()->create([
            'value' => 42,
            'attribute_id' => $tallaAttr->id,
            'sort_order' => 23
        ]);

        AttributeValue::factory()->create([
            'value' => 43,
            'attribute_id' => $tallaAttr->id,
            'sort_order' => 24
        ]);

        $colorAttr = Attribute::factory()->create(['name' => 'Color']);
        AttributeValue::factory()->create([
            'value' => 'Rojo',
            'description' => 'ff0000',
            'attribute_id' => $colorAttr->id,
            'sort_order' => 1
        ]);

        AttributeValue::factory()->create([
            'value' => 'Amarillo',
            'description' => 'ffff00',
            'attribute_id' => $colorAttr->id,
            'sort_order' => 2
        ]);

        AttributeValue::factory()->create([
            'value' => 'Azul',
            'description' => '0000ff',
            'attribute_id' => $colorAttr->id,
            'sort_order' => 3
        ]);

        AttributeValue::factory()->create([
            'value' => 'Negro',
            'description' => '000000',
            'attribute_id' => $colorAttr->id,
            'sort_order' => 4
        ]);

        AttributeValue::factory()->create([
            'value' => 'Verde',
            'description' => '008000',
            'attribute_id' => $colorAttr->id,
            'sort_order' => 5
        ]);

        AttributeValue::factory()->create([
            'value' => 'Marrón',
            'description' => 'a52a2a',
            'attribute_id' => $colorAttr->id,
            'sort_order' => 6
        ]);

        AttributeValue::factory()->create([
            'value' => 'Violeta',
            'description' => 'ee82ee',
            'attribute_id' => $colorAttr->id,
            'sort_order' => 7
        ]);

        AttributeValue::factory()->create([
            'value' => 'Naranja',
            'description' => 'ffa500',
            'attribute_id' => $colorAttr->id,
            'sort_order' => 8
        ]);

        AttributeValue::factory()->create([
            'value' => 'Rosa',
            'description' => 'ffc0cb',
            'attribute_id' => $colorAttr->id,
            'sort_order' => 9
        ]);

        AttributeValue::factory()->create([
            'value' => 'Purpura',
            'description' => '800080',
            'attribute_id' => $colorAttr->id,
            'sort_order' => 10
        ]);

        AttributeValue::factory()->create([
            'value' => 'Gris',
            'description' => '808080',
            'attribute_id' => $colorAttr->id,
            'sort_order' => 11
        ]);

        AttributeValue::factory()->create([
            'value' => 'Blanco',
            'description' => 'ffffff',
            'attribute_id' => $colorAttr->id,
            'sort_order' => 12
        ]);
    }
}
