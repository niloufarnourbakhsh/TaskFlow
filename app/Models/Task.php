<?php

namespace App\Models;

use App\RecordsActivity;
use App\TaskStatus;
use Illuminate\Database\Eloquent\Casts\AsEnumCollection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory,RecordsActivity;
    public static $recordableEvents=['created','updated'];
    protected static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub

    }

    protected $guarded;
    protected $casts = [
        'status' => TaskStatus::class
    ];

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }
    public function activities()
    {
        return $this->morphMany(Activity::class,'activitable');
    }

    public function recordeActivity($description)
    {
        $this->activities()->create([
            'description'=>$description,
            'user_id'=>$this->plan->user_id
        ]);
    }
}
