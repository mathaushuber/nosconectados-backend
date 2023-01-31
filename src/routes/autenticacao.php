<?php

use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\Usuario;
use App\Models\InformacaoSensor;
use App\Models\AtribuicaoSensor;
use App\Models\LocalizacaoUsuario;
use App\Models\Sensor;
use \Firebase\JWT\JWT;

//Rota de bem vindo a API
$app->get('/', function ($request, $response){
	return $response->withJson([
		'Mensagem' => 'Bem vindo a API do nosconectados'
	]);
});

//Rota para usuário logado
$app->get('/api/user', function($request, $response){
	$headers = getallheaders();
	$authorization = $headers['Authorization'] ?? null;
	$secretKey = $this->get('settings')['secretKey'];

	$usuario = JWT::decode($authorization, $secretKey, ['HS256']);
	$localizacaoUsuario = LocalizacaoUsuario::where('idUser', $usuario->id)->first();
		return $response->withJson([
			'id' => $usuario->id,
			'isAdmin' => $usuario->isAdmin,
			'registerConfirmed' => $usuario->registerConfirmed,
			'firstName' => $usuario->firstName,
			'lastName' => $usuario->lastName,
			'document' => $usuario->document,
			'phone' => $usuario->phone,
			'email' => $usuario->email,
			'facebookProfile' => $usuario->facebookProfile,
			'gender' => $usuario->gender,
			'birthdayDate' => $usuario->birthdayDate,
			'updated_at_user' => $usuario->updated_at,
			'created_at_user' => $usuario->created_at,
			'street' => $localizacaoUsuario->street,
			'numberU' => $localizacaoUsuario->numberU,
			'city' => $localizacaoUsuario->city,
			'state' => $localizacaoUsuario->state,
			'zipcode' => $localizacaoUsuario->zipcode,
			'complement' => $localizacaoUsuario->complement,
			'neighborhood' => $localizacaoUsuario->neighborhood,
			'idUser' => $localizacaoUsuario->idUser,
			'update_at_local' => $localizacaoUsuario->updated_at,
			'created_at_local' => $localizacaoUsuario->created_at,
		]);

});

$app->get('/api/sensor', function($request, $response){
	$headers = getallheaders();
	$authorization = $headers['Authorization'] ?? null;
	$secretKey = $this->get('settings')['secretKey'];
	$usuario = JWT::decode($authorization, $secretKey, ['HS256']);
	$idUser = $usuario->id;
	$atribuicaoSensor = AtribuicaoSensor::get();
	$infoSensor = InformacaoSensor::get();
	$dadosSensor = Sensor::get();
	$tamInfo = sizeof($infoSensor);
	foreach($atribuicaoSensor as $key => $value){
		if($idUser == $value->idUsuario){
			$sensorData[$key] = $atribuicaoSensor[$key];
		}
	}
	for($i = 0; $i < $tamInfo; $i++){
		foreach($sensorData as $key => $value){
			if($infoSensor[$i]->id == $value->idInfoSensor){
				$data[$i] = $infoSensor[$i];
			}
		}
	}

	return $response->withJson($data, 200);
	
});

// Rotas para geração de token
$app->post('/api/login', function($request, $response){

	$dados = $request->getParsedBody();
	$email = $dados['email'] ?? null;
	$senha = $dados['user_password'] ?? null;
	
	$usuario = Usuario::where('email', $email)->first();
	if( !is_null($usuario) && (md5($senha) === $usuario->user_password ) ){

		//gerar token
		$secretKey   = $this->get('settings')['secretKey'];
		$chaveAcesso = JWT::encode($usuario, $secretKey);
		return $response->withJson([
			'token' => $chaveAcesso,
			'nome' => $usuario->firstName,
		]);

	}else{
		return	$response->withStatus(401);
	}




});
