<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Homecell extends Model
{
    public function members()
    {
        return $this->hasMany(Member::class);
    }
}
