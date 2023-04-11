<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modul extends Model
{
    protected $table = 'courses';
    protected $guarded = false;

    public function course(){

        return $this->belongsTo(Course::class,'courses_id','id');
    }

    public function getMainImageAttribute(){
        return url('storage/'.  $this->main_image);
    }
}
