<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaseImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'case_id',
        'file_path',
        'file_name',
    ];

    public function customerLead()
    {
        return $this->belongsTo(CustomerLead::class, 'case_id');
    }

    /**
     * 獲取完整的圖片 URL
     */
    public function getUrlAttribute()
    {
        return url('storage/' . $this->file_path);
    }
}
