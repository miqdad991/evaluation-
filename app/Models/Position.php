<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    protected $fillable = ['title'];

    public function kpis()
    {
        return $this->hasMany(PositionKpi::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
