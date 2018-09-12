<?php 
$conn = new PDO("mysql:host=localhost;dbname=consys",'root','');//Variavel que realiza a nonexão com o Banco de dados 

if (!$conn) {
	echo "falha na Conexão"; //Casso aja um erro na coneção o aviso de falha é acionado
}

else {
	echo "Conexão Sucedida"; //Casso Sucesso a mensagem de aprovação é acionada
}
 ?>