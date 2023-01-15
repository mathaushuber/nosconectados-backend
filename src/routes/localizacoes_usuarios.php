<?php

use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\LocalizacaoUsuario;

// Rotas para localizacoes
$app->group('/api/v1', function(){
	
	// Lista localizacoes
	$this->get('/localizacoes-users/lista', function($request, $response){
		$localizacoes = LocalizacaoUsuario::get();
		return $response->withJson( $localizacoes );

	});

	// Adiciona um localizacoes
	$this->post('/localizacoes-users/adiciona', function($request, $response){
		
		$dados = $request->getParsedBody();
		//Validar

		$localizacoes = LocalizacaoUsuario::create( $dados );
		return $response->withJson( $localizacoes );

	});

	// Recupera localizacoes para um determinado ID
	$this->get('/localizacoes-users/lista/{id}', function($request, $response, $args){
		
		$localizacoes = LocalizacaoUsuario::findOrFail( $args['id'] );
		return $response->withJson( $localizacoes );

	});

	// Atualiza localizacoes para um determinado ID
	$this->put('/localizacoes-users/atualiza/{id}', function($request, $response, $args){
		
		$dados = $request->getParsedBody();
		$localizacoes = LocalizacaoUsuario::findOrFail( $args['id'] );
		$localizacoes->update( $dados );
		return $response->withJson( $localizacoes );

	});

	// Remove localizacoes para um determinado ID
	$this->delete('/localizacoes-users/remove/{id}', function($request, $response, $args){

		$localizacoes = LocalizacaoUsuario::findOrFail( $args['id'] );
		$localizacoes->delete();
		return $response->withJson( $localizacoes );

	});


});
