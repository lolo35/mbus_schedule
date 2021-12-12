<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class StationSchedule extends Model {
    protected $table = "station_schedule";
    protected $fillable = ['station_id', 'shift', 'tur', 'retur'];
    protected $hidden = [''];
}