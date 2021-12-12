<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Complaints extends Model {
    protected $table = "complaints";
    protected $fillable = ['division', 'user_id', 'route_id', 'title', 'complaint'];
    protected $hidden = [];
}