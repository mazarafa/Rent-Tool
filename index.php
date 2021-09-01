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
			if(isset($_GET['secao'])){
				$categoriaSelecionada = $_GET['secao'];
				$titulo = $CATEGORIAS[$categoriaSelecionada];
			}
			elseif(isset($_GET['busca'])){
				$titulo = "Resultado da busca por \"{$_GET['busca']}\" ";
			}
			else{
				$titulo = "Novidades";
			}
			?>
			<h2><?=$titulo;?></h2>

			<!-- container de produtos -->
			<div class="lista-produtos">
				<!-- um produto -->
				<?php
				include "includes/conexao.php";
				include "includes/functions.php";
				$sql = "select id, nome, imagem, valor, desconto from produto";
				if(isset($categoriaSelecionada))
					$sql.= " where $categoriaSelecionada IS TRUE";
				elseif(isset($_GET['busca']))
					$sql.=" where nome like '%{$_GET['busca']}%'";
				else
					$sql.= " order by id desc limit 10"; // novidades

				//echo $sql;

				$resultado = mysqli_query($conexao, $sql);
				if(mysqli_num_rows($resultado) == 0){
					echo "<p>Nenhum produto encontrado</p>";
				}
				else{
					while ($produto = mysqli_fetch_array($resultado)){

					?>
                     <div class="produto">                      
                        <figure>
                            <a href="produto.php?id=<?=$produto['id'];?>">
                            <img src="img/produtos/<?=mostraImagem($produto['imagem']);?>" alt="<?=$produto['nome'];?>">
                            <figcaption><?=$produto['nome'];?>
                                <span class="preco"> <?=mostraPreco($produto['valor'], $produto['desconto']);?>  </span>
                            </figcaption>
                            </a>
                            <?php 
                            if(@array_key_exists($produto['id'], $_SESSION['carrinho'])){    ?>
                                <div class="noCarrinho" id="<?=$produto['id'];?>">no carrinho!</div>
                            <?php 
                            } else { ?>
                                <div class="rapida" id="<?=$produto['id'];?>" onclick="compraRapida(<?=$produto['id'];?>, '<?=$produto['nome'];?>', 1, <?=($produto['valor'] - $produto['desconto']);?>)">compra rápida</div>
                            <?php 
                            }    ?>
                        </figure>                    
                    </div>
				    <?php						
					}
				}
				?>
			</div>			
		</section>
	<?php
	include "includes/mais_pedidos.php";
	?>
	</div>
	<!-- fim area central -->
<?php
include "includes/rodape.php";
?>
