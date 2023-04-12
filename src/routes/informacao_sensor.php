<?php

/**
  * Este código PHP faz parte de um grupo de rotas para o terminal '/api/v1'. Ele contém cinco rotas para gerenciar sensores de informação.
  *
  * A primeira rota é uma requisição GET para '/informacoes-sensor/lista' que retorna uma lista de sensores de informação.
  *
  * A segunda rota é uma solicitação POST para '/informacoes-sensor/adiciona' que adiciona um novo sensor de informação. Ele requer um cabeçalho de autorização com um token JWT e também requer um corpo analisado com os seguintes parâmetros: propriedade, typeProduction, lowDescription, descrição, área, isActive, isPublic, estado, cidade, latitude e longitude. Também requer três parâmetros adicionais: administradores, patrocinadores e visualizadores, que são todos objetos JSON.
  *
  * A terceira rota é uma requisição GET para '/informacoes-sensor/lista/{id}' que retorna um sensor de informação para um determinado ID.
  *
  * A quarta rota é uma requisição PUT para '/informacoes-sensor/atualiza/{id}' que atualiza um sensor de informação para um dado ID. Requer um corpo analisado com os parâmetros a serem atualizados.
  *
  * A quinta rota é uma solicitação DELETE para '/informacoes-sensor/remove/{id}' que remove um sensor de informação para um determinado ID.*/
  
use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\InformacaoSensor;
use App\Models\AtribuicaoSensor;
use \Firebase\JWT\JWT;

// Rotas para informacoes
$app->group('/api/v1', function () {

	// Lista informacoes
	$this->get('/informacoes-sensor/lista', function ($request, $response) {
		$informacoes = InformacaoSensor::get();
		return $response->withJson($informacoes);
	});

	// Adiciona um informacoes
	$this->post('/informacoes-sensor/adiciona', function ($request, $response) {
		$headers = getallheaders();
		$authorization = $headers['Authorization'] ?? null;
		$secretKey = $this->get('settings')['secretKey'];
		$usuario = JWT::decode($authorization, $secretKey, ['HS256']);
		$idUser = $usuario->id;
		$dados = $request->getParsedBody();
		foreach ($dados as $key => $value) {
			if ($dados[$key] == "") {
				$dados[$key] = null;
			}
		}
		$informacoesSensor = array(
			"property" => $dados['property'],
			"typeProduction" => $dados['typeProduction'],
			"lowDescription" => $dados['lowDescription'],
			"description" => $dados['description'],
			"area" => $dados['area'],
			"isActive" => $dados['isActive'],
			"isPublic" => $dados['isPublic'],
			"state" => $dados['state'],
			"city" => $dados['city'],
			"latitude" => $dados['latitude'],
			"longitude" => $dados['longitude'],
		);
		$informacoes = InformacaoSensor::create($informacoesSensor);
		$idInfoSensor = $informacoes->id;
		$userAdmin = array(
			'idInfoSensor' => $idInfoSensor,
			'isAdminSensor' => 2,
			'idUsuario' => $idUser,
		);
		AtribuicaoSensor::create($userAdmin);
		$admin = $dados['administradores'];
		$patro = $dados['patrocinadores'];
		$visua = $dados['visualizadores'];
		$administradores = json_decode($admin);
		$patrocinadores = json_decode($patro);
		$visualizadores = json_decode($visua);
		foreach ($administradores as $key => $value) {
			if ($value->id != null) {
				$arrayAdmin[$key] = array(
					'idInfoSensor' => $idInfoSensor,
					'isAdminSensor' => 2,
					'idUsuario' => $value->id,
				);
				AtribuicaoSensor::create($arrayAdmin[$key]);
			}
		}
		foreach ($patrocinadores as $key => $value) {
			if ($value->id != null) {
				$arrayPatro[$key] = array(
					'idInfoSensor' => $idInfoSensor,
					'isAdminSensor' => 1,
					'idUsuario' => $value->id,
				);
				AtribuicaoSensor::create($arrayPatro[$key]);
			}
		}
		foreach ($visualizadores as $key => $value) {
			if ($value->id != null) {
				$arrayVisua[$key] = array(
					'idInfoSensor' => $idInfoSensor,
					'isAdminSensor' => 0,
					'idUsuario' => $value->id,
				);
				AtribuicaoSensor::create($arrayVisua[$key]);
			}
		}
		return $response->withJson($informacoesSensor);
	});

	// Recupera informacoes para um determinado ID
	$this->get('/informacoes-sensor/lista/{id}', function ($request, $response, $args) {

		$informacoes = InformacaoSensor::findOrFail($args['id']);
		return $response->withJson($informacoes);
	});

	// Atualiza informacoes para um determinado ID
	$this->put('/informacoes-sensor/atualiza/{id}', function ($request, $response, $args) {

		$dados = $request->getParsedBody();
		$informacoes = InformacaoSensor::findOrFail($args['id']);
		$informacoes->update($dados);
		return $response->withJson($informacoes);
	});

	// Remove informacoes para um determinado ID
	$this->delete('/informacoes-sensor/remove/{id}', function ($request, $response, $args) {
		$informacoes = InformacaoSensor::findOrFail($args['id']);
		$atribuicao = AtribuicaoSensor::where('idInfoSensor', $args['id'])->get();
		$atribuicao->each->delete();
		$informacoes->delete();
		return $response->withJson($informacoes);
	});
});
