<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;
class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_super_admin',
        'is_shop_admin',
        'is_staff',
        'store_id',
        'rol_id',
        'designation_id',
        'department_id',
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
    ];
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
    public function scopeStore($query)
    {
         return $query->where('store_id',Auth::user()->store_id);
    }
    public function scopeSales($query)
    {
         return $query->where('rol_id',2);
    }
    public function rol(){
        
        return $this->hasMany(Rol::class,'id','rol_id');
     }
     public static function create_user($request)
     {
        $request['store_id']=Auth::user()->store_id;
       
        if($request->rol_id==1)
        {$request['is_shop_admin']=1;}
        else{
        $request['is_staff']=1;
        }
        $request['password']=Hash::make($request->password);
         self::create($request->all());
     }
     public static function update_user($request,$user)
     { 
         $request['store_id']=Auth::user()->store_id;
                 if($request->rol_id==1)
        {$request['is_shop_admin']=1;}
        else{
        $request['is_staff']=1;
        }
    
        // $request['password']=Hash::make($request->password);
         $user->update($request->all());
     }
     public function scopeSale($query)
     {
          return $query->where('rol_id',2);
     }
     public function scopeDriver($query)
     {
          return $query->where('rol_id',4);
     }
}
