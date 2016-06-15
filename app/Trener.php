<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use DB;

class Trener extends Model
{
    use SluggableTrait;

    public $table = "treners";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'room',
        'phone',
        'graf_time',
        'graf'
    ];

    protected static function boot()
    {
        
        static::creating(function ($model) {
            if($model->graf_time == 1){
                $grafic = "Tuesday,Thursday,Saturday";
            } else {
                $grafic = "Monday,Wednesday,Friday,Sunday";
            }
            $model->graf = $grafic;
        });
        
        static::updating(function ($model) {
            if($model->graf_time == 1){
                $grafic = "Tuesday,Thursday,Saturday";
            } else {
                $grafic = "Monday,Wednesday,Friday,Sunday";
            }
            $model->graf = $grafic;
        });
    }
    

}
