<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    use HasFactory;

    protected $fillable = ['patient_id', 'visit_date', 'symptoms','clinical_comment', 'lab_comment', 'result_comment','order_status', 'lab_status', 'account_status','completed'];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function account()
    {
        return $this->hasOne(Account::class);
    }

    public function tests()
    {
        return $this->hasManyThrough(DiseaseTest::class, Order::class, 'consultation_id', 'test_code', 'id', 'test_code');
    }
}
