<?php
$matematicos = ['Pitagoras' => ['Idade' => 80,'Pais' => 'Grécia' ],'Gauss' => ['Idade' => 77,'Pais' => 'Alemanha' ],'Galileu' => ['Idade' => 77,'Pais' => 'Itália']];

foreach ($matematicos as $nome => $dados) {
    echo "Nome: $nome". PHP_EOL;
    echo "Idade: " . $dados['Idade'] . PHP_EOL;
    echo "País: " . $dados['Pais'] . PHP_EOL;
    echo PHP_EOL;
}
