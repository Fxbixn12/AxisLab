<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory; 
use Illuminate\Database\Eloquent\Model;
class Producto extends Model
{
    use HasFactory;
    // Conectamos con la tabla productos de MySQL
    protected $table = 'productos';
    // Indicamos que la llave primaria es id_producto
    protected $primaryKey = 'id_producto';
    // Lista de campos que permitimos llenar desde los formularios
    protected $fillable = [
        'id_categoria',
        'nombre',
        'precio',
        'stock',
        'imagen',
        'descripcion',        
        'material',
        'colores',
        'medida',
        'peso',
        'acabado',
        'resistencia',
        'usos_posibles',  
        'activo', 
    ];
    // Relación para saber a qué categoría pertenece el producto
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'id_categoria', 'id_categoria');
    }
}