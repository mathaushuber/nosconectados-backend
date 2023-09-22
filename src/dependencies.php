<?php
/*
Este é um arquivo de configuração para contêiner de injeção de dependência (DIC) em um aplicativo PHP construído com o framework Slim. O DIC é usado para gerenciar e injetar dependências em diferentes partes do aplicativo.
A configuração define três serviços:

renderer: Este serviço é responsável por renderizar visualizações. Ele usa a classe PhpRenderer do framework Slim e é configurado com um caminho para o diretório que contém os arquivos de modelo.

logger: Este serviço configura um logger Monolog. Ele é configurado com um nome e caminho de arquivo de log da matriz de configurações e um nível de log.

db: Este serviço configura uma conexão de banco de dados usando o Eloquent ORM do framework Laravel. Ele cria uma nova instância do Capsule, adiciona uma conexão do array de configurações, define a instância como global, inicializa o Eloquent e retorna a instância do Capsule.

Cada serviço é definido como um encerramento que retorna uma instância da classe correspondente. O parâmetro $c é a instância do contêiner DIC, que é usado para recuperar outras dependências conforme necessário.
Esse arquivo de configuração normalmente é usado em conjunto com outros arquivos que definem rotas, controladores e outras lógicas de aplicativos. Esses arquivos podem acessar o contêiner DIC para recuperar dependências conforme necessário.
*/

use Illuminate\Database\Capsule\Manager as Capsule;


$container = $app->getContainer();

$container['renderer'] = function ($c) {
    $settings = $c->get('settings')['renderer'];
    return new Slim\Views\PhpRenderer($settings['template_path']);
};

$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};

$container['db'] = function ($c) {

    $capsule = new Capsule;
    $capsule->addConnection($c->get('settings')['db']);

    $capsule->setAsGlobal();
    $capsule->bootEloquent();

    return $capsule;
};