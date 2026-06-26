<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Distrito;
use Illuminate\Support\Facades\DB;

class AdminDistritoController extends Controller
{
    // Traemos todos los distritos de la base de datos ordenados de la A a la Z
    public function index()
    {
        $distritos = Distrito::orderBy('nombre')->get();
        return view('admin-distritos', compact('distritos'));
    }

    // Solo cargamos la vista con el formulario para crear un nuevo destino
    public function create()
    {
        return view('admin-distritos-crear');
    }

    // Recibimos los datos del formulario, validamos que todo esté en orden y guardamos el nuevo distrito
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100|unique:distritos,nombre',
            'precio_envio' => 'required|numeric|min:0',
            'zona_tipo' => 'required|string|in:Lima Metropolitana,Provincia',
        ]);

        // Buscamos cuál es el costo mínimo permitido según el tipo de zona que seleccionaron
        $claveMinimo = ($request->input('zona_tipo') === 'Lima Metropolitana') ? 'minimo_lima' : 'minimo_provincia';
        $minimoPermitido = DB::table('configuraciones')->where('clave', $claveMinimo)->value('valor') ?? 0;

        // Si intentan poner un costo de envío menor al mínimo configurado, frenamos el proceso de golpe
        if ($request->input('precio_envio') < $minimoPermitido) {
            return back()->withInput()->withErrors([
                'precio_envio' => 'El precio de envío para ' . $request->input('zona_tipo') . ' no puede ser menor al costo mínimo establecido (S/. ' . number_format($minimoPermitido, 2) . ').'
            ]);
        }

        Distrito::create([
            'nombre' => $request->input('nombre'),
            'precio_envio' => $request->input('precio_envio'),
            'zona_tipo' => $request->input('zona_tipo'),
            'activo' => 1 // Por defecto, cualquier destino nuevo entra al sistema activo
        ]);

        return redirect()->route('admin.distritos.index')->with('success', '¡Distrito agregado al sistema correctamente!');
    }

    // Buscamos el distrito usando su nombre en lugar del ID para proteger la URL
    public function edit($nombre)
    {
        $distrito = Distrito::where('nombre', $nombre)->firstOrFail();
        return view('admin-distritos-editar', compact('distrito'));
    }

    // Procesamos la edición del distrito usando el nombre como identificador seguro
    public function update(Request $request, $nombre_original)
    {
        $distrito = Distrito::where('nombre', $nombre_original)->firstOrFail();

        // Si el administrador solo hizo clic en el interruptor rápido de la tabla para activar/desactivar
        if ($request->has('toggle_status')) {
            $distrito->update([
                'activo' => $request->input('activo')
            ]);
            $mensaje = $request->input('activo') ? 'Distrito habilitado para envíos.' : 'Distrito ocultado de la lista pública.';
            return redirect()->route('admin.distritos.index')->with('success', $mensaje);
        }

        // Si el flujo viene desde el formulario completo dentro de la pantalla de edición
        $request->validate([
            'nombre' => 'required|string|max:100|unique:distritos,nombre,' . $distrito->id_distrito . ',id_distrito',
            'precio_envio' => 'required|numeric|min:0',
            'zona_tipo' => 'required|string|in:Lima Metropolitana,Provincia',
            'activo' => 'required|integer|between:0,1'
        ]);

        // Volvemos a verificar el piso mínimo permitido para la zona elegida antes de guardar la edición
        $claveMinimo = ($request->input('zona_tipo') === 'Lima Metropolitana') ? 'minimo_lima' : 'minimo_provincia';
        $minimoPermitido = DB::table('configuraciones')->where('clave', $claveMinimo)->value('valor') ?? 0;

        // Validamos que los nuevos cambios respeten la configuración del negocio
        if ($request->input('precio_envio') < $minimoPermitido) {
            return back()->withInput()->withErrors([
                'precio_envio' => 'El precio de envío para ' . $request->input('zona_tipo') . ' no puede ser menor al costo mínimo establecido (S/. ' . number_format($minimoPermitido, 2) . ').'
            ]);
        }

        $distrito->update([
            'nombre' => $request->input('nombre'),
            'precio_envio' => $request->input('precio_envio'),
            'zona_tipo' => $request->input('zona_tipo'),
            'activo' => $request->input('activo'),
        ]);

        return redirect()->route('admin.distritos.index')->with('success', '¡Parámetros de envío actualizados correctamente!');
    }

    // En lugar de borrar el registro de la base de datos, lo apagamos (activo = 0) para cuidar el historial de compras
    public function destroy($nombre)
    {
        $distrito = Distrito::where('nombre', $nombre)->firstOrFail();
        $distrito->update(['activo' => 0]);

        return redirect()->route('admin.distritos.index')->with('success', 'El distrito fue ocultado del sistema correctamente.');
    }
}