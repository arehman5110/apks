<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Road extends Model
{
    use HasFactory;
    public $table = 'tbl_workpackage';
    protected $fillable = ['road_name', 'geom', 'id_workpackage', 'created_by', 'created_at', 'updated_at' ];
}
