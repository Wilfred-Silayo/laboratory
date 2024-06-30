<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['consultation_id', 'test_code', 'test_price', 'comment'];

    public function consultation()
    {
        return $this->belongsTo(Consultation::class);
    }

    public function test()
    {
        return $this->belongsTo(DiseaseTest::class);
    }
}
