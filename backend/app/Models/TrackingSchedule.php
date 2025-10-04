<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrackingSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'lead_id',
        'assigned_to',
        'scheduled_at',
        'status',
        'contact_result',
        'contact_method',
        'customer_feedback',
        'next_action',
        'notes',
        'rescheduled_from_id',
        'contacted_at',
        'created_by',
    ];

    protected $casts = [
        'scheduled_at' => 'datetime',
        'contacted_at' => 'datetime',
    ];

    /**
     * 關聯到案件
     */
    public function lead()
    {
        return $this->belongsTo(CustomerLead::class, 'lead_id');
    }

    /**
     * 負責業務
     */
    public function assignee()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    /**
     * 建立者
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * 改期來源追蹤
     */
    public function rescheduledFrom()
    {
        return $this->belongsTo(TrackingSchedule::class, 'rescheduled_from_id');
    }

    /**
     * 被改期的追蹤列表
     */
    public function rescheduledTo()
    {
        return $this->hasMany(TrackingSchedule::class, 'rescheduled_from_id');
    }

    /**
     * 狀態常數
     */
    const STATUS_PENDING_CONTACT = 'pending_contact';
    const STATUS_CONTACTED = 'contacted';
    const STATUS_RESCHEDULED = 'rescheduled';
    const STATUS_CANCELLED = 'cancelled';

    /**
     * 聯絡方式常數
     */
    const METHOD_PHONE = 'phone';
    const METHOD_LINE = 'line';
    const METHOD_EMAIL = 'email';
    const METHOD_IN_PERSON = 'in_person';
}
