<?php
/*
Este é um código PHP que configura rotas para a aplicação do NOSCONECTADOS utilizando Slim Framework.

O código define uma rota OPTIONS que corresponde a qualquer rota. Isso é usado para lidar com solicitações de simulação CORS (Compartilhamento de recursos de origem cruzada).

O código então requer vários arquivos PHP que definem rotas para diferentes funcionalidades do aplicativo, como autenticação, sensores, usuários, etc.

Por fim, há uma rota abrangente que corresponde a qualquer método HTTP e a qualquer rota que não tenha sido definida anteriormente. Esta rota é usada para lidar com erros 404, retornando um manipulador padrão de página Slim não encontrada.

No geral, esse código configura o roteamento para um aplicativo Slim com várias rotas definidas e uma rota abrangente para lidar com erros 404.
*/
use Slim\Http\Request;
use Slim\Http\Response;

$app->options('/{routes:.+}', function ($request, $response, $args) {
    return $response;
});

// Routes
require __DIR__ . '/routes/autenticacao.php';

require __DIR__ . '/routes/sensores.php';

require __DIR__ . '/routes/usuarios.php';

require __DIR__ . '/routes/localizacoes_usuarios.php';

require __DIR__ . '/routes/informacao_sensor.php';

require __DIR__ . '/routes/atribuicao_sensor.php';

require __DIR__ . '/routes/dados.php';

$app->map(['GET', 'POST', 'PUT', 'DELETE', 'PATCH'], '/{routes:.+}', function($req, $res) {
    $handler = $this->notFoundHandler; 
    return $handler($req, $res);
});

