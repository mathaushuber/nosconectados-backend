CREATE DATABASE IF NOT EXISTS app_nosconectados;

USE app_nosconectados;

#--------------------------------------------------------------------------------------------------------
#----- Criacao das Tabelas
#-------------------------------------------------------------------------------------------------------- 
CREATE TABLE IF NOT EXISTS usuarios(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    user_password VARCHAR(200) NOT NULL,
    isAdmin TINYINT(1) NOT NULL DEFAULT 0,
    registerConfirmed TINYINT(1) NOT NULL DEFAULT 0,
    firstName VARCHAR(30) NOT NULL,
    lastName VARCHAR(30) NOT NULL,
    document CHAR(11) NOT NULL,
    phone CHAR(11) NOT NULL,
    email VARCHAR(30) NOT NULL,
    facebookProfile VARCHAR(100),
    gender CHAR(1) NOT NULL CHECK(
        gender = 'M'
        or gender = 'F'
        or gender = 'U'
    ),
    birthdayDate DATE,
    updated_at VARCHAR (20),
    created_at VARCHAR (20)
);

#--------------------------------------------------------------------------------------------------------
#--------------------------------------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS imagem(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    idUser INT,
    uri VARCHAR(255) NOT NULL,
    updated_at VARCHAR (20),
    created_at VARCHAR (20)
);

ALTER TABLE
    imagem
ADD
    FOREIGN KEY(idUser) REFERENCES usuarios(id) ON DELETE CASCADE;

#--------------------------------------------------------------------------------------------------------
#--------------------------------------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS localizacao_usuarios(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    street VARCHAR(60) NOT NULL,
    numberU INT NOT NULL,
    city VARCHAR(30) NOT NULL,
    state VARCHAR(30) NOT NULL,
    zipcode VARCHAR(8) NOT NULL,
    complement CHAR(20),
    neighborhood VARCHAR(30) NOT NULL,
    idUser INT,
    updated_at VARCHAR (20),
    created_at VARCHAR (20)
);

#--------------------------------------------------------------------------------------------------------
#--------------------------------------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS informacao_sensors(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    lowDescription CHAR(150) NOT NULL,
    description VARCHAR(500),
    isActive TINYINT(2) NOT NULL DEFAULT 0,
    isPublic TINYINT(1) NOT NULL DEFAULT 0,
    area DECIMAL (10, 2) NOT NULL,
    typeProduction VARCHAR(30) NOT NULL,
    latitude DECIMAL(10, 8),
    longitude DECIMAL(11, 8),
    property VARCHAR(30) NOT NULL,
    state VARCHAR(30) NOT NULL,
    city VARCHAR(30) NOT NULL,
    idSensor INT,
    updated_at VARCHAR (20),
    created_at VARCHAR (20)
);

CREATE TABLE IF NOT EXISTS atribuicao_sensors(
    id INT NOT NULL AUTO_INCREMENT,
    idInfoSensor INT NOT NULL,
    isAdminSensor TINYINT(2) NOT NULL DEFAULT 2,
    idUsuario INT NOT NULL,
    updated_at CHAR (20),
    created_at CHAR (20),
    PRIMARY KEY(id, idUsuario, idInfoSensor),
    FOREIGN KEY (idInfoSensor) REFERENCES informacao_sensors(id),
    FOREIGN KEY (idUsuario) REFERENCES usuarios(id)
);

CREATE TABLE IF NOT EXISTS sensors(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    readAt VARCHAR(30) NOT NULL,
    temperatureSoil NUMERIC (10, 5),
    temperatureAir NUMERIC (10, 5),
    luminosity NUMERIC (10, 5),
    pluviometer NUMERIC (10, 5),
    ultraviolet NUMERIC (10, 5),
    temperatureCase NUMERIC (10, 5),
    rainIntensity NUMERIC (10, 5),
    windDirection NUMERIC (10, 5),
    windSpeed NUMERIC (10, 5),
    gas NUMERIC (10, 5),
    humidityAirRelative NUMERIC (10, 5),
    altitude DECIMAL (5, 2),
    pressure DECIMAL (5, 2),
    updated_at VARCHAR (20),
    created_at VARCHAR (20)
);

CREATE TABLE IF NOT EXISTS dados(
    id INT NOT NULL,
    readAt VARCHAR(30) NOT NULL,
    temperatureSoil NUMERIC (10, 5),
    temperatureAir NUMERIC (10, 5),
    luminosity NUMERIC (10, 5),
    pluviometer NUMERIC (10, 5),
    ultraviolet NUMERIC (10, 5),
    temperatureCase NUMERIC (10, 5),
    rainIntensity NUMERIC (10, 5),
    windDirection NUMERIC (10, 5),
    windSpeed NUMERIC (10, 5),
    gas NUMERIC (10, 5),
    humidityAirRelative NUMERIC (10, 5),
    altitude DECIMAL (5, 2),
    pressure DECIMAL (5, 2),
    updated_at VARCHAR (20),
    created_at VARCHAR (20)
);

#--ALTER TABLE usuarios ADD FOREIGN KEY(sensorId) 
#--                REFERENCES sensors(id) 
#--                            ON DELETE CASCADE;
#--CREATE TABLE IF NOT EXISTS localizacao_sensors(
#--    idLocalizacaoSensor INT NOT NULL,
#--    idSensor INT NOT NULL,
#--    PRIMARY KEY(idSensor, idLocalizacaoSensor),
#--    FOREIGN KEY (idLocalizacaoSensor) 
#--        REFERENCES informacao_sensors(id),
#--    FOREIGN KEY (idSensor) 
#--        REFERENCES sensors(id)
#--);
#--CREATE TABLE IF NOT EXISTS sensors(
#--    id INT NOT NULL AUTO_INCREMENT  PRIMARY KEY,
#-- readAt VARCHAR(30) NOT NULL,
#--sensorData JSON, -- novo campo para armazenar os dados dos sensores
#-- altitude DECIMAL (5,2),
#-- updated_at VARCHAR (20),
#--created_at VARCHAR (20)
);