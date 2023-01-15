<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
/**
 * 
 */
class AtribuicaoSensor extends Model
{
    
    protected $fillable = [
		'idInfoSensor', 'isAdminSensor', 'idUsuario', 'updated_at', 'created_at'
	];

}