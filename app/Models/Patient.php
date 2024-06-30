<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable =['name','email','phone','sex','dob'];

    public function consultations()
    {
        return $this->hasMany(Consultation::class);
    }
}
