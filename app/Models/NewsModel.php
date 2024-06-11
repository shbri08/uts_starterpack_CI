<?php

namespace App\Models;

use CodeIgniter\Model;

class NewsModel extends Model
{
    protected $table = 'news';
    protected $primaryKey = 'id_news';
    protected $allowedFields = ['tittle', 'description', 'id_categories', 'date', 'image'];

    public function getNewsWithCategories()
    {
        return $this->select('news.*, categories.name as category_name')
                    ->join('categories', 'categories.id_categories = news.id_categories')
                    ->findAll();
    }

    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;

    public function Categories(){
        return $this->belongsTo(CategoryModel::class, 'id_categories');
    }
    // Tambahkan method lain sesuai kebutuhan
    
    
}
