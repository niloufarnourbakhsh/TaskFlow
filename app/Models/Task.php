<?php

namespace App\Models;

use App\TaskStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $guarded;
    protected $casts=[
        'status'=>TaskStatus::class
    ];

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }
}
