<?php

namespace App\Http\Controllers;
use App\Models\Proveedor;
use Illuminate\Http\Request;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ProveedoreExport;
use Barryvdh\DomPDF\Facade as PDF;

class ProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $proveedor = Proveedor::all();
        return view('panel.proveedores.index', compact('proveedor'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $proveedor = new Proveedor();
        return view('panel.proveedores.create', compact('proveedor'));
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
                'apellido' => 'required',
                'razon_social' => 'required',
                'direccion' => 'required',
                'provincia' => 'required',
                'region' => 'required',
                'email' => 'required',
                'celular' => 'required',
                'telefono' => 'required',
                'cuil' => 'required',
            ]);

        $proveedor = new Proveedor();

        $proveedor->nombre = $request->get('nombre');
        $proveedor->apellido = $request->get('apellido');
        $proveedor->razon_social = $request->get('razon_social');
        $proveedor->direccion = $request->get('direccion');
        $proveedor->provincia = $request->get('provincia');
        $proveedor->region = $request->get('region');
        $proveedor->email = $request->get('email');
        $proveedor->celular = $request->get('celular');
        $proveedor->telefono = $request->get('telefono');
        $proveedor->cuil = $request->get('cuil');

        $proveedor->save();
    
        return redirect()->route('panel.proveedores.index', $proveedor)->with('mensaje','Producto guardado con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Proveedor $proveedore)
    {
        //
        
        return view('panel.proveedores.editar', compact('proveedore'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Proveedor $proveedore)
    {
        //
        $request->validate(
            [
                'nombre' => 'required',
                'apellido' => 'required',
                'razon_social' => 'required',
                'direccion' => 'required',
                'provincia' => 'required',
                'region' => 'required',
                'email' => 'required',
                'celular' => 'required',
                'telefono' => 'required',
                'cuil' => 'required',
            ]);

      

        $proveedore->nombre = $request->get('nombre');
        $proveedore->apellido = $request->get('apellido');
        $proveedore->razon_social = $request->get('razon_social');
        $proveedore->direccion = $request->get('direccion');
        $proveedore->provincia = $request->get('provincia');
        $proveedore->region = $request->get('region');
        $proveedore->email = $request->get('email');
        $proveedore->celular = $request->get('celular');
        $proveedore->telefono = $request->get('telefono');
        $proveedore->cuil = $request->get('cuil');

        $proveedore->update();
    
        return redirect()->route('panel.proveedores.index', $proveedore)->with('mensaje','Producto guardado con exito');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Proveedor $proveedore)
    {
        //
        $proveedore->delete();

        return redirect()->route('panel.proveedores.index', $proveedore)->with('eliminar', 'Ok');
    }

    //Exportar a excel
    public function exportarProveedoreExcel()
    {
        return Excel::download(new ProveedoreExport, 'proveedores.xlsx');
    }

    public function exportarProveedorePDF ()
    {
        $proveedore = Proveedor::all();
        $pdf= \PDF::loadView('panel.proveedores.pdf_proveedor', compact('proveedore'));
        $pdf->render();
        return $pdf->stream('proveedore.pdf');
    }

}
