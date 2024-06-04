<?php

namespace App\Exports;

use App\Models\NodoDistribuidor;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class NodoDistribuidorExport implements FromCollection,  WithHeadings
{
    public function headings(): array
    {
        return [
            'id', 'nombre', 'email', 'direccion', 'celular', 'nodoBase',
        ];
    }

    public function collection()
    {
        return NodoDistribuidor::select('nodo_distribuidors.id', 'nodo_distribuidors.nombre', 'nodo_distribuidors.email',
                'nodo_distribuidors.direccion', 'nodo_distribuidors.celular','nodo_bases.nombre as nodoBase')
            ->join('nodo_bases', 'nodo_base_id', 'nodo_distribuidors.nodo_base_id')
            ->get();
    }
}
