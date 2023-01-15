<?php

use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\AtribuicaoSensor;

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
