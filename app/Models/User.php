<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
    protected $fillable = [
        // 'name',
        'username',
        'referrer_id',
        'phone',
        'referral_id',
        'balance',
        // 'email',
        'password',
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
     * A user has a referrer.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function referrer()
    {
        return $this->belongsTo(User::class, 'referral_id', 'id');
    }


    /**
     * A user has many referrals.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function referrals()
    {
        return $this->hasMany(User::class, 'referral_id', 'id');
    }

    public function referral()
    {
        return $this->hasMany(Referral::class, 'user_id');
    }
    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['referral_link'];

    /**
     * Get the user's referral link.
     *
     * @return string
     */
    public function getReferralLinkAttribute()
    {
        return $this->referral_link = route('register', ['referral' => $this->username]);
    }

    public function invests(): HasMany
    {
        // Define the relationship to the Investment model
        // Adjust this based on your actual relationship
        return $this->hasMany(Invest::class);
    }

    public function hasInvested()
    {
        // Implement your logic here to check if the user has invested
        // For example, check if the user has a related investment record
        return $this->invests()->exists();
    }

    public function withdrawals(): HasMany
    {
        return $this->hasMany(Withdrawal::class);
    }

    public function getDownlinesCountWithInvestmentStatus($status = 'active')
    {
        return $this->referrals()
            ->whereHas('invests', function ($query) use ($status) {
                $query->where('status', $status);
            })
            ->when($status !== 'active', function ($query) {
                $query->orWhereDoesntHave('invests');
            })
            ->count();
    }

    public function uplineBonus()
{
    return $this->referral()->sum('referral_bonus');
}
}
