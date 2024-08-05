<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Antrian extends Model
{
    use HasFactory;

    protected $table = 'antrians';


    protected $fillable = [
            'jenis_pasien',
            'poli',
            'nomor_antrian',
            'no_antrian_poli'
            
        
    ];
}
