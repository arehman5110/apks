<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeederPillar extends Model
{
    use HasFactory;

    public $table = "tbl_feeder_pillar";

    protected $fillable = [
        'image_gate', 'image_leaning', 'image_rust', 'images_gate_after_lock', 'image_banner', 'other_image',
    ];
}
