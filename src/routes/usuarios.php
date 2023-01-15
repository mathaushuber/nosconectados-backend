<?php

use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\Usuario;

// Rotas para produtos
$app->group('/api/v1', function(){
	
	// Lista produtos
	$this->get('/usuarios/lista', function($request, $response){
		$produtos = Usuario::get();
		return $response->withJson( $produtos );

	});

	// Adiciona um usuario
	$this->post('/usuarios/cadastro', function($request, $response){
		
		$dados = $request->getParsedBody();
		//Validar

		$usuario = Usuario::create( $dados );
		return $response->withJson( $usuario );

	});

	// Recupera usuario para um determinado ID
	$this->get('/usuarios/lista/{id}', function($request, $response, $args){
		
		$usuario = Usuario::findOrFail( $args['id'] );
		return $response->withJson( $usuario );

	});

	// Atualiza usuario para um determinado ID
	$this->put('/usuarios/atualiza/{id}', function($request, $response, $args){
		
		$dados = $request->getParsedBody();
		$usuario = Usuario::findOrFail( $args['id'] );
		$usuario->update( $dados );
		return $response->withJson( $usuario );

	});

	// Remove usuario para um determinado ID
	$this->delete('/usuarios/remove/{id}', function($request, $response, $args){

		$usuario = Usuario::findOrFail( $args['id'] );
		$usuario->delete();
		return $response->withJson( $usuario );

	});


});
