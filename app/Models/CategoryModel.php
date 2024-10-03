<?php 

namespace App\Models;

use CodeIgniter\Model;

class CategoryModel extends Model
{
    protected $table = 'categories'; // Nama tabel di database
    protected $primaryKey = 'id'; // Nama kolom primary key
    protected $allowedFields = ['category_name']; // Kolom yang dapat diisi
}
