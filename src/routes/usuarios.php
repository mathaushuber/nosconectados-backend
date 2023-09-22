<?php

/**
  * Este código cria um grupo de rotas para o terminal '/api/v1'.
  *
  * A primeira rota é uma solicitação GET para '/usuários/lista' que retorna uma lista de todos os usuários.
  *
  * A segunda rota é uma solicitação GET para '/usuarios/nomes' que retorna uma lista de todos os usuários com seus nomes e sobrenomes.
  *
  * A terceira rota é uma requisição POST para '/usuários/cadastro' que adiciona um novo usuário ao banco de dados. Requer a senha do usuário, isAdmin status, registerConfirmed status, firstName, lastName, phone, email, gender, document, street, numberU, city, state, zipcode, and district.
  *
  * A quarta rota é uma solicitação GET para '/usuários/lista/{id}' que retorna o usuário com o ID especificado.
  *
  * A quinta rota é uma requisição PUT para '/usuarios/atualiza/{id}' que atualiza o usuário com o ID especificado.
  *
  * A sexta rota é uma solicitação DELETE para '/usuarios/remove/{id}' que remove o usuário com o ID especificado.*/
  
use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\Usuario;
use App\Models\LocalizacaoUsuario;
// Criando um grupo de rotas
$app->group('/api/v1', function () {

	// Retorna uma lista de todos os usuarios com todas as informações
	$this->get('/usuarios/lista', function ($request, $response) {
		$usuarios = Usuario::get();
		return $response->withJson($usuarios);
	});

	//Retorna uma lista de todos os usuários com seus nomes e sobrenomes.
	$this->get('/usuarios/nomes', function ($request, $response) {
		$usuarios = Usuario::get();
		foreach ($usuarios as $key => $value) {
			$arrayData[$key] = array(
				"id" => $value->id,
				"firstName" => $value->firstName,
				"lastName" => $value->lastName,
			);
		}
		return $response->withJson($arrayData);
	});

	// Adiciona um usuario
	$this->post('/usuarios/cadastro', function ($request, $response) {
		$dados = $request->getParsedBody();
		foreach ($dados as $key => $value) {
			if ($dados[$key] == "") {
				$dados[$key] = null;
			}
		}
		if (
			$dados['user_password'] != null && $dados['isAdmin'] != null && $dados['registerConfirmed'] != null &&
			$dados['firstName'] != null && $dados['lastName'] != null && $dados['phone'] != null && $dados['email'] != null &&
			$dados['gender'] != null && $dados['document'] != null && $dados['street'] != null && $dados['numberU'] != null &&
			$dados['city'] != null && $dados['state'] != null && $dados['zipcode'] != null && $dados['neighborhood'] != null
		) {
			$dadosUsuario = array(
				"user_password" => md5($dados['user_password']),
				"isAdmin" => $dados['isAdmin'],
				"registerConfirmed" => $dados['registerConfirmed'],
				"firstName" => $dados['firstName'],
				"lastName" => $dados['lastName'],
				"phone" => $dados['phone'],
				"email" => $dados['email'],
				"facebookProfile" => $dados['facebookProfile'],
				"gender" => $dados['gender'],
				"birthdayDate" => $dados['birthdayDate'],
				"document" => $dados['document'],
			);
			$usuario = Usuario::create($dadosUsuario);
			$idUsuario = $usuario->id;
			$dadosLocalizacao = array(
				"street" => $dados['street'],
				"numberU" => $dados['numberU'],
				"city" => $dados['city'],
				"state" => $dados['state'],
				"zipcode" => $dados['zipcode'],
				"complement" => $dados['complement'],
				"neighborhood" => $dados['neighborhood'],
				"idUser" => $idUsuario,
			);
			$localizacao = LocalizacaoUsuario::create($dadosLocalizacao);
			$arrayData = array_merge($dadosUsuario, $dadosLocalizacao);
			return $response->withJson($arrayData);
		} else {
			return $response->withStatus(400);
		}
	});

	// Recupera usuario para um determinado ID
	$this->get('/usuarios/lista/{id}', function ($request, $response, $args) {

		$usuario = Usuario::findOrFail($args['id']);
		return $response->withJson($usuario);
	});

	// Atualiza usuario para um determinado ID
	$this->put('/usuarios/atualiza/{id}', function ($request, $response, $args) {

		$dados = $request->getParsedBody();
		$usuario = Usuario::findOrFail($args['id']);
		$usuario->update($dados);
		return $response->withJson($usuario);
	});

	// Remove usuario para um determinado ID
	$this->delete('/usuarios/remove/{id}', function ($request, $response, $args) {

		$usuario = Usuario::findOrFail($args['id']);
		$usuario->delete();
		return $response->withJson($usuario);
	});
});
