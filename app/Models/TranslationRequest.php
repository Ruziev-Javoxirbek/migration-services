<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TranslationRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'document_type',
        'delivery_type',
        'delivery_address',
        'uploaded_files',
        'translated_file_path',
        'status',
    ];

    protected $casts = [
        'uploaded_files' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
