<?php

class Test 
{
    public static function staticMethod() {
        echo "hello";
    }

    public function methodNotStatic() {
        
    }
}

// Chama o método estático
Test::staticMethod(); // Imprime "hello"

// Instância a classe
$obj = new Test();

// Chama o método não estático
$obj->methodNotStatic(); // Não imprime nada, pois não há nenhum conteúdo nesse método

?>

// xA forma correta de se chamar o método estático "staticMethod" é "c) self::staticMethod()".
