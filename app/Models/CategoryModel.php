<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Controllers\Categories;

class CategoryModel extends Model
{
    protected $table = 'categories';
    protected $primaryKey = 'id_categories';
    protected $allowedFields = ['name', 'description'];
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
   

}


