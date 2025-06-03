<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Schema;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'address',
        'phone',
        'profile_image',
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
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Check if user is admin
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Get the orders for the user.
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Get the reviews for the user.
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Get the cart items for the user.
     */
    public function cartItems()
    {
        return $this->hasMany(Cart::class);
    }

    /**
     * Get user's full address
     */
    public function getFullAddressAttribute(): string
    {
        return $this->address ?? 'No address provided';
    }

    /**
     * Get user's display phone
     */
    public function getDisplayPhoneAttribute(): string
    {
        return $this->phone ?? 'No phone provided';
    }

    /**
     * Get profile image URL
     */
    public function getProfileImageUrlAttribute(): string
    {
        if ($this->profile_image) {
            return asset('storage/' . $this->profile_image);
        }
        return asset('images/default-avatar.png');
    }

    /**
     * Get cart total count
     */
    public function getCartCountAttribute(): int
    {
        try {
            // Check if carts table exists before querying
            if (Schema::hasTable('carts')) {
                return $this->cartItems()->sum('quantity');
            }
            return 0;
        } catch (\Exception $e) {
            return 0;
        }
    }

    /**
     * Get cart total amount
     */
    public function getCartTotalAttribute(): float
    {
        try {
            // Check if carts table exists before querying
            if (Schema::hasTable('carts')) {
                return $this->cartItems()->with('product')->get()->sum(function ($item) {
                    return $item->product->price * $item->quantity;
                });
            }
            return 0;
        } catch (\Exception $e) {
            return 0;
        }
    }
}
