<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
/**
 * 
 */
class Sensor extends Model
{
	
	protected $fillable = [
		'readAt', 'temperatureSoil', 'temperatureAir', 
		'luminosity', 'pluviometer', 'ultraviolet', 'temperatureCase',
        'rainIntensity', 'windDirection', 'windSpeed', 'gas', 'humidityAirRelative', 'altitude',
        'pressure', 'updated_at', 'created_at'
	];

}