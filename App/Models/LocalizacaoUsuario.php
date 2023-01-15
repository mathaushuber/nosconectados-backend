<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
/**
 * 
 */
class LocalizacaoUsuario extends Model
{
    
    protected $fillable = [
		'street', 'numberU', 
		'city', 'state', 'zipcode', 'complement', 'neighborhood', 'idUser',
        'updated_at', 'created_at'
	];

}