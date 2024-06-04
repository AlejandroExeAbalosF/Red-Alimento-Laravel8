<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NodoBase;
use App\Models\NodoDistribuidor;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\NodoDistribuidorExport;
use Barryvdh\DomPDF\Facade as PDF;

class NodoDistribuidorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $nodoDistribuidor = NodoDistribuidor::all();
        return view('panel.nodo_distribuidor.index', compact('nodoDistribuidor'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $nodoDistribuidor = new NodoDistribuidor();
        $nodoBase =  NodoBase::get();

        return view('panel.nodo_distribuidor.create', compact('nodoDistribuidor','nodoBase'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate(
            [
                'nombre' => 'required',
                'email' => 'required',
                'direccion' => 'required',
                'provincia' => 'required',
                'celular' => 'required',
            ]);

        $nodoDistribuidor = new NodoDistribuidor();

        $nodoDistribuidor->nombre = $request->get('nombre');
        $nodoDistribuidor->email = $request->get('email');
        $nodoDistribuidor->direccion = $request->get('direccion');
        $nodoDistribuidor->provincia = $request->get('provincia');
        $nodoDistribuidor->celular = $request->get('celular');
        $nodoDistribuidor->zona = $request->get('zona');
        $nodoDistribuidor->nodo_base_id = $request->get('nodo_base_id');

        $nodoDistribuidor->save();

         return redirect()->route('panel.nodo_distribuidor.index', $nodoDistribuidor)->with('mensaje', 'Nodo Distribuidor guardado con exito.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(NodoDistribuidor $nodoDistribuidor)
    {
        //
        return view('panel.nodo_distribuidor.show', compact('nodoDistribuidor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(NodoDistribuidor $nodoDistribuidor)
    {
        //
        $nodoBase =  NodoBase::get();
        return view('panel.nodo_distribuidor.edit', compact('nodoDistribuidor', 'nodoBase'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, NodoDistribuidor $nodoDistribuidor)
    {
        //
        $request->validate(
            [
                'nombre' => 'required',
                'email' => 'required',
                'direccion' => 'required',
                'provincia' => 'required',
                'celular' => 'required',
            ]);

        //$nodoDistribuidor = new NodoDistribuidor();

        $nodoDistribuidor->nombre = $request->get('nombre');
        $nodoDistribuidor->email = $request->get('email');
        $nodoDistribuidor->direccion = $request->get('direccion');
        $nodoDistribuidor->provincia = $request->get('provincia');
        $nodoDistribuidor->celular = $request->get('celular');
        $nodoDistribuidor->zona = $request->get('zona');
        $nodoDistribuidor->nodo_base_id = $request->get('nodo_base_id');

        $nodoDistribuidor->save();

        return redirect()->route('panel.nodo_distribuidor.index', $nodoDistribuidor)->with('mensaje', 'Nodo Distribuidor actualizado.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(NodoDistribuidor $nodoDistribuidor)
    {
        //
        $nodoDistribuidor->delete();
        return redirect()->route('panel.nodo_distribuidor.index', $nodoDistribuidor)->with('eliminar', 'Ok');
    }

    //Exportar a excel
    public function exportarNodoDistribuidorExcel()
    {
        return Excel::download(new NodoDistribuidorExport, 'nodoDistribuidor.xlsx');
    }

    public function exportarNodoDistribuidorPDF()
    {
        $nodoDistribuidor = NodoDistribuidor::all();
        $pdf= \PDF::loadView('panel.nodo_distribuidor.pdf_nodoDistribuidor', compact('nodoDistribuidor'));
        $pdf->render();
        return $pdf->stream('nodoDistribuidor.pdf');
    }
}
