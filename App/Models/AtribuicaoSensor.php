<?php
/*
Este é um código PHP que define uma classe AtribuicaoSensor no namespace App\Models. A classe estende a classe Illuminate\Database\Eloquent\Model, o que significa que ela herda todos os seus métodos e propriedades.

O objetivo desta classe parece ser representar uma atribuição de um sensor a um usuário ou administrador. Ele possui os seguintes atributos, que são especificados no array $fillable:

     idInfoSensor: o ID do sensor que está sendo atribuído.
     isAdminSensor: um sinalizador booleano que indica se o usuário atribuído é um administrador do sensor.
     idUsuario: o ID do usuário que está sendo atribuído ao sensor.
     updated_at: a data e a hora em que a atribuição foi atualizada pela última vez.
     created_at: a data e hora em que a atribuição foi criada.

A matriz $fillable é usada para especificar quais atributos da classe podem ser atribuídos em massa. A atribuição em massa é uma técnica do Laravel que permite definir vários atributos de um modelo de uma só vez usando um array. Por padrão, todos os atributos de um modelo são protegidos, o que significa que eles não podem ser atribuídos em massa por motivos de segurança. No entanto, especificando a matriz $fillable, você pode permitir explicitamente que determinados atributos sejam atribuídos em massa.

No geral, esse código define uma classe de modelo que pode ser usada para representar atribuições de sensores a usuários do tipo administradores, patrocinadores e visualizadores.
*/ 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
/**
 * 
 */
class AtribuicaoSensor extends Model
{
    
    protected $fillable = [
		'idInfoSensor', 'isAdminSensor', 'idUsuario', 'updated_at', 'created_at'
	];

}