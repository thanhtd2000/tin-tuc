<?php

namespace App\Models;

use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Post extends Model
{
    use HasFactory;
    protected $table = 'posts';
    protected $primaryKey = 'id';
    protected $fillable = [
        'title',
        'content',
        'status',
        'created_at',
        'updated_at',
        'user_id',
        'categories_id'
    ];
    public function Category()
    {
        return $this->belongsTo(Category::class, 'categories_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function comments()
    {
        return $this->hasMany(Comment::class, 'post_id');
    }
}
