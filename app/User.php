<?php

namespace App;

use App\Notifications\ResetPassword;
use App\Notifications\VerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject , MustVerifyEmail
{
	use Notifiable, SoftDeletes;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'nickname', 'name', 'email', 'password', 'date_of_birth', 'city', 'state', 'postal_or_zip_code', 'country', 'timezone', 'receive_email_updates', 'tos_accepted'
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password', 'remember_token',
	];

	/**
	 * The attributes that should be cast to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'email_verified_at' => 'datetime',
		'tos_accepted' => 'boolean',
	];
	

	/**
	 * The accessors to append to the model's array form.
	 *
	 * @var array
	 */
	protected $appends = [
		'photo_url',
	];

	/**
	 * Get the profile photo URL attribute.
	 *
	 * @return string
	 */
	public function getPhotoUrlAttribute()
	{
		return 'https://www.gravatar.com/avatar/'.md5(strtolower($this->email)).'.jpg?s=200&d=mm';
	}

	/**
	 * Get the oauth providers.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function oauthProviders()
	{
		return $this->hasMany(OAuthProvider::class);
	}

	/**
	 * Send the password reset notification.
	 *
	 * @param  string  $token
	 * @return void
	 */
	public function sendPasswordResetNotification($token)
	{
		$this->notify(new ResetPassword($token));
	}

	/**
	 * Send the email verification notification.
	 *
	 * @return void
	 */
	public function sendEmailVerificationNotification()
	{
		$this->notify(new VerifyEmail);
	}

	/**
	 * @return int
	 */
	public function getJWTIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * @return array
	 */
	public function getJWTCustomClaims()
	{
		return [];
	}
	
	// ATTRIBUTES
	public function setTosAcceptedAttribute($value)
	{
		if($value === true || $value == 'true'){
			$this->attributes['tos_accepted'] = 1;
		} else {
			$this->attributes['tos_accepted'] = 0;
		}
	}
	
	public function setReceiveEmailUpdatesAttribute($value)
	{
		if($value === true || $value == 'true'){
			$this->attributes['receive_email_updates'] = 1;
		} else {
			$this->attributes['receive_email_updates'] = 0;
		}
	}
}
