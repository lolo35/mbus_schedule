<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Sugestions extends Model {
    protected $table = "sugestions";
    protected $hidden = [];
    protected $fillable = ['divizion', 'user_id', 'route_id', 'title', 'sugestion'];
}