<?php
/*
Esta é uma classe PHP que estende a classe Illuminate\Database\Eloquent\Model, que é usada para interagir com uma tabela de banco de dados chamada "informacao_sensors". A classe tem um namespace App\Models e se chama InformacaoSensor.

A classe tem uma propriedade protegida $fillable, que é um array contendo os nomes das colunas da tabela "informacao_sensors" que podem ser preenchidos durante a atribuição em massa. Essas colunas são:

     descrição baixa
     descrição
     está ativo
     é público
     área
     typeProduction
     latitude
     longitude
     propriedade
     estado
     cidade
     idSensor
     atualizado_em
     criado em

Isso significa que ao criar ou atualizar uma instância desse modelo usando os métodos create() ou update(), somente as colunas listadas em $fillable serão afetadas. Esta é uma medida de segurança para evitar alterações não autorizadas em outras colunas na tabela do banco de dados.
*/
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
/**
 * 
 */
class InformacaoSensor extends Model
{
    
    protected $fillable = [
		'lowDescription', 'description', 
		'isActive', 'isPublic', 'area', 'typeProduction', 'latitude', 'longitude', 'property',
        'state', 'city', 'idSensor', 'updated_at', 'created_at'
	];

}