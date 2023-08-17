<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class usermatkul extends Model
{
    protected $table = "user_matkul";
    protected $fillable = ['user_id','matakuliah_id','uts','uas','presensi','total','nilai','islulus'];

    public function user() {
        return $this->belongsTo(User::class,'user_id');
    }

    public function maha(){
        return $this->belongsTo(User::class,'user_id')->with('mahasiswa');
    }

    public function matkul(){
        return $this->belongsTo(MataKuliah::class,'matakuliah_id','id');
    }


}
