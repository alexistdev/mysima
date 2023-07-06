<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class usermatkul extends Model
{
    use HasFactory;
    protected $table = "user_matkul";

    public function user() {
        return $this->belongsTo(User::class,'user_id');
    }
}
