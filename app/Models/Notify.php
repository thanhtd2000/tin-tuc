<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Notify extends Model
{
    use HasFactory;
    protected $table = 'notify';
    protected $primaryKey = 'id';

    public function User()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
