<?php
/*
Este é um trecho de código PHP que define o middleware de aplicativo para a aplicação do NOSCONECTADOS utilizando Slim Framework.

O primeiro middleware é um middleware de autenticação JWT fornecido pelo pacote Tuupola\Middleware\JwtAuthentication. Ele valida JSON Web Tokens no cabeçalho "Authorization" das solicitações recebidas para o caminho "/api" (ou uma matriz de caminhos incluindo "/api" e "/admin"), usando uma chave secreta das configurações do aplicativo. A opção "ignorar" especifica uma lista de caminhos que devem ser excluídos da autenticação JWT, como login, registro de usuário e endpoints de sensor e listagem de dados.

O segundo middleware é um middleware CORS que adiciona cabeçalhos CORS à resposta, permitindo solicitações entre origens de qualquer origem. O cabeçalho "Access-Control-Allow-Origin" permite solicitações de qualquer domínio, enquanto os cabeçalhos "Access-Control-Allow-Headers" e "Access-Control-Allow-Methods" especificam quais cabeçalhos e métodos de solicitação são permitidos.

No geral, essas funções de middleware ajudam a proteger e permitir a comunicação entre diferentes partes do aplicativo.
*/
$app->add(new Tuupola\Middleware\JwtAuthentication([
    "header" => "Authorization",
    "secure" => false,
    "regexp" => "/(.*)/",
    "path" => "/api", /* or ["/api", "/admin"] */
    "ignore" => ["/api/login", "/api/v1/sensores/lista", "/api/v1/usuarios/cadastro", "/api/v1/sensores/lista-geral",
                 "/api/v1/dados/lista", "/api/v1/dados/lista/", "/api/v1/atribuicao/lista-geral/"],
    "secret" => $container->get('settings')['secretKey']
]));

$app->add(function ($req, $res, $next) {
    $response = $next($req, $res);
    return $response
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
});
