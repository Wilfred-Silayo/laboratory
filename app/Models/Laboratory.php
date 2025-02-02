<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laboratory extends Model
{
    use HasFactory;
    protected $fillable = ['consultation_id', 'order_id', 'test_id', 'result'];

    public function consultation()
    {
        return $this->belongsTo(Consultation::class);
    }
    
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
