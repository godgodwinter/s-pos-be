<?php

namespace App\Models;

use App\Helpers\Fungsi;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;

class Yayasan extends Authenticatable implements JWTSubject
{
    // use HasApiTokens, HasFactory, Notifiable;
    public $table = "yayasan";

    use SoftDeletes;
    use HasFactory;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */



    // protected $fillable = [
    //     'nama',
    //     'email',
    //     'username',
    //     'nomeridentitas',
    //     'password',
    //     'agama',
    //     'tempatlahir',
    //     'tgllahir',
    //     'alamat',
    //     'jk',
    //     'telp',
    //     'kelas_id',
    //     'status_login', //Aktif/Nonaktif login
    // ];

    protected $guarded = [];

    // public function kelas()
    // {
    //     return $this->belongsTo(kelas::class, 'kelas_id', 'id');
    // }
    public function yayasandetail()
    {
        return $this->hasMany('App\Models\yayasandetail');
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

    // Rest omitted for brevity

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
