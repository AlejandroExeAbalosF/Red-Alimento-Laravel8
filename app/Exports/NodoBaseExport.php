<?php

namespace App\Exports;

use App\Models\NodoBase;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class NodoBaseExport implements FromCollection, WithHeadings
{
    public function headings(): array
    {
        return [
            'id', 'nombre', 'email', 'direccion', 'provincia', 'celular',
        ];
    }

    public function collection()
    {
        return NodoBase::select('nodo_bases.id', 'nombre', 'email', 'direccion', 'provincia', 'celular')
            //->join('users', 'user_id', 'cajas.user_id')
            ->get();
    }
}