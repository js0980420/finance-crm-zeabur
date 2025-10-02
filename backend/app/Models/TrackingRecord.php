<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrackingRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'user_id',
        'activity_type',
        'description',
        'old_data',
        'new_data',
        'ip_address',
        // Add any other fields that your tracking records might have
    ];
}
