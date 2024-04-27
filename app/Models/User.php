<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, SoftDeletes;

    // MustVerifyEmail -> hasVerifiedEmail, markEmailAsVerified, sendEmailVerificationNotification, getEmailForVerification

    public static function boot()
    {
        parent::boot();

        self::deleting(function (User $user) {
            $user->details()->delete();
            $user->devices()->delete();
            $user->userSocialAccounts()->delete();
        });
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    public $fillable = [
        'name',
        'stripe_customer_id',
        'email',
        'password',
        'remember_token'
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

    public $with = ['details'];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [];

    public static $rules = [
        'name'           => 'nullable|string|max:250',
        'email'          => 'required|email|max:250|unique:users,email,NULL,id,deleted_at,NULL',
        'password'       => 'required|confirmed|min:6',
        'remember_token' => 'nullable|string|max:100'
    ];

    public static $update_rules = [
        'first_name'   => 'nullable|string|max:250',
        'last_name'    => 'nullable|string|max:250',
        'address'      => 'nullable|string|max:250',
        'phone_number' => 'nullable|string|max:250',
        'dob'          => 'nullable|date',
        'image'        => 'nullable|file',
        'gender'       => 'nullable|string|in:male,female'
    ];

    public static $api_rules = [
        'email'                     => 'required|email|max:250|unique:users,email,NULL,id,deleted_at,NULL',
        'password'                  => 'min:8|required|same:password_confirmation|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%?&])[A-Za-z\d@$!%?&]+$/',
        'password_confirmation'     => 'min:8|required_with:password',
        'device_token'              => 'required',
        'device_type'               => 'required|string|in:ios,android,web',
        'phone_number'              => 'nullable|string|max:250|unique:user_details,phone_number,NULL,id,deleted_at,NULL',
        'phone_number_country_code' => 'sometimes|string'
    ];

    public static $api_update_rules = [
        'name'                      => 'sometimes|string|max:250',
        'first_name'                => 'sometimes|string|max:250',
        'last_name'                 => 'sometimes|string|max:250',
        'address'                   => 'sometimes|string|max:250',
        'phone_number'              => 'sometimes|string|max:250',
        'phone_number_country_code' => 'sometimes|string',
        'image'                     => 'sometimes|url',
        // 'language' => 'sometimes|string|exists:constants,key,group,'.Constant::CONST_LANGUAGE,

        'push_notification' => 'sometimes|boolean'
    ];

    /**
     * @return string
     */
    public function getRolesCsvAttribute()
    {
        return implode(",", $this->roles->pluck('name')->all());
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function details()
    {
        return $this->hasOne(UserDetail::class, 'user_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function devices()
    {
        return $this->hasMany(UserDevice::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function userSocialAccounts()
    {
        return $this->hasMany(UserSocialAccount::class);
    }

    public function favourites()
    {
        return $this->hasMany(Favourite::class, 'user_id');
    }

    public function slots()
    {
        return $this->hasMany(Slot::class, 'user_id');
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'user_id');
    }
}
