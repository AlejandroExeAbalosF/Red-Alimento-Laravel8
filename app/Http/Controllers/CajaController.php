<?php

namespace App\Http\Controllers;

//use Caja;

use App\Models\ArqueoCaja;
use Illuminate\Http\Request;
use App\Models\Caja;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CajaExport;
use Barryvdh\DomPDF\Facade as PDF;




class CajaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //Lee todo los registro
    public function index()
    {
        //
        $cajas = Caja::all();
        return view('panel.cajas.index', compact('cajas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    //Abrir el formulario para nuevo registro
    public function create()
    {
        //
        //$now = Carbon::now();
        return view('panel.cajas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    //Para guardar en la BD
    public function store(Request $request)
    {
        //Pone los campos del formulario como requeridos
        $request->validate(
            [
                'monto_inicial' => 'required',
            ]);
        
        // Se guarda en tabla Caja
        $caja = new Caja();
        $caja->monto_inicial = $request->get('monto_inicial');
        $caja->user_id = auth()->user()->id;
        $caja->save();
        
        // Se guarda en tabla Arqueo de Caja
        $arqueo_caja = new ArqueoCaja();
        $arqueo_caja->caja_id = $caja->id;
        $arqueo_caja->user_id = auth()->user()->id;
        $arqueo_caja->save();

        return redirect()->route('panel.cajas.index',$caja)->with('mensaje','Caja Abierta');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //Para visualizar UN solo registro a detalle
    public function show(Caja $caja)
    {
        //
        return view('panel.cajas.show', compact('caja'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //Para abrir formulario para editar el registro
    public function edit(Caja $caja)
    {
        //
        return view('panel.cajas.edit', compact('caja'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //Para actualizar el registro
    public function update(Request $request, Caja $caja)
    {
        //
        $request->validate(
            [
                'fecha_hora_cierre' => 'required',
                'monto_inicial' => 'required',
                'total_ventas' => 'required',
                'total_compras' => 'required',
                'saldo_contable' => 'required',
                'monto_final' => 'required',
            ]);
        
        $caja->fecha_hora_cierre = $request->get('fecha_hora_cierre');
        $caja->monto_inicial = $request->get('monto_inicial');
        $caja->total_ventas = $request->get('total_ventas');
        $caja->total_compras = $request->get('total_compras');
        $caja->saldo_contable = $request->get('saldo_contable');
        $caja->faltante = $request->get('faltante');
        $caja->sobrante = $request->get('sobrante');
        $caja->monto_final = $request->get('monto_final');
        $caja->estado = 0;

        $caja->update();
        return redirect()->route('panel.cajas.index', $caja)->with('mensaje','Caja Cerrada');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //Para eliminar el registro
    public function destroy(Caja $caja)
    {
        //
    }

    //Exportar a excel
    public function exportarCajaExcel()
    {
        return Excel::download(new CajaExport, 'caja.xlsx');
    }

    public function exportarCajaPDF()
    {
        $caja = Caja::where('user_id', auth()->user()->id)->get();
        $pdf= \PDF::loadView('panel.cajas.pdf_caja', compact('caja'));
        $pdf->render();
        return $pdf->stream('caja.pdf');
    }
}
