<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $fillable = ['consultation_id', 'total_amount', 'status'];

    public function consultation()
    {
        return $this->belongsTo(Consultation::class);
    }
}