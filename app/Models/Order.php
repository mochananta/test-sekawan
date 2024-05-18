<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'vehicle_type',
        'bbm',
        'service_schedule',
        'phone_number',
        'plate_number_type',
        'driver_id',
        'status',
        'approved_by_atasan1',
        'approved_by_atasan2',
        'usage_history',
    ];

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    public function approvedByAtasan1()
    {
        return $this->belongsTo(User::class, 'approved_by_atasan1');
    }

    public function approvedByAtasan2()
    {
        return $this->belongsTo(User::class, 'approved_by_atasan2');
    }
}
