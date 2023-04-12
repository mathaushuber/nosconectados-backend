<?php

use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\Dado;
use \Firebase\JWT\JWT;

// Rotas para dados
$app->group('/api/v1', function(){
	
	// Lista dados
	$this->get('/dados/lista/{id}', function($request, $response, $args){
		$dados = Dado::get();
        foreach ($dados as $key => $value){
			if($args['id'] == $value->id){
				$sensorData[$key] = array(
					"id" => $value->id,
					"readAt" => $value->readAt,
					"temperatureSoil" => $value->temperatureSoil,
					"temperatureAir" => $value->temperatureAir,
					"luminosity" => $value->luminosity,
					"pluviometer" => $value->pluviometer,
					"ultraviolet" => $value->ultraviolet,
					"temperatureCase" => $value->temperatureCase,
					"rainIntensity" => $value->rainIntensity,
					"windDirection" => $value->windDirection,
					"windSpeed" => $value->windSpeed,
					"gas" => $value->gas,
					"humidityAirRelative" => $value->humidityAirRelative,
					"altitude" => $value->altitude,
					"pressure" => $value->pressure,
				);
			}
		}

		return $response->withJson( $sensorData, 200 );
	});

});