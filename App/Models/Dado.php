<?php
/*
Este é um código PHP que define uma classe de modelo chamada "Dado" no namespace "App\Models". O modelo estende a classe "Illuminate\Database\Eloquent\Model".

A propriedade "$fillable" é uma matriz de atributos que podem ser atribuídos em massa. Esses atributos podem ser definidos usando o método "preencher" ou "criar" do modelo, que pode receber uma matriz de pares chave-valor. Todos os outros atributos que não estiverem nesta matriz não poderão ser atribuídos em massa.

Os atributos listados neste código incluem:

     id: o identificador único do registro
     readAt: o timestamp de quando os dados foram lidos
     temperatureSoil: a temperatura do solo
     temperatureAir: a temperatura do ar
     luminosidade: o nível de luminosidade
     pluviômetro: a quantidade de chuva
     ultravioleta: o nível de radiação ultravioleta
     temperatureCase: a temperatura da caixa do instrumento
     rainIntensity: a intensidade da chuva
     windDirection: a direção do vento
     windSpeed: a velocidade do vento
     gás: o nível de gás no ar
     UmidadeAirRelative: a umidade relativa do ar
     altitude: a altitude do local
     pressão: a pressão do ar
     updated_at: o carimbo de data/hora da última atualização do registro
     created_at: o timestamp de quando o registro foi criado.
*/
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
/**
 * 
 */
class Dado extends Model
{
	
	protected $fillable = [
		'id', 'readAt', 'temperatureSoil', 'temperatureAir', 
		'luminosity', 'pluviometer', 'ultraviolet', 'temperatureCase',
        'rainIntensity', 'windDirection', 'windSpeed', 'gas', 'humidityAirRelative', 'altitude',
        'pressure', 'updated_at', 'created_at'
	];

}