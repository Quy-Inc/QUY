<?php
namespace Modules\users\models;

#use Moloquent\Eloquent\Model as Eloquent;
use Modules\profiles\models\Profiles;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
class Users extends Eloquent
{
	 /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

 #   protected $connection = 'mongodb';
    protected $fillable = [
        'name', 'username','email', 'password','id_lokasi','address','phone','id_profile','aff_user','tid','status','created_at','update_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function profiles(){
        return $this->belongsTo(Profiles::class,'id_profile','id');
    }
}
