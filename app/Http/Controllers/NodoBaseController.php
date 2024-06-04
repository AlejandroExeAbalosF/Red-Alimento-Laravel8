<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NodoBase;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\NodoBaseExport;
use Barryvdh\DomPDF\Facade as PDF;

class NodoBaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $nodoBase = NodoBase::all();
        return view('panel.nodo_bases.index', compact('nodoBase'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('panel.nodo_bases.create');
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

        $nodoBase = NodoBase::create($request->all());
         return redirect()->route('panel.nodo_bases.index', $nodoBase)->with('mensaje', 'Nodo Base guardado con exito.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(NodoBase $nodoBase)
    {
        //
        return view('panel.nodo_bases.show', compact('nodoBase'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(NodoBase $nodoBase)
    {
        //
        return view('panel.nodo_bases.edit', compact('nodoBase'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, NodoBase $nodoBase)
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

        $nodoBase->update($request->all());
        return redirect()->route('panel.nodo_bases.index', $nodoBase)->with('mensaje', 'Nodo Base actualizado.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(NodoBase $nodoBase)
    {
        //
        $nodoBase->delete();
        return redirect()->route('panel.nodo_bases.index', $nodoBase)->with('eliminar', 'Ok');
    }

    //Exportar a excel
    public function exportarNodoBaseExcel()
    {
        return Excel::download(new NodoBaseExport, 'nodoBase.xlsx');
    }

    public function exportarNodoBasePDF()
    {
        $nodoBase = NodoBase::all();
        $pdf= \PDF::loadView('panel.nodo_bases.pdf_nodoBase', compact('nodoBase'));
        $pdf->render();
        return $pdf->stream('nodoBase.pdf');
    }
}
