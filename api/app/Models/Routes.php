<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Routes extends Model {
    protected $table = "routes";
    protected $fillable = ['division', 'route', 'description'];
    protected $hidden = [];
}