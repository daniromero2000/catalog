<?php

namespace Modules\Ecommerce\Entities\Products\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Modules\Ecommerce\Entities\ProductAttributes\ProductAttribute;

class ExportProductAttributes implements FromCollection, WithHeadings
{
    private $columns = [
        'id', 'quantity', 'price', 'sale_price', 'product_id'
    ];

    public function headings(): array
    {
        return [
            'id', 'cantidad', 'precio', 'precio_oferta', 'product_id', 'sku', 'nombre', 'atributos'
        ];
    }

    public function collection()
    {
        $productAttributes = ProductAttribute::get($this->columns);

        foreach ($productAttributes as $values => $value) {
            $atributos = '';
            $productAttributes[$values]->sku = $value->product->sku;
            $productAttributes[$values]->name = $value->product->name;

            foreach ($value->attributesValuesForExport as $key => $value) {
                $atributos = $atributos . ' ' .  $value->value;
            }

            $productAttributes[$values]->attributes = $atributos;
        }

        return $productAttributes;
    }
}
