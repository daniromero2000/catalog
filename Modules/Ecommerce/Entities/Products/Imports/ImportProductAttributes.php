<?php

namespace Modules\Ecommerce\Entities\Products\Imports;

use Maatwebsite\Excel\Row;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Modules\Ecommerce\Entities\ProductAttributes\ProductAttribute;

class ImportProductAttributes implements OnEachRow, WithHeadingRow
{
    public function onRow(Row $row)
    {
        $row = $row->toArray();
        $attributes = ProductAttribute::find([
            'id' => $row['id']
        ]);

        foreach ($attributes as $key => $attribute) {
            $attribute->quantity = $row['cantidad'];
            $attribute->price = $row['precio'];
            $attribute->sale_price = $row['precio_oferta'];
            $attribute->save();
        }
    }
}
