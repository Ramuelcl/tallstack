<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
// Spatie
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    // Spatie
    use HasRoles;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_photo_path',
        'is_active',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_active' => 'boolean',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    // protected $appends = [
    //     'profile_photo_path',
    // ];

    /**mutators = mutadores */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }
    public function userSetting()
    {
        return $this->hasOne(UserSetting::class);
    }

    // filtra por campo y que sea true o activo
    public function scopeActive($query)
    {
        $query->where('is_active', 1);
    }

    // filtra por campo Role
    public function scopeRole($query, $rol)
    {
        if (!empty($rol)) {
            $paso = $query->whereHas('roles', function ($query) use ($rol) {
                $query->where('name', $rol);
            });
            // dd($rol, $paso);
            return $paso;
        }
    }
    // devuelve array de los roles del usuario
    // public function role()
    // {
    //     return $this->belongsTo(Role::class, 'roles_id');
    // }

    // relacion 1:1
    public function perfil()
    {
        // $perfil = Perfil::where('user_id', $this->id)->first();
        // return $perfil;

        // otra opcion
        // return $this->hasOne('App\Models\Backend\Perfil', 'foreign_key', 'local_key');

        // la que más se utiliza
        return $this->hasOne(Perfil::class); //, 'foreign_key', 'local_key'
    }

    // public function getProfilePicturePathAttribute(): string
    // {
    //     return Storage::disk('public')->path('avatars', $this->profile_picture_path);
    // }
}
