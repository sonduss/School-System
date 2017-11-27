<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\AdminResetPasswordNotification;

class Student extends Authenticatable
{

    use Notifiable;

    protected $guard = 'student';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
         'email', 'password','fname','lname','image','nationality','religon','fee_dis','address','phone','dateofbirth','father_name','father_occu','father_id_card','father_phone','mother_id_card','mother_phone','mother_occu','gurd_name','gurd_relation','gurd_phone','gurd_address','gurd_ocuup','gurd_id_card','mother_name','prevschool','guardian_is',




    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


}
