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
        'customer_name',
        'tracking_person_id',
        'contact_time',
        'service_stage',
        'opportunity_order',
        'maintenance_progress',
        'opportunity_status',
        'contact_method',
        'conversation_record',
        'activity_type',
        'description',
        'old_data',
        'new_data',
        'ip_address',
    ];

    protected $casts = [
        'contact_time' => 'datetime',
        'old_data' => 'array',
        'new_data' => 'array',
    ];

    /**
     * 關聯到客戶
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    /**
     * 關聯到建立者
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * 關聯到記錄人員
     */
    public function trackingPerson()
    {
        return $this->belongsTo(User::class, 'tracking_person_id');
    }
}
