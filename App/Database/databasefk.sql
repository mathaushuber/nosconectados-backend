CREATE DATABASE IF NOT EXISTS app_nosconectadosfk;

USE app_nosconectadosfk;

#--------------------------------------------------------------------------------------------------------
#----- Criacao das Tabelas
#-------------------------------------------------------------------------------------------------------- 
CREATE TABLE IF NOT EXISTS usuarios(
    senha VARCHAR(200) NOT NULL,
    adminPlataforma TINYINT(1) NOT NULL DEFAULT 0,
    emailConfirmado TINYINT(1) NOT NULL DEFAULT 0,
    nome VARCHAR(30) NOT NULL,
    sobrenome VARCHAR(30) NOT NULL,
    cpf INT(11) NOT NULL PRIMARY KEY,
    telefone CHAR(11) NOT NULL,
    email VARCHAR(30) NOT NULL,
    perfilFacebook VARCHAR(100),
    sexo CHAR(1) NOT NULL CHECK(
        sexo = 'M'
        or sexo = 'F'
        or sexo = 'U'
    ),
    dataNascimento DATE,
    updated_at VARCHAR (20),
    created_at VARCHAR (20)
);

#--------------------------------------------------------------------------------------------------------
#--------------------------------------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS imagem(
    cpfUsuarioFk INT NOT NULL PRIMARY KEY,
    uri VARCHAR(255) NOT NULL,
    updated_at VARCHAR (20),
    created_at VARCHAR (20)
);

ALTER TABLE
    imagem
ADD
    FOREIGN KEY(cpfUsuarioFk) REFERENCES usuarios(cpf) ON DELETE CASCADE;

#--------------------------------------------------------------------------------------------------------
#--------------------------------------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS localizacao_usuarios(
    localizacaoUsuarioFk INT NOT NULL PRIMARY KEY,
    rua VARCHAR(60) NOT NULL,
    numero INT NOT NULL,
    cidade VARCHAR(30) NOT NULL,
    estado VARCHAR(30) NOT NULL,
    cep VARCHAR(8) NOT NULL,
    complemento CHAR(20),
    bairro VARCHAR(30) NOT NULL,
    updated_at VARCHAR (20),
    created_at VARCHAR (20)
);

ALTER TABLE
    localizacao_usuarios
ADD
    FOREIGN KEY(localizacaoUsuarioFk) REFERENCES usuarios(cpf) ON DELETE CASCADE;

CREATE TABLE IF NOT EXISTS dispositivos(
    codigo  BINARY(16) NOT NULL PRIMARY KEY,
    ativo TINYINT(2) NOT NULL DEFAULT 0,
    publico TINYINT(1) NOT NULL DEFAULT 0,
    listaSensor JSON,
    updated_at VARCHAR (20),
    created_at VARCHAR (20)
);

CREATE TABLE IF NOT EXISTS sensors(
    dispositivoFk  BINARY(16) NOT NULL PRIMARY KEY,
    nome VARCHAR(30) NOT NULL,
    unidade VARCHAR(50) NOT NULL,
    leituras JSON,
    -- novo campo para armazenar os dados dos sensores
    updated_at VARCHAR (20),
    created_at VARCHAR (20)
);

ALTER TABLE
    sensors
ADD
    FOREIGN KEY(dispositivoFk) REFERENCES dispositivos(codigo) ON DELETE CASCADE;

CREATE TABLE IF NOT EXISTS atribuicao_sensors(
    id INT NOT NULL AUTO_INCREMENT,
    codigoDispositivoFk BINARY(16) NOT NULL,
    adminSensor TINYINT(2) NOT NULL DEFAULT 2,
    cpfUsuarioFk INT NOT NULL,
    updated_at CHAR (20),
    created_at CHAR (20),
    PRIMARY KEY(id, cpfUsuarioFk, codigoDispositivoFk),
    FOREIGN KEY (codigoDispositivoFk) REFERENCES dispositivos(codigo),
    FOREIGN KEY (cpfUsuarioFk) REFERENCES usuarios(cpf)
);

CREATE TABLE IF NOT EXISTS dados(
    sensorFk BINARY(16) NOT NULL,
    lidoEm VARCHAR(30) NOT NULL,
    valor FLOAT,
    -- novo campo para armazenar os dados dos sensores
    updated_at VARCHAR (20),
    created_at VARCHAR (20),
    PRIMARY KEY(sensorFk),
    FOREIGN KEY (sensorFk) REFERENCES sensors(dispositivoFk)
);

CREATE TABLE IF NOT EXISTS informacoes_dispositivos(
    dispositivoFk BINARY(16) NOT NULL,
    descricao VARCHAR(300),
    descricaoBreve VARCHAR(150) NOT NULL, 
    latitude DECIMAL(10, 8),
    longitude DECIMAL(11, 8),
    propriedade VARCHAR(30) NOT NULL,
    estado VARCHAR(30) NOT NULL,
    cidade VARCHAR(30) NOT NULL,
    updated_at VARCHAR (20),
    created_at VARCHAR (20)
);

ALTER TABLE
    informacoes_dispositivos
ADD
    FOREIGN KEY(dispositivoFk) REFERENCES dispositivos(codigo) ON DELETE CASCADE;