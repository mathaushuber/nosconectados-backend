<?php

/**
  * Este código cria um grupo de rotas para a API versão 1, que estão relacionadas ao modelo LocalizacaoUsuario.
  *
  *As rotas são:
  *
  * GET '/api/v1/localizacoes-users/lista' - Lista todos os objetos LocalizacaoUsuario.
  * POST '/api/v1/localizacoes-users/adiciona' - Adiciona um novo objeto LocalizacaoUsuario.
  * GET '/api/v1/localizacoes-users/lista/{id}' - Recupera um objeto LocalizacaoUsuario com o ID especificado.
  * PUT '/api/v1/localizacoes-users/atualiza/{id}' - Atualiza um objeto LocalizacaoUsuario com o ID especificado.
  * DELETE '/api/v1/localizacoes-users/remove/{id}' - Exclui um objeto LocalizacaoUsuario com o ID especificado.*/


use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\LocalizacaoUsuario;

// Rotas para localizacoes
$app->group('/api/v1', function () {

	// Lista localizacoes
	$this->get('/localizacoes-users/lista', function ($request, $response) {
		$localizacoes = LocalizacaoUsuario::get();
		return $response->withJson($localizacoes);
	});

	// Adiciona um localizacoes
	$this->post('/localizacoes-users/adiciona', function ($request, $response) {

		$dados = $request->getParsedBody();
		$localizacoes = LocalizacaoUsuario::create($dados);
		return $response->withJson($localizacoes);
	});

	// Recupera localizacoes para um determinado ID
	$this->get('/localizacoes-users/lista/{id}', function ($request, $response, $args) {

		$localizacoes = LocalizacaoUsuario::findOrFail($args['id']);
		return $response->withJson($localizacoes);
	});

	// Atualiza localizacoes para um determinado ID
	$this->put('/localizacoes-users/atualiza/{id}', function ($request, $response, $args) {

		$dados = $request->getParsedBody();
		$localizacoes = LocalizacaoUsuario::findOrFail($args['id']);
		$localizacoes->update($dados);
		return $response->withJson($localizacoes);
	});

	// Remove localizacoes para um determinado ID
	$this->delete('/localizacoes-users/remove/{id}', function ($request, $response, $args) {

		$localizacoes = LocalizacaoUsuario::findOrFail($args['id']);
		$localizacoes->delete();
		return $response->withJson($localizacoes);
	});
});
