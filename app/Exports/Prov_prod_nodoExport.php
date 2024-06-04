<?php

namespace App\Exports;

use App\Models\Prov_prod_nodo;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class Prov_prod_nodoExport implements FromCollection, WithHeadings
{
    public function headings(): array
    {
        return [
            'id', 'fecha_limite_promesa', 'precio_x_kg', 'precio_final', 'precio_final2', 'producto',
        ];
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Prov_prod_nodo::select('prov_prod_nodos.id', 'fecha_limite_promesa', 'precio_x_kg', 'precio_final','precio_final2', 'productos.nombre as producto')
            ->join('productos', 'producto_id', 'prov_prod_nodos.producto_id')
            ->get();
    }
}
