<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteDataCollection extends Model
{
    use HasFactory;

    protected $fillable = ['nama_pe', 'sub_station_type', 'switchgear', 'switchgear_2',  'switchgear_compact', 'type_feeder', 'switchgear_brand', 'switchgear_no', 'label_switch', 'type_cable', 'size_cable', 'tx_rating_1', 'tx_rating_2', 'tx_cable_1', 'tx_cable_2', 'genset_place', 'ct_cable', 'lvdb', 'type_lvdb', 'type_fuse', 'feeder', 'rating',
   'geom' ];


   
    public function estWork() {
        return $this->hasOne(EstimationWork::class, 'site_data_id');
    }

    public function siteImg() {
        return $this->hasMany(SiteImage::class, 'site_data_id');
    }



}
