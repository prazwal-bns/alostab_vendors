<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Cache;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected  $guarded = [];
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

    // USER ACTIVE NOW
    public function UserOnline(){
        return Cache::has('user-is-online' . $this->id);
    }

    public static function generateUserNameFromName($name){
        // Extract a portion of the name or use the whole name, depending on your preference
        $username = Str::lower(str_replace(' ', '', $name));
    
        if(static::where('username', $username)->exists()){
            $newUsername = $username . Str::lower(Str::random(3));
            $username = static::generateUserNameFromName($newUsername);
        }
    
        return $username;
    }
    
}
