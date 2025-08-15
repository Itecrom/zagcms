<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // make sure these exist in your table or are fillable via seeding
    protected $fillable = [
        'name','email','phone','password','role','homecell_id','ministry_id'
    ];

    protected $hidden = ['password','remember_token'];

    public function homecell()
    {
        return $this->belongsTo(Homecell::class);
    }

    public function ministry()
    {
        return $this->belongsTo(Ministry::class);
    }

    public function isSuperAdmin(): bool
    {
        return $this->role === 'super_admin';
    }

    public function isHomecellPastor(): bool
    {
        return $this->role === 'homecell_pastor';
    }

    public function isMinistryLeader(): bool
    {
        return $this->role === 'ministry_leader';
    }

    
}
