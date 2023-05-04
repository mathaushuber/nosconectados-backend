<?php
/*
Este é um arquivo de configuração do PHP que retorna uma matriz de configurações para a aplicação do NOSCONECTADOS.

     displayErrorDetails: um booleano que determina se os detalhes do erro são exibidos ou não para o usuário. É definido como verdadeiro somente em desenvolvimento, setamos como falso em produção.

     addContentLengthHeader: um booleano que determina se o servidor web tem ou não permissão para enviar o cabeçalho de comprimento de conteúdo. É definido como falso, o que significa que o servidor da Web não tem permissão para enviar esse cabeçalho.

     renderer: um array que contém configurações para o renderizador, que é responsável por renderizar os templates HTML. A configuração template_path especifica o caminho para o diretório que contém os modelos HTML.

     logger: uma matriz que contém configurações para a biblioteca de registro Monolog, que é usada para registrar eventos e erros no aplicativo. A configuração de nome especifica o nome do criador de logs e a configuração de caminho especifica o caminho para o arquivo de log. A configuração de nível especifica o nível de criação de log, que é definido como depuração.

     db: um array que contém configurações para a conexão com o banco de dados. As configurações de driver, host, banco de dados, nome de usuário, senha, charset, agrupamento e prefixo especificam os detalhes da conexão para o banco de dados MySQL. A configuração unix_socket especifica o caminho para o arquivo de soquete do MySQL.

     secretKey: uma string que contém uma chave secreta para o aplicativo. Essa chave pode ser usada para fins de criptografia ou autenticação.

No geral, esse arquivo de configuração fornece configurações importantes para um aplicativo da Web, incluindo tratamento de erros, criação de log, conectividade de banco de dados e segurança.
*/

return [
    'settings' => [
        'displayErrorDetails' => true, // set to false in production
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header

        // Renderer settings
        'renderer' => [
            'template_path' => __DIR__ . '/../templates/',
        ],

        // Monolog settings
        'logger' => [
            'name' => 'slim-app',
            'path' => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/../logs/app.log',
            'level' => \Monolog\Logger::DEBUG,
        ],

        // DB settings
        'db' =>    [
            'driver'    => 'mysql',
            'host'      => 'localhost',
            'database'  => 'app_nosconectados',
            'username'  => 'root',
            'password'  => '',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
            'unix_socket' => '/opt/lampp/var/mysql/mysql.sock',
        ],
        // Secret
        'secretKey' => 'd92347304b7be63e2d4cc3bd63549004c3753d39'
    ],
];
