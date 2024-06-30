<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiseaseTest extends Model
{
    use HasFactory;

    protected $fillable = ['test_code','test_name','test_for','test_price'];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
