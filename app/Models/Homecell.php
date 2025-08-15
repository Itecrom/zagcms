<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Homecell extends Model
{
    protected $fillable = ['name'];

    public function members()
    {
        return $this->hasMany(Member::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
