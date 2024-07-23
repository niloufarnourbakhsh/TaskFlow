<?php

namespace App;

trait RecordsActivity
{
    public static function bootRecordsActivity(){
        foreach (self::$recordableEvents as $event){
            static::$event(function ($model) use ($event) {
                $model->recordeActivity(strtolower(class_basename($model)).'_'.$event);
            });
        }
    }
    public function recordeActivity($description)
    {
        $this->activities()->create([
            'description'=>$description,
            'user_id'=>($this->project?? $this)->user->id
        ]);
    }
}
