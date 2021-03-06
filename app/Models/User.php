<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Propaganistas\LaravelPhone\Exceptions\CountryCodeException;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'password',
        'email_verified_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $with = [
        'wallet',
    ];

    protected $appends = [
        'is_admin',
        'wallet_balance',
    ];


    public function getIsAdminAttribute(): bool
    {
        return in_array($this->email, config('novabolt.admin_emails'));
    }

    public function getWalletBalanceAttribute()
    {
        return $this->wallet->balance;
    }

    public function setPhoneAttribute($value): string
    {
        return $this->attributes['phone'] = (string) phone($value, 'VN');
    }

    public function getPhoneAttribute($value): string
    {
        try {
            return (string) phone($value)->formatForMobileDialingInCountry('VN');
        } catch (CountryCodeException $e) {
            return $value;
        }
    }

    public function scopeWherePhone($query, $phone)
    {
        $number = (string) phone($phone, 'VN');
        return $query->where('phone', $number);
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where('name', 'like', '%'.$search.'%')
                ->orWhere('email', 'like', '%'.$search.'%')
                ->orWhere('phone', 'like', '%'.$search.'%');
        });
    }

    public function wallet(): MorphOne
    {
        return $this->morphOne(Wallet::class, 'ownable')->withDefault([
            'balance' => 0,
        ]);
    }

    public function transactions()
    {
        return $this->hasManyThrough(Transaction::class, Wallet::class, 'ownable_id', 'wallet_id');
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class)->where('is_draft', false)->has('products');
    }

    public function shipments(): HasManyThrough
    {
        return $this->hasManyThrough(Shipment::class, Order::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
