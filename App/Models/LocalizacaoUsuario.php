<?php
/*
Este é um código PHP que define uma classe chamada "LocalizacaoUsuario" que estende a classe "Model" do namespace "Illuminate\Database\Eloquent".
A classe tem uma propriedade protegida "$fillable" que contém uma matriz de nomes de colunas que podem ser atribuídas em massa. Isso significa que essas colunas podem ser preenchidas com valores usando os métodos "criar" ou "atualizar" sem precisar definir explicitamente cada valor de coluna, um por um.

As colunas no array "$fillable" são:

     'street': uma string representando o nome da rua do endereço do usuário
     'numberU': uma string que representa o número do endereço do usuário
     'city': uma string representando a cidade onde o usuário mora
     'estado': uma string representando o estado onde o usuário mora
     'zipcode': uma string que representa o CEP do endereço do usuário
     'complemento': uma string que representa informações adicionais sobre o endereço do usuário
     'neighborhood': uma string que representa o bairro onde o usuário mora
     'idUser': um número inteiro que representa o ID do usuário ao qual o endereço pertence
     'updated_at': um timestamp representando a última vez que o registro foi atualizado
     'created_at': um timestamp representando a hora em que o registro foi criado.

Esses nomes de coluna correspondem a colunas na tabela de banco de dados que esse modelo representa.
*/
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
/**
 * 
 */
class LocalizacaoUsuario extends Model
{
    
    protected $fillable = [
		'street', 'numberU', 
		'city', 'state', 'zipcode', 'complement', 'neighborhood', 'idUser',
        'updated_at', 'created_at'
	];

}