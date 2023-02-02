<?php

use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\InformacaoSensor;
use App\Models\AtribuicaoSensor;
use \Firebase\JWT\JWT;

// Rotas para informacoes
$app->group('/api/v1', function(){
	
	// Lista informacoes
	$this->get('/informacoes-sensor/lista', function($request, $response){
		$informacoes = InformacaoSensor::get();
		return $response->withJson( $informacoes );

	});

	// Adiciona um informacoes
	$this->post('/informacoes-sensor/adiciona', function($request, $response){
		$headers = getallheaders();
		$authorization = $headers['Authorization'] ?? null;
		$secretKey = $this->get('settings')['secretKey'];
		$usuario = JWT::decode($authorization, $secretKey, ['HS256']);
		$idUser = $usuario->id;
		$dados = $request->getParsedBody();
		foreach($dados as $key => $value){
			if($dados[$key] == ""){
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
		$informacoes = InformacaoSensor::create( $informacoesSensor );
		$idInfoSensor = $informacoes->id;
		$userAdmin = array(
			'idInfoSensor' => $idInfoSensor,
			'isAdminSensor' => 2,
			'idUsuario' => $idUser,
		);
		AtribuicaoSensor::create( $userAdmin);
		$admin = $dados['administradores'];
		$patro = $dados['patrocinadores'];
		$visua = $dados['visualizadores'];
		$administradores = json_decode($admin);
		$patrocinadores = json_decode($patro);
		$visualizadores = json_decode($visua);
		foreach($administradores as $key => $value){
			if($value->id != null){
				$arrayAdmin[$key] = array(
					'idInfoSensor' => $idInfoSensor,
					'isAdminSensor' => 2,
					'idUsuario' => $value->id,
				);
				AtribuicaoSensor::create( $arrayAdmin[$key] );
			}
		}
		foreach($patrocinadores as $key => $value){
			if($value->id != null){
				$arrayPatro[$key] = array(
					'idInfoSensor' => $idInfoSensor,
					'isAdminSensor' => 1,
					'idUsuario' => $value->id,
				);
				AtribuicaoSensor::create( $arrayPatro[$key] );
			}
		}
		foreach($visualizadores as $key => $value){
			if($value->id != null){
				$arrayVisua[$key] = array(
					'idInfoSensor' => $idInfoSensor,
					'isAdminSensor' => 0,
					'idUsuario' => $value->id,
				);
				AtribuicaoSensor::create( $arrayVisua[$key] );
			}
		}
		return $response->withJson( $informacoesSensor );

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
		$atribuicao = AtribuicaoSensor::where( 'idInfoSensor', $args['id'])->get();
		$atribuicao->each->delete();
		$informacoes->delete();
		return $response->withJson( $informacoes );

	});


});
