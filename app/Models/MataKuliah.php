<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MataKuliah extends Model
{
    use HasFactory;
    protected $guarded = ['code','name','sks'];

    public function users(){
        return $this->hasMany(usermatkul::class,'matakuliah_id','id');
    }
}
