<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Substation extends Model
{
    use HasFactory;
    public $table = 'tbl_substation';
    protected $fillable = ['other_image'  , 'image_building' ,'images_gate_after_lock' ,'image_tree_branches' ,'image_grass', 'image_gate'];
}
