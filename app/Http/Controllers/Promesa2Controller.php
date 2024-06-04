<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NodoBase;
use App\Models\NodoDistribuidor;
use App\Models\Producto;
use App\Models\Proveedor;
use App\Models\Prov_prod_nodo;

class Promesa2Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $promesa2 = new Prov_prod_nodo();
        $nodoBase =  NodoBase::get();
        $nodoDistribuidor = NodoDistribuidor::get();
        $producto = Producto::get();
        $proveedore = Proveedor::get();

        return view('panel.promesas.prome2.create', compact('promesa2', 'nodoBase', 'nodoDistribuidor', 'producto', 'proveedore'));
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
                'precio_kg' => 'required', 
                'prec_final' => 'required',
            ]);

        $promesa2 = new Prov_prod_nodo();

        $promesa2->nodo_base_id = $request->get('nodo_base_id');
        $promesa2->nodo_distribuidor_id = $request->get('nodo_distribuidor_id');
        $promesa2->producto_id = $request->get('producto_id');
        $promesa2->proveedor_id = $request->get('proveedor_id');
        $promesa2->fecha_limite_promesa = $request->get('fecha_limite_promesa');

        $promesa2->stock = $request->get('stock');
        $promesa2->precio_x_cajon = $request->get('precio_x_cajon');
        $promesa2->kg_x_cajon = $request->get('kg_x_cajon');
        $promesa2->merma = $request->get('merma');
        $promesa2->precio_x_kg = $request->get('precio_kg');
        $promesa2->flete = $request->get('flete');
        $promesa2->precio_flete = $request->get('precio_flete');
        $promesa2->porcentaje_red = $request->get('porcen_red');
        $promesa2->porcentaje_nodoD = $request->get('porcen_nodoD');
        $promesa2->precio_final = $request->get('prec_final');

        $promesa2->precio_flete2 = $request->get('precio_flete2');
        $promesa2->precio_final2 = $request->get('precio_final2');

        $promesa2->save();

        return redirect()->route('panel.promesas.index', $promesa2)->with('mensaje','Promesa guardada con exito.');
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
