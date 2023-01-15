<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
/**
 * 
 */
class InformacaoSensor extends Model
{
    
    protected $fillable = [
		'lowDescription', 'description', 
		'isActive', 'isPublic', 'area', 'typeProduction', 'latitude', 'longitude', 'property',
        'state', 'city', 'idSensor', 'updated_at', 'created_at'
	];

}