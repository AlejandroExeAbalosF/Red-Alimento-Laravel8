<?php

namespace App\Exports;

use App\Models\Producto;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductosExport implements FromCollection, WithHeadings
{
    public function headings(): array
    {
        return [
            'id', 'nombre', 'descripcion', 'temporada', 'categoria',
        ];
    }

    public function collection()
    {
        return Producto::select('productos.id', 'productos.nombre', 'descripcion', 'temporada', 'categorias.nombre as categoria')
            ->join('categorias', 'categorias_id', 'productos.categorias_id')
            ->get();
    }
}
