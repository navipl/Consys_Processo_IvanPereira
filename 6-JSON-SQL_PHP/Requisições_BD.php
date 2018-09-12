
<?php 
require 'conect.php';//Chama a conexão com o Banco de dados feita no arquivo conect.php

$data = file_get_contents('pessoas.json'); //Recebe o arquivo JSON 
$pessoas = json_decode( $data); //Transforma o arquivo JSON em um objeto

//Faz a inserção dos dados do JSON nas variáveis do banco de dados
foreach ($pessoas as $pessoa) {
	$stmt = $conn->prepare('insert into pessoas(nome, ddd, telefone, cpf, sabe_programar) values(:nome, :ddd, :telefone, :cpf, :sabe_programar)');//Através de chamada Mysql atribui os valores do JSON de cada objeto nas 
	$stmt->bindValue('nome', $pessoa->nome);
	$stmt->bindValue('ddd', $pessoa->ddd);
	$stmt->bindValue('telefone', $pessoa->telefone);
	$stmt->bindValue('cpf', $pessoa->cpf);
	$stmt->bindValue('sabe_programar', $pessoa->sabe_programar);
	$stmt->execute();
}

   //Faz a chamada dos dados no banco de dados
   $res = $conn->query("SELECT id, nome, ddd, telefone, cpf, sabe_programar FROM pessoas")->fetchAll();
   if(!$res){
      print_r($conn->errorInfo());//Casso aja erro ele é exibido
   }
 
   //Exibe os dados recebidos do banco de dados
   foreach ($res as $reg){
      echo '<p><b>Nome: ' . $reg['nome'] . '</b><br/>';
      echo 'Telefone: (' . $reg['ddd'] .") " . $reg['telefone'] . '<br/>';
      echo 'CPF: ' . $reg['cpf'] . '<br/>';

      if ($reg['sabe_programar'] == 1) {
      	$sp = "Sim";
      }
      else {
      	$sp = "Não";
      }

      echo 'Sabe Programar: ' . $sp . '</p>';
   }
?>
