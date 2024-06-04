<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Categoria;

//Para eliminar la imagen
//use Illuminate\Support\Facades\Storage;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ProductosExport;
use Barryvdh\DomPDF\Facade as PDF;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $producto = Producto::all();
        return view('panel.productos.index', compact('producto'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $producto = new Producto();
        $categoria = Categoria::get();
        return view('panel.productos.create', compact('producto', 'categoria'));
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
                'nombre' => 'required',
                'imagen' => 'required | max:10000' ,
                'categoria_id' => 'required',
            ]);

        $producto = new Producto();

        $producto->nombre = $request->get('nombre');
        $producto->descripcion = $request->get('descripcion');
        $producto->categoria_id = $request->get('categoria_id');

        if ($request->hasFile('imagen'))
        {
            // Subida de imagen al servidor
            $image_url = $request->file('imagen')->store('public/producto');
            $producto->imagen = asset(str_replace('public', 'storage', $image_url));
        }
        else
        {
            $producto->imagen = '';
        }

        $producto->save();

        return redirect()->route('panel.productos.index', $producto)->with('mensaje','Producto guardado con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Producto $producto)
    {
        return view('panel.productos.show', compact('producto'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Producto $producto)
    {
        $categoria = Categoria::get();
        return view('panel.productos.edit', compact('producto', 'categoria'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Producto $producto)
    {
        $request->validate(
            [
                'nombre' => 'required',
                //'imagen' => 'required | image | max:2048',
                'categoria_id' => 'required',
            ]);

        $producto->nombre = $request->get('nombre');
        $producto->descripcion = $request->get('descripcion');
        $producto->categoria_id = $request->get('categoria_id');

        if ($request->hasFile('imagen'))
        {
            // Subida de la imagen nueva al servidor
            $image_url = $request->file('imagen')->store('public/producto');
            $producto->imagen = asset(str_replace('public', 'storage', $image_url));
        }

        $producto->update();

        return redirect()->route('panel.productos.index', $producto)->with('mensaje','Producto actualizado con exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Producto $producto)
    {
        $producto->delete();

        return redirect()->route('panel.productos.index', $producto)->with('eliminar', 'Ok');
    }

    //Exportar a excel
    public function exportarProductoExcel()
    {
        return Excel::download(new ProductosExport, 'producto.xlsx');
    }

    public function exportarProductoPDF()
    {
        $producto = Producto::all();
        $pdf= \PDF::loadView('panel.productos.pdf_productos', compact('producto'));
        $pdf->render();
        return $pdf->stream('producto.pdf');
    }
}
