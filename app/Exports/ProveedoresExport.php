<?php

namespace App\Exports;

use App\Models\Proveedore;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProveedoresExport implements FromCollection, WithHeadings
{
    public function headings(): array
    {
        return [
            'id', 'nombre', 'apellido', 'direccion', 'provincia',
        ];
    }

    public function collection()
    {
        return Proveedore::select('proveedores.id', 'nombre', 'apellido', 'direccion', 'provincia')
            //->join('users', 'user_id', 'cajas.user_id')
            ->get();
    }
}
