<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class ProductExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
          return Product::select(
                'products.id',
                'products.name',
                'products.price',
                'products.description',
                'categories.name as category_name',
                'products.stock',
                'products.created_at'
            )
            ->leftJoin('categories', 'products.category_id', '=', 'categories.id')
            ->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Price',
            'Description',
            'Category',
            'stock',
            'Created_at'
        ];
    }
}
