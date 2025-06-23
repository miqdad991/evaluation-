<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PositionKPI extends Model
{
    protected $table = 'position_kpis'; // 👈 fix the table name here

    protected $fillable = [
        'position_id',
        'name',
        'how_to_measure',
        'target',
        'weight'
    ];

    public function position()
    {
        return $this->belongsTo(Position::class);
    }
}
