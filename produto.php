<?php
include "includes/cabecalho.php";
?>
	<!-- area central com 3 colunas -->
	<div class="container">
		
		<?php
			include "includes/menu_lateral.php";
		?>
		<section class="col-2">	
		<?php
				include "includes/conexao.php";
				include "includes/functions.php";
				
				if(!is_numeric($_GET['id'])){
					echo "<h2>Identificador de produto inválido</h2>";
				}
				else {
					$id = $_GET['id'];								
					$sql = "select fabricante.nome as fabricante, produto.nome as nome, produto.id as id, imagem, valor, desconto, tensao, descricao, catMarcenaria, catJardinagem, catLimpeza, catEscritorio, catMecanica, catOutros from produto left join fabricante on fabricante.id = produto.idFabricante where produto.id = $id";				
					$resultado = mysqli_query($conexao, $sql);
					$produto = mysqli_fetch_array($resultado);									
					if(mysqli_num_rows($resultado) == 0){
						echo "<h2>Produto não encontrado</h2>";
					}
					else {				
					?>
			<div class="detalhes-produto">
				<h2><?=$produto['nome'];?></h2>
				<figure>
				<img src="img/produtos/<?=mostraImagem($produto['imagem']);?>" alt="<?=$produto['nome'];?>">
				</figure>
				<div class="form">					
					<p>
						<span class="preco">
						<?=mostraPreco($produto['valor'],$produto['desconto']);?>	
						</span>
					</p>	
				
					<form action="adiciona.php" method="post" id="add-carrinho">
						<label for="quantidade">Quantidade:</label>
						<input type="number" name="quantidade" value="1" min="1">
						<input type="hidden" name="id" value="<?=$produto['id']?>">
						<input type="hidden" name="nome" value="<?=$produto['nome']?>">
						<input type="hidden" name="valorFinal" value="<?=($produto['valor'] - $produto['desconto'])?>">
						<br><br>
						<input type="submit" value="Adicionar ao Carrinho" name="adicionar">
						<br><br>
					</form>
					</div>
					<div class="detalhes">
					<h4>Detalhes do produto</h4>				
						<p class= "fab">Fabricante: <?=($produto['fabricante']==NULL)? "Não informado" : $produto['fabricante'];?></p>
						<p class= "tensao">Tensão: <?=($produto['tensao']==0)? "Não se aplica" : $produto['tensao']?></p>					
						<p class= "desc">Descricao: <?=nl2br($produto['descricao'])?></p>				
					
					<p class="detalhes">Categorias: <span class="cat-names">&nbsp;
					<?php
						$categorias = array();
						if($produto['catMarcenaria']==1){
							array_push($categorias, "Marcenaria");							
						}
						if($produto['catJardinagem']==1){
							array_push($categorias, "Jardinagem");							
						}
						if($produto['catLimpeza']==1){
							array_push($categorias, "Limpeza");							
						}
						if($produto['catEscritorio']==1){
							array_push($categorias, "Escritorio");							
						}
						if($produto['catMecanica']==1){
							array_push($categorias, "Mecanica");							
						}						
						if($produto['catOutros']==1){
							array_push($categorias, "Outros");							
						}
																		
						foreach ($categorias as $lista){
							echo "$lista&nbsp;&nbsp;  ";
						}						
										
					?>
					</span></p>
				</div>	
				</div>			
									
			<?php						
				} // else num_rows == 0
			} // is_numeric				
			?>							
		</section>
	
	<?php
	include "includes/mais_pedidos.php";
	?>	
	<!-- fim area central -->
<?php
include "includes/rodape.php";
?>	
