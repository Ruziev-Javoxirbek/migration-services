<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function documents()
    {
        return $this->hasMany(Document::class);
    }

    public function translators()
    {
        return $this->belongsToMany(User::class, 'order_translator')
            ->withPivot('price', 'pages')
            ->withTimestamps();
    }
}
