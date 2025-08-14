<?php

// app/Models/Member.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'surname',
        'dob',
        'home_of_origin',
        'residential_home',
        'homecell_id',
        'ministry_id',
        'picture',
        'marital_status',
        'employment_status',
        'phone',
        'active',
        'transferred',
        'deceased',
    ];

public function ministry()
{
    return $this->belongsTo(Ministry::class);
}

public function homecell()
{
    return $this->belongsTo(Homecell::class);
}

}
