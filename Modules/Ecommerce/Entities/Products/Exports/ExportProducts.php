<?php

namespace Modules\Ecommerce\Entities\Products\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Modules\Ecommerce\Entities\Products\Product;


class ExportProducts implements FromCollection, WithHeadings
{
    private $columns = [
        'id',
        'sku',
        'name',
        'description',
        'quantity',
        'price',
        'sale_price',
        'is_active'
    ];


    public function headings(): array
    {
        return [
            'id',
            'sku',
            'nombre',
            'description',
            'cantidad',
            'precio',
            'precio_oferta',
            'activo'
        ];
    }

    public function collection()
    {
        return  Product::with('attributes')->get($this->columns);
    }
}
