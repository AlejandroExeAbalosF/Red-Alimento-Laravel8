<?php

namespace App\Exports;

use App\Models\Caja;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CajaExport implements FromCollection, WithHeadings
{
    public function headings(): array
    {
        return [
            'id', 'monto_inicial', 'total_ventas', 'total_compras', 'monto_final', 'estado'
        ];
    }

    public function collection()
    {
        return Caja::select('cajas.id', 'monto_inicial', 'total_ventas', 'total_compras', 'monto_final', 'estado')
            ->join('users', 'user_id', 'cajas.user_id')
            ->get();
    }
}
