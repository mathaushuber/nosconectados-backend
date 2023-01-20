<?php

use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\Sensor;
use App\Models\InformacaoSensor;

// Rotas para sensores
$app->group('/api/v1', function(){
	
	// Lista sensores
	$this->get('/sensores/lista', function($request, $response){
		$sensores = Sensor::get();
		return $response->withJson( $sensores );

	});

	// Lista sensores com as respectivas informações
	$this->get('/sensores/lista-geral', function($request, $response){
		$sensores = Sensor::get();
		$informacoesSensor = InformacaoSensor::get();
		$i = 0;
		$infoSensor = array();
		$idInfoSensor = array();
		$sensorData = [];
		$tempData = [];
		foreach ($informacoesSensor as $key => $value){
			if($value->isPublic == 1){
				$tempData[$key] = $value->id;
			}
		}
		foreach ($sensores as $key => $value){
			if(InformacaoSensor::where('idSensor', $value->id)->first() && InformacaoSensor::where('id', $tempData[$key])->first()){
				$infoSensor[$key] = InformacaoSensor::where('idSensor', $value->id)->first();
				$sensorData[$key] = array(
					"id" => $value->id,
					'lowDescription' => $infoSensor[$key]->lowDescription,
					'description' => $infoSensor[$key]->description,
					'isActive' => $infoSensor[$key]->isActive,
					'isPublic' => $infoSensor[$key]->isPublic,
					'area' => $infoSensor[$key]->area,
					'typeProduction' => $infoSensor[$key]->typeProduction,
					'latitude' => $infoSensor[$key]->latitude,
					'longitude' => $infoSensor[$key]->longitude,
					'property' => $infoSensor[$key]->property,
					'state' => $infoSensor[$key]->state,
					'idSensor' => $infoSensor[$key]->idSensor,
					'city' => $infoSensor[$key]->city,
					'readAt' => $value->readAt,
					'temperatureSoil' => $value->temperatureSoil,
					'temperatureAir' => $value->temperatureAir,
					'luminosity' => $value->luminosity,
					'pluviometer' => $value->pluviometer,
					'ultraviolet' => $value->ultraviolet,
					'temperatureCase' => $value->temperatureCase,
					'rainIntensity' => $value->rainIntensity,
					'windDirection' => $value->windDirection,
					'windSpeed' => $value->windSpeed,
					'gas' => $value->gas,
					'humidityAirRelative' => $value->humidityAirRelative,
					'altitude' => $value->altitude,
					'pressure' => $value->pressure,
					'updated_at' => $value->updated_at,
					'created_at' => $value->updated_at,
				);
			}
		}

		return $response->withJson($sensorData,200);

	});

	// Lista sensores com as respectivas informações
	$this->get('/sensores/lista/todos', function($request, $response){
		$sensores = Sensor::get();
		$informacoesSensor = InformacaoSensor::get();
		$i = 0;
		$infoSensor = array();
		$idInfoSensor = array();
		$sensorData = [];
		foreach ($sensores as $key => $value){
			if(InformacaoSensor::where('idSensor', $value->id)->first()){
				$infoSensor[$key] = InformacaoSensor::where('idSensor', $value->id)->first();
				$sensorData[$key] = array(
					"id" => $value->id,
					'lowDescription' => $infoSensor[$key]->lowDescription,
					'description' => $infoSensor[$key]->description,
					'isActive' => $infoSensor[$key]->isActive,
					'isPublic' => $infoSensor[$key]->isPublic,
					'area' => $infoSensor[$key]->area,
					'typeProduction' => $infoSensor[$key]->typeProduction,
					'latitude' => $infoSensor[$key]->latitude,
					'longitude' => $infoSensor[$key]->longitude,
					'property' => $infoSensor[$key]->property,
					'state' => $infoSensor[$key]->state,
					'idSensor' => $infoSensor[$key]->idSensor,
					'city' => $infoSensor[$key]->city,
					'readAt' => $value->readAt,
					'temperatureSoil' => $value->temperatureSoil,
					'temperatureAir' => $value->temperatureAir,
					'luminosity' => $value->luminosity,
					'pluviometer' => $value->pluviometer,
					'ultraviolet' => $value->ultraviolet,
					'temperatureCase' => $value->temperatureCase,
					'rainIntensity' => $value->rainIntensity,
					'windDirection' => $value->windDirection,
					'windSpeed' => $value->windSpeed,
					'gas' => $value->gas,
					'humidityAirRelative' => $value->humidityAirRelative,
					'altitude' => $value->altitude,
					'pressure' => $value->pressure,
					'updated_at' => $value->updated_at,
					'created_at' => $value->updated_at,
				);
			}
		}

		return $response->withJson($sensorData,200);

	});

	// Recupera sensor para um determinado ID
	$this->get('/sensores/lista/geral/{id}', function($request, $response, $args){
		
		$sensor = Sensor::findOrFail( $args['id'] );
		$informacoesSensor = InformacaoSensor::findOrFail( $args['id'] );
		$sensorData = [];
		$sensorData = array(
			"id" => $sensor->id,
			'lowDescription' => $informacoesSensor->lowDescription,
			'description' => $informacoesSensor->description,
			'isActive' => $informacoesSensor->isActive,
			'isPublic' => $informacoesSensor->isPublic,
			'area' => $informacoesSensor->area,
			'typeProduction' => $informacoesSensor->typeProduction,
			'latitude' => $informacoesSensor->latitude,
			'longitude' => $informacoesSensor->longitude,
			'property' => $informacoesSensor->property,
			'state' => $informacoesSensor->state,
			'idSensor' => $informacoesSensor->idSensor,
			'city' => $informacoesSensor->city,
			'readAt' => $sensor->readAt,
			'temperatureSoil' => $sensor->temperatureSoil,
			'temperatureAir' => $sensor->temperatureAir,
			'luminosity' => $sensor->luminosity,
			'pluviometer' => $sensor->pluviometer,
			'ultraviolet' => $sensor->ultraviolet,
			'temperatureCase' => $sensor->temperatureCase,
			'rainIntensity' => $sensor->rainIntensity,
			'windDirection' => $sensor->windDirection,
			'windSpeed' => $sensor->windSpeed,
			'gas' => $sensor->gas,
			'humidityAirRelative' => $sensor->humidityAirRelative,
			'altitude' => $sensor->altitude,
			'pressure' => $sensor->pressure,
			'updated_at' => $sensor->updated_at,
			'created_at' => $sensor->updated_at,
		);

		return $response->withJson( $sensorData, 200 );

	});

	// Adiciona um sensor
	$this->post('/sensores/adiciona', function($request, $response){
		
		$dados = $request->getParsedBody();

		//Validar

		$sensor = Sensor::create( $dados );
		return $response->withJson( $sensor );

	});

	// Recupera sensor para um determinado ID
	$this->get('/sensores/lista/{id}', function($request, $response, $args){
		
		$sensor = Sensor::findOrFail( $args['id'] );
		return $response->withJson( $sensor );

	});

	// Atualiza sensor para um determinado ID
	$this->put('/sensores/atualiza/{id}', function($request, $response, $args){
		$dados = $request->getParsedBody();
		$sensor = Sensor::findOrFail( $args['id'] );
		$sensor->update( $dados );
		gravar($sensor);
		return $response->withJson( $sensor );

	});

	// Remove sensor para um determinado ID
	$this->delete('/sensores/remove/{id}', function($request, $response, $args){

		$sensor = Sensor::findOrFail( $args['id'] );
		$sensor->delete();
		return $response->withJson( $sensor );

	});

	$this->get('/sensores/data/{id}', function($request, $response, $args){
		$arquivo = "public/data.json";
		$fp = fopen($arquivo, "r");
		$json = file_get_contents($arquivo);
		fclose($fp);
		$sensorData = [];
		$data = json_decode($json);
		foreach ($data as $key => $value){
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

function gravar($dados){
	$arquivo = "public/data.json";
	$arrayData = array();
	$fp = fopen($arquivo, "r");
	$conteudo = fread($fp, filesize($arquivo));
	$arrayData = $conteudo;
	fclose($fp);
	$arrayData = json_decode($arrayData);
	$fp = fopen($arquivo, "w");
	array_push($arrayData, $dados);
	$arrayData = json_encode($arrayData);
	fwrite($fp, $arrayData);
	fclose($fp);
}