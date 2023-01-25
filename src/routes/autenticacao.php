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
	$temp = array();
	foreach($atribuicaoSensor as $key => $value){
		$temp[$key] = $value->idUsuario;
	}
	sort($temp);
	foreach ($atribuicaoSensor as $key => $value){
		$infoSensor[$key] = InformacaoSensor::where('id', $temp[$key])->first(); // [1] = são iguais [2] = 
		$idSensor[$key] = Sensor::where('id', $value->idInfoSensor)->first();
		if($idUser == $value->idUsuario && !is_null($infoSensor[$key])){
	
		$sensorData[$key] = array("id"=>$idSensor[$key]->id,
		'firstName' => $usuario->firstName,
		'lastName' => $usuario->lastName,
		'lowDescription' => $infoSensor[$key]->lowDescription,
		'description' => $infoSensor[$key]->description,
		'isActive' => $infoSensor[$key]->isActive,
		'isPublic' => $infoSensor[$key]->isPublic,
		'area' => $infoSensor[$key]->area,
		'typeProduction' => $infoSensor[$key]->typeProduction,
		'latitude' => $infoSensor[$key]->latitude,
		'longitude' => $infoSensor[$key]->longitude,
		'property' => $infoSensor[$key]->property,
		'state' => $infoSensor[$key]->state,
		'idSensor' => $infoSensor[$key]->idSensor,
		'city' => $infoSensor[$key]->city,
		'readAt' => $idSensor[$key]->readAt,
		'temperatureSoil' => $idSensor[$key]->temperatureSoil,
		'temperatureAir' => $idSensor[$key]->temperatureAir,
		'luminosity' => $idSensor[$key]->luminosity,
		'pluviometer' => $idSensor[$key]->pluviometer,
		'ultraviolet' => $idSensor[$key]->ultraviolet,
		'temperatureCase' => $idSensor[$key]->temperatureCase,
		'rainIntensity' => $idSensor[$key]->rainIntensity,
		'windDirection' => $idSensor[$key]->windDirection,
		'windSpeed' => $idSensor[$key]->windSpeed,
		'gas' => $idSensor[$key]->gas,
		'humidityAirRelative' => $idSensor[$key]->humidityAirRelative,
		'altitude' => $idSensor[$key]->altitude,
		'pressure' => $idSensor[$key]->pressure);
		}
	}
		return $response->withJson($sensorData,200);
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
