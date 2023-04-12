<?php
/*
Este é um trecho de código PHP que define uma classe de modelo chamada "Sensor" dentro do namespace "App\Models". A classe estende a classe "Illuminate\Database\Eloquent\Model".

A classe tem uma propriedade protegida chamada "$fillable", que é uma matriz de atributos que podem ser atribuídos em massa. Isso significa que você pode definir esses atributos usando os métodos "criar" ou "atualizar" fornecidos pelo Eloquent ORM do Laravel.

Os atributos na matriz "$fillable" são:

     readAt: Um timestamp representando quando os dados do sensor foram lidos
     temperatureSoil: A temperatura do solo em Celsius
     temperatureAir: A temperatura do ar em Celsius
     luminosidade: O nível de luminosidade em lux
     pluviômetro: A quantidade de chuva em milímetros
     ultravioleta: O nível de radiação ultravioleta
     temperatureCase: A temperatura da caixa do sensor em Celsius
     rainIntensity: A intensidade da chuva em milímetros por hora
     windDirection: A direção do vento em graus
     windSpeed: A velocidade do vento em metros por segundo
     gás: O nível de concentração de gás
     UmidadeAirRelative: A umidade relativa do ar
     altitude: A altitude do sensor em metros
     pressão: A pressão atmosférica em kilopascais
     updated_at: Um carimbo de data/hora representando a última vez que o registro foi atualizado
     created_at: Um timestamp representando quando o registro foi criado
*/
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
/**
 * 
 */
class Sensor extends Model
{
	
	protected $fillable = [
		'readAt', 'temperatureSoil', 'temperatureAir', 
		'luminosity', 'pluviometer', 'ultraviolet', 'temperatureCase',
        'rainIntensity', 'windDirection', 'windSpeed', 'gas', 'humidityAirRelative', 'altitude',
        'pressure', 'updated_at', 'created_at'
	];

}