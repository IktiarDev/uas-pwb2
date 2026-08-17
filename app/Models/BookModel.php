<?php

namespace App\Models;

use CodeIgniter\Model;

class BookModel extends Model
{
    protected $table            = 'books';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $protectFields    = true;
    protected $allowedFields    = [
        'title', 'author', 'publisher', 'year_published', 
        'isbn', 'category', 'synopsis', 'cover_image', 'quantity'
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function search($keyword)
    {
        return $this->like('title', $keyword)
                    ->orLike('author', $keyword)
                    ->orLike('category', $keyword);
    }
}
