<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ForwardChaining extends Model
{
    protected $table = 'forward_chainings';
    protected $fillable = [
      'mahasiswa_id',
      'isSKSLulus',
        'isBayar',
        'isPkpm',
        'isMetopel',
        'jumlahsks'
    ];

    public function mahasiswa(){
        return $this->belongsTo(Mahasiswa::class)->with('user');
    }
}
