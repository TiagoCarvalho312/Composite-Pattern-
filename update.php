<?php
/*função autoload
*carrega uma classe quando ela é necessária, oou seja, quando é instanciado pela primeira vez
*/

spl_autoload_register(function ($classe) {

    if(file_exists("{$classe}.class.php")){
        include_once "{$classe}.class.php";
    }
});

//cira um criterio de seleção de dados

$criteria = new TCriteria;
$criteria->add(new TFilter('id','=','3'));

//cria instrucao de UPTADE
$sql = new TSqlUpdate;
//define a entidade
$sql->setEntity('aluno');
//atribui o valor de cada coluna 
$sql->setRowData('nome','Pedro Carneiro da Silva');
$sql->setRowData('rua','Machado de Assis');
$sql->setRowData('fone','(88)5555');

// define o criterio de selecao de dados
$sql->setCriteria($criteria);

//procesa instrucao sql

echo $sql->getInstruction();

echo "<br>\n";

?>