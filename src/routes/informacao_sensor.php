<?php

use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\InformacaoSensor;

// Rotas para informacoes
$app->group('/api/v1', function(){
	
	// Lista informacoes
	$this->get('/informacoes-sensor/lista', function($request, $response){
		$informacoes = InformacaoSensor::get();
		return $response->withJson( $informacoes );

	});

	// Adiciona um informacoes
	$this->post('/informacoes-sensor/adiciona', function($request, $response){
		
		$dados = $request->getParsedBody();
		//Validar

		$informacoes = InformacaoSensor::create( $dados );
		return $response->withJson( $informacoes );

	});

	// Recupera informacoes para um determinado ID
	$this->get('/informacoes-sensor/lista/{id}', function($request, $response, $args){
		
		$informacoes = InformacaoSensor::findOrFail( $args['id'] );
		return $response->withJson( $informacoes );

	});

	// Atualiza informacoes para um determinado ID
	$this->put('/informacoes-sensor/atualiza/{id}', function($request, $response, $args){
		
		$dados = $request->getParsedBody();
		$informacoes = InformacaoSensor::findOrFail( $args['id'] );
		$informacoes->update( $dados );
		return $response->withJson( $informacoes );

	});

	// Remove informacoes para um determinado ID
	$this->delete('/informacoes-sensor/remove/{id}', function($request, $response, $args){

		$informacoes = InformacaoSensor::findOrFail( $args['id'] );
		$informacoes->delete();
		return $response->withJson( $informacoes );

	});


});
