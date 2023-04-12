<?php
/*
Esta é uma classe PHP chamada Usuario que estende a classe Model do namespace Illuminate\Database\Eloquent.

A classe representa um modelo que pode interagir com uma tabela de banco de dados para executar várias operações de banco de dados, como recuperar dados, criar, atualizar ou excluir registros de um banco de dados.

A propriedade $fillable é uma matriz de nomes de colunas que podem ser preenchidas com dados ao criar uma nova instância desse modelo ou atualizar uma existente. Qualquer outra coluna não listada na matriz $fillable não poderá ser atribuída em massa, protegendo contra modificações não intencionais.

Nesse caso, as colunas que podem ser preenchidas são user_password, isAdmin, registerConfirmed, firstName, lastName, document, phone, email, facebookProfile, gender, birthdayDate, updated_at e created_at.
*/
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
/**
 * 
 */
class Usuario extends Model
{
    
    protected $fillable = [
		'user_password', 'isAdmin', 
		'registerConfirmed', 'firstName', 'lastName', 'document', 'phone', 'email',
        'facebookProfile', 'gender', 'birthdayDate', 'updated_at', 'created_at'
	];

}