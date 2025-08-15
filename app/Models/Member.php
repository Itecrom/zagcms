<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable = [
        'name','surname','dob','home_of_origin','residential_home',
        'homecell_id','ministry_id','picture','marital_status',
        'employment_status','phone','active','transferred','deceased'
    ];

    protected $casts = [
        'dob' => 'date',
        'active' => 'boolean',
        'transferred' => 'boolean',
        'deceased' => 'boolean',
    ];

    public function homecell()
    {
        return $this->belongsTo(Homecell::class);
    }

    public function ministry()
    {
        return $this->belongsTo(Ministry::class);
    }
}
