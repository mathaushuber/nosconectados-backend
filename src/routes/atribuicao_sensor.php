<?php

use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\AtribuicaoSensor;
use App\Models\Usuario;

// Rotas para atribuicoes
$app->group('/api/v1', function(){
	
	// Lista atribuicoes
	$this->get('/atribuicao/lista', function($request, $response){
		$atribuicoes = AtribuicaoSensor::get();
		return $response->withJson( $atribuicoes );

	});

	// Adiciona um atribuicoes
	$this->post('/atribuicao/adiciona', function($request, $response){
		
		$dados = $request->getParsedBody();
		//Validar

		$atribuicoes = AtribuicaoSensor::create( $dados );
		return $response->withJson( $atribuicoes );

	});

	// Recupera atribuicoes para um determinado ID
	$this->get('/atribuicao/lista/{id}', function($request, $response, $args){
		
		$atribuicoes = AtribuicaoSensor::findOrFail( $args['id'] );
		return $response->withJson( $atribuicoes );

	});

	$this->get('/atribuicao/lista-geral', function($request, $response){
		$atribuicoes = AtribuicaoSensor::get();
		$usuario = Usuario::get();
		$tamUser = sizeof($usuario);
		$tamAtrib = sizeof($atribuicoes);
		for ($i = 0; $i < $tamUser; $i++){
			for($j = 0; $j < $tamAtrib; $j++){
					if($usuario[$i]->id == $atribuicoes[$j]->idUsuario){
						$sensorData[$j] = array(
							"id" => $atribuicoes[$j]->id,
							"firstName" => $usuario[$i]->firstName,
							"lastName" => $usuario[$i]->lastName,
							"idInfoSensor" => $atribuicoes[$j]->idInfoSensor,
							"isAdminSensor" => $atribuicoes[$j]->isAdminSensor,
						);
					}
			}
		}
		sort($sensorData);
		return $response->withJson( $sensorData, 200 );

	});

	$this->get('/atribuicao/lista-geral/{id}', function($request, $response, $args){
		$atribuicoes = AtribuicaoSensor::get();
		$usuario = Usuario::get();
		$tamUser = sizeof($usuario);
		$tamAtrib = sizeof($atribuicoes);
		for ($i = 0; $i < $tamUser; $i++){
			for($j = 0; $j < $tamAtrib; $j++){
					if($usuario[$i]->id == $atribuicoes[$j]->idUsuario && $args['id'] == $atribuicoes[$j]->idInfoSensor){
						$sensorData[$j] = array(
							"id" => $atribuicoes[$j]->id,
							"firstName" => $usuario[$i]->firstName,
							"lastName" => $usuario[$i]->lastName,
							"idInfoSensor" => $atribuicoes[$j]->idInfoSensor,
							"isAdminSensor" => $atribuicoes[$j]->isAdminSensor,
						);
					}
			}
		}
		sort($sensorData);
		return $response->withJson( $sensorData, 200 );

	});

	// Atualiza atribuicoes para um determinado ID
	$this->put('/atribuicao/atualiza/{id}', function($request, $response, $args){
		
		$dados = $request->getParsedBody();
		$atribuicoes = AtribuicaoSensor::findOrFail( $args['id'] );
		$atribuicoes->update( $dados );
		return $response->withJson( $atribuicoes );

	});

	// Remove atribuicoes para um determinado ID
	$this->delete('/atribuicao/remove/{id}', function($request, $response, $args){

		$atribuicoes = AtribuicaoSensor::findOrFail( $args['id'] );
		$atribuicoes->delete();
		return $response->withJson( $atribuicoes );

	});


});
