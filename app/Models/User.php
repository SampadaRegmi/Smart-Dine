<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Validation\Rules;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    // Define USER_ROLE constant
    public const USER_ROLE = ['user', 'admin'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'role',
    ];

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
        'password' => 'hashed',
    ];

    /**
     * Get the validation rules that apply to the model.
     *
     * @return array<string, mixed>
     */
    public static function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|max:10',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => 'required|string|in:' . implode(',', self::USER_ROLE),
        ];
    }

    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmail);
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function cartItems()
    {
        return $this->hasManyThrough(CartItem::class, Cart::class);
    }

    public function Review()
    {
        return $this->hasMany(Review::class);
    }
}
