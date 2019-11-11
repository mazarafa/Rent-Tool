<?php
$erros=array();
	# se o botao de cadastro foi clicado
	if(isset($_POST['cadastrar'])){
		$nome = trim(addslashes($_POST['nome']));
		$email = trim(addslashes($_POST['email']));
		$endereco = trim(addslashes($_POST['endereco']));
		$bairro = $_POST['bairro'];
		$perfil = isset($_POST['perfil']) ? $_POST['perfil'] : null;
		$empresa = isset($_POST['empresa']) ? trim(addslashes($_POST['empresa'])) : '';
		$login = trim(addslashes($_POST['login']));
		$senha1 = trim(addslashes($_POST['senha']));
		$senha2 = trim(addslashes($_POST['senha2']));
		$concordo = isset($_POST['concordo']) ? 1 : 0;

		// Validações
		if (empty($nome) || !strstr($nome," "))
			$erros[] = "Digite seu nome completo";

		if(empty($email) || !(filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)))
           $erros[] = "Digite um email válido";	

       	if(empty($endereco))
      		$erros[] = "Digite um endereço válido";  

       	if(empty($bairro))
       		$erros[] = "Selecione um bairro";

       	if($perfil==null)
			$erros[] = "Informe seu perfil";

		// login possui entre 6 e 20 caracteres (letras, números, e underline)
		$regex = "/^[a-z\d_]{6,20}$/i";
		if(empty($login) || !preg_match($regex, $login))
			$erros[] = "O login deve possuir entre 6 e 20 caracteres (letras, números e underline).";
		
		if(strlen($senha1) < 6)
			$erros[] = "A senha deve ter no mínimo 6 caracteres";
		else{
			if($senha1 != $senha2)
				$erros[] = "As senhas não conferem";
		}

		if(!($concordo))
			$erros[] = "Você deve concordar com os termos do site";

		// inserção
		if(count($erros) == 0){
			include "includes/conexao.php";
			$nova = md5($senha1);	
			$sql="INSERT INTO cliente (nome, email, endereco, bairro, perfil, nomeEmpresa, login, senha) VALUES ('$nome', '$email', '$endereco', '$bairro', '$perfil', '$empresa', '$login', '$nova')";
			mysqli_query($conexao, $sql);
		}
	}
?>

<?php
include "includes/cabecalho.php";
?>
<link rel="stylesheet" type="text/css" href="css/forms.css">

<!-- area central com 3 colunas -->
<div class="container">
	<?php
		include "includes/menu_lateral.php";
	?>		

	<section class="col-2">
		<h2>Cadastre-se</h2>
		<?php 
		// caso houver, exibe os erros
		if(isset($erros) and count($erros) > 0){
			echo "<ul>";
			foreach ($erros as $erro) {
				echo "<li style='color:red'>$erro</li>";
			}
			echo "</ul>";
		}
		?>
		<?php 
		// Caso não tenha nenhum erro e esteja clicado o exibirá a mensagem de sucesso
		if(!(isset($_POST['cadastrar'])) || count($erros)!=0){
		?>
		<div>
			<form action="" method="post" id="form-contato">
			    <div class="form-item">
			      <label for="nome" class="label-alinhado">Nome:</label>
			      <input type="text" id="nome" name="nome" size="50" placeholder="Nome completo" value="<?=isset($nome) ? $nome : '';?>">
			      <span class="msg-erro" id="msg-nome"></span>
			    </div>
			    <div class="form-item">
			      <label for="email" class="label-alinhado">E-mail:</label>
			      <input type="email" id="email" name="email" placeholder="fulano@dominio" size="50" value="<?=isset($email) ? $email : '';?>"">
			      <span class="msg-erro" id="msg-email"></span>
			    </div>					    
			    <div class="form-item">
			      <label for="endereco" class="label-alinhado">Endereço:</label>
			      <input type="text" id="endereco" name="endereco" placeholder="Rua, número, complemento" size="50" value="<?=isset($endereco) ? $endereco : '';?>">
			      <span class="msg-erro" id="msg-endereco"></span>
			    </div>	
			    <div class="form-item">
			      <label for="bairro" class="label-alinhado">Bairro:</label>
			      <select name="bairro" id="bairro">
				    <option value="">Selecione o bairro</option>
				    <option <?=(isset($bairro)) ? (($bairro == "Centro") ? "selected":"") : "";?>>Centro</option>
				    <option <?=(isset($bairro)) ? (($bairro == "Efapi") ? "selected":"") : "";?>>Efapi</option>
				    <option <?=(isset($bairro)) ? (($bairro == "Presidente Médici") ? "selected":"") : "";?>>Presidente Médici</option>
				    <option <?=(isset($bairro)) ? (($bairro == "Jardim Itália") ? "selected":"") : "";?>>Jardim Itália</option>
				    <option <?=(isset($bairro)) ? (($bairro == "Maria Goretti") ? "selected":"") : "";?>>Maria Goretti</option>
				  </select>
				  <span class="msg-erro" id="msg-bairro"></span>
			    </div>
			    <div class="form-item">
			      <label class="label-alinhado">Perfil:</label>
			      <label><input type="radio" name="perfil" value="c" id="perfilC" <?= isset($perfil)?($perfil=="c"?'checked':''):'';?> >Consumidor final</label>
			      <label><input type="radio" name="perfil" value="p" id="perfilP" <?= isset($perfil)?($perfil=="p"?'checked':''):'';?>>Prestador de serviço</label>
				  <span class="msg-erro" id="msg-perfil"></span>
			    </div>
			    <div class="form-item">
			      <label for="empresa" class="label-alinhado">Nome da empresa:</label>
			      <input type="text" id="empresa" name="empresa" disabled value="<?=isset($empresa) ? $empresa : '';?>"> <span id="mensagem-empresa"></span>
			      <span class="msg-erro" id="msg-empresa"></span>
			    </div>					    
			    <div class="form-item">
			      <label for="login" class="label-alinhado">Login:</label>
			      <input type="text" id="login" name="login" placeholder="Mínimo 6 caracteres" value="<?=isset($login) ? $login : '';?>">
			      <span class="msg-erro" id="msg-login"></span>
			    </div>				    
			    <div class="form-item">
			      <label for="senha" class="label-alinhado">Senha:</label>
			      <input type="password" id="senha" name="senha" placeholder="Mínimo 6 caracteres">
			      <span class="msg-erro" id="msg-senha"></span>
			    </div>
			    <div class="form-item">
			      <label for="senha2" class="label-alinhado">Repita a Senha:</label>
			      <input type="password" id="senha2" name="senha2" placeholder="Mínimo 6 caracteres">
			      <span class="msg-erro" id="msg-senha2"></span>
			    </div>
			    <div class="form-item">
			      <label class="label-alinhado"></label>
			      <label><input type="checkbox" id="concordo" name="concordo" <?=isset($concordo) ? ($concordo ? 'checked' : '') : '';?>> Li e estou de acordo com os termos de uso do site</label>
			      <span class="msg-erro" id="msg-concordo"></span>
			    </div>				    
			    <div class="form-item">
			    	<label class="label-alinhado"></label>
			    <input type="submit" id="botao" value="Confirmar" name="cadastrar">
			    </div>
			</form>
			<script src="js/cad_cliente.js"></script>
		</div>		
		<?php 
		}else{
			echo "<p>Cliente <strong>cadastrado</strong> com sucesso!</p>";
		}
		?>	
	</section>
<?php
	include "includes/mais_pedidos.php";
?>
</div>
<!-- rodape -->
<?php
	include "includes/rodape.php";
?>
