<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'is_admin',
        'email_verified_at',
    ];

    public function translationOrders()
    {
        return $this->belongsToMany(Order::class, 'order_translator')
            ->withPivot('price', 'pages')
            ->withTimestamps();
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function migrationForms()
    {
        return $this->hasMany(MigrationForm::class);
    }

    //связи чтобы $user->migrationForms и $user->translationRequests работали
    public function translationRequests()
    {
        return $this->hasMany(TranslationRequest::class);
    }
}
