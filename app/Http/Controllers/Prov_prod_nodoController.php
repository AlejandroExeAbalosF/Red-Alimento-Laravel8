<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NodoBase;
use App\Models\NodoDistribuidor;
use App\Models\Producto;
use App\Models\Proveedor;
use App\Models\Prov_prod_nodo;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\Prov_prod_nodoExport;
use Barryvdh\DomPDF\Facade as PDF;


class Prov_prod_nodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $promesa = Prov_prod_nodo::all();
        return view('panel.promesas.index', compact('promesa'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $promesa = new Prov_prod_nodo();
        $nodoBase =  NodoBase::get();
        $nodoDistribuidor = NodoDistribuidor::get();
        $producto = Producto::get();
        $proveedore = Proveedor::get();

        return view('panel.promesas.create', compact('promesa','nodoBase', 'nodoDistribuidor', 'producto', 'proveedore'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $request->validate(
            [
                'nodo_base_id' => 'required', 
                'nodo_distribuidor_id' => 'required',
                'producto_id' => 'required',
                'proveedor_id' => 'required',
                'fecha_limite_promesa' => 'required',
                
                'stock' => 'required', 
                'precio_x_cajon' => 'required',
                'kg_x_cajon' => 'required',
                'precio_x_kg' => 'required', 
                'precio_final' => 'required',
                'precio_final2' => 'required',
            ]);

        $promesa = new Prov_prod_nodo();

        $promesa->nodo_base_id = $request->get('nodo_base_id');
        $promesa->nodo_distribuidor_id = $request->get('nodo_distribuidor_id');
        $promesa->producto_id = $request->get('producto_id');
        $promesa->proveedor_id = $request->get('proveedor_id');
        $promesa->fecha_limite_promesa = $request->get('fecha_limite_promesa');

        $promesa->stock = $request->get('stock');
        $promesa->precio_x_cajon = $request->get('precio_x_cajon');
        $promesa->kg_x_cajon = $request->get('kg_x_cajon');
        $promesa->merma = $request->get('merma');
        $promesa->precio_x_kg = $request->get('precio_x_kg');
        $promesa->flete = $request->get('flete');
        $promesa->precio_flete = $request->get('precio_flete');
        $promesa->porcentaje_red = $request->get('porcentaje_red');
        $promesa->porcentaje_nodoD = $request->get('porcentaje_nodoD');
        $promesa->precio_final = $request->get('precio_final');

        $promesa->precio_flete2 = $request->get('precio_flete2');
        $promesa->precio_final2 = $request->get('precio_final2');

        $promesa->save();

        return redirect()->route('panel.promesas.index', $promesa)->with('mensaje','Promesa guardada con exito.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Prov_prod_nodo $promesa)
    {
       
        return view('panel.promesas.show', compact('promesa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Prov_prod_nodo $promesa)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Prov_prod_nodo $promesa)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Prov_prod_nodo $promesa)
    {
        $promesa->delete();

        return redirect()->route('panel.promesas.index', $promesa)->with('eliminar', 'Ok');
    }

    //Exportar a excel
    public function exportarProv_prod_nodoExcel()
    {
        return Excel::download(new Prov_prod_nodoExport, 'prov_prod_nodo.xlsx');
    }

    public function exportarProv_prod_nodoPDF()
    {
        $promesa = Prov_prod_nodo::all();
        $pdf= \PDF::loadView('panel.promesas.pdf_promesas', compact('promesa'));
        $pdf->render();
        return $pdf->stream('prov_prod_nodo.pdf');
    }
}
