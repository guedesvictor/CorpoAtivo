<?php

$nome = $_POST['nome'];
$senha_digitada = $_POST['senha'];

/*se email ou senha estiverem
em branco ou não existirem, volta para 
a página de login 

if ($nome == '' || $senha_digitada == '') {
	Header('Location: http://localhost/CorpoAtivo/login.php?erro=1');
}
*/
//conectar ao banco
//selecionar usuario e senha do banco
//conferir se bate com os dados recebidos do form
$conexao = new PDO('mysql:host=localhost;dbname=ca',
					'root',
					'');
//select na senha do usuário informado
$comando = $conexao->prepare('SELECT id,senha FROM alunos WHERE nome = :n');
$comando->bindParam(':n', $nome);
$comando->execute();

if ($linha = $comando->fetch()) {
	$senha_banco = $linha['senha'];
	$id = $linha['id'];

	
	//verifica se a senha está correta
	if ( password_verify($senha_digitada, $senha_banco) ) {
		//senha correta
		//abrir sessão
		session_start();
		$_SESSION['id'] = $id;
		$_SESSION['nome'] = $nome;
		
		Header('Location: http://localhost/CorpoAtivo/index.html');
	}
	else {
		Header('Location: http://localhost/CorpoAtivo/login.php?erro=2');
	}
}

else {
	Header('Location: http://localhost/CorpoAtivo/login.php?erro=2');
}












?>