<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable =['name','address','phone','sex','dob','occupation'];

    public function consultations()
    {
        return $this->hasMany(Consultation::class);
    }
}
