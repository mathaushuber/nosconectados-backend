<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
/**
 * 
 */
class Usuario extends Model
{
    
    protected $fillable = [
		'user_password', 'isAdmin', 
		'registerConfirmed', 'firstName', 'lastName', 'document', 'phone', 'email',
        'facebookProfile', 'gender', 'birthdayDate', 'updated_at', 'created_at'
	];

}