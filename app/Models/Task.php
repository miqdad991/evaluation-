<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'sprint_id',
        'user_id',
        'task_id',
        'title',
        'description',
        'task_date',
        'average_score',
        'status',
    ];

    public function sprint() {
        return $this->belongsTo(Sprint::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function kpiReviews() {
        return $this->hasMany(TaskKpiReview::class);
    }
}
