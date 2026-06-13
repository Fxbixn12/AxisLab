<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Distrito; // Importamos el modelo para interactuar con la BD

class AdminDistritoController extends Controller
{
    /**
     * Muestra la tabla principal con todos los distritos (Read)
     */
    public function index()
    {
        $distritos = Distrito::all();
        return view('admin-distritos', compact('distritos'));
    }

    /**
     * Muestra el formulario para agregar un nuevo distrito (Create - Vista)
     */
    public function create()
    {
        return view('admin-distritos-crear');
    }

    /**
     * Guarda el nuevo distrito en la base de datos (Create - Acción)
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'precio_envio' => 'required|numeric|min:0',
            'zona_tipo' => 'required|string|in:Metropolitana,Provincia',
        ]);

        Distrito::create([
            'nombre' => $request->input('nombre'),
            'precio_envio' => $request->input('precio_envio'),
            'zona_tipo' => $request->input('zona_tipo'),
            'activo' => 1 // Habilitado por defecto al crearse
        ]);

        return redirect()->route('admin.distritos.index')->with('success', '¡Distrito agregado al sistema correctamente!');
    }

    /**
     * Muestra el formulario de edición para un distrito específico (Update - Vista)
     */
    public function edit($id)
    {
        // Buscamos por la llave primaria personalizada (id_distrito)
        $distrito = Distrito::findOrFail($id);
        return view('admin-distritos-editar', compact('distrito'));
    }

    /**
     * Actualiza los datos modificados en la base de datos (Update - Acción)
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'precio_envio' => 'required|numeric|min:0',
            'zona_tipo' => 'required|string|in:Metropolitana,Provincia',
            'activo' => 'required|boolean'
        ]);

        $distrito = Distrito::findOrFail($id);
        
        // Actualizamos los campos en masa gracias al $fillable del modelo
        $distrito->update([
            'nombre' => $request->input('nombre'),
            'precio_envio' => $request->input('precio_envio'),
            'zona_tipo' => $request->input('zona_tipo'),
            'activo' => $request->input('activo'),
        ]);

        return redirect()->route('admin.distritos.index')->with('success', '¡Tarifa de envío actualizada correctamente!');
    }

    /**
     * Elimina físicamente el distrito de la base de datos (Delete)
     */
    public function destroy($id)
    {
        $distrito = Distrito::findOrFail($id);
        $distrito->delete();

        return redirect()->route('admin.distritos.index')->with('success', 'El distrito fue removido del sistema.');
    }
}