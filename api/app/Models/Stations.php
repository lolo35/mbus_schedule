<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Stations extends Model {
    protected $table = "stations";
    protected $fillable = ['route_id', 'station', 'description'];
    protected $hidden = [];
}