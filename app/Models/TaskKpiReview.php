<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaskKpiReview extends Model
{
    protected $fillable = [
        'task_id',
        'position_kpi_id',
        'score',
    ];

    public function task() {
        return $this->belongsTo(Task::class);
    }

    public function kpi() {
        return $this->belongsTo(PositionKpi::class, 'position_kpi_id');
    }
}
