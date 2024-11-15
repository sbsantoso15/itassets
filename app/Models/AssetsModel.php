<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssetsModel extends Model
{
    protected $table = 'tblassets';
    protected $fillable = [
        'noseri', 
        'kodecab',
        'hwcode',
        'merk',
        'hwtype',
        'rolepc',
        'compname',
        'ipaddress',
        'macaddr',
        'isdomain',
        'wkcbid',
        'prcbid',
        'user',
        'idukerja',
        'userad',
        'kapasitas',
        'keterangan',
        'isactive'
    ];
}
