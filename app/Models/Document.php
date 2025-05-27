<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function translation()
    {
        return $this->hasOne(Translation::class);
    }
    protected $fillable = [
        'original_name',
        'file_path',
        'type',
        'order_id',
    ];
}
