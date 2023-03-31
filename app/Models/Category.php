<?php

namespace App\Models;

use App\Models\Post;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';
    protected $primaryKey = 'id';
    protected $fillable = [
        'category_name',
        'image',
        'created_at',
        'updated_at'
    ];
    public function Post()
    {
        return $this->hasManyThrough(Post::class, 'categories_id');
    }
}
