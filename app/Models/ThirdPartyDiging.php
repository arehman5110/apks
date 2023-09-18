<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThirdPartyDiging extends Model
{
    use HasFactory;
    public $table = 'tbl_third_party_diging_patroling';
    protected $fillable = ['image1'  , 'image2' ,'image3' ];

    public function wpData() {
        return $this->belongsTo(WorkPackage::class, 'workpackage_id');
    }
}
