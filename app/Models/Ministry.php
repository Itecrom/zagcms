<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ministry extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    // All methods must be inside the class
    public function members()
    {
        return $this->hasMany(Member::class);
    }
}
