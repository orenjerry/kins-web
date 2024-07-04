<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user',
        'name',
        'photo',
        'about',
        'pronouns',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
