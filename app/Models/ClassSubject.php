<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassSubject extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function class(){
        return $this->belongsTo(Schoolclass::class);
    }
    public function subject(){
        return $this->belongsTo(Subject::class);
    }
}
