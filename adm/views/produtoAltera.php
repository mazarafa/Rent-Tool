<h2>Alteração de Produtos</h2>
<form action="" method="post" id="form-cadastro" enctype="multipart/form-data">
	<div>
		<fieldset>
			<legend><strong>Dados do Produto</strong></legend>
			<div class="form-item">
				<label for="nome" class="rotulo">Nome:</label>
				<input type="text" id="nome" name="nome" size="50" required autofocus value="<?=$prod[0]['nomeProduto']?>">	
			</div>
			<div class="form-item">
				<label for="fabricante" class="rotulo">Fabricante:</label>
				<select name="idFabricante" id="fabricante">
					<option value="0">Não informado</option>
					<?php
					$fabr = new Fabricante();
					$lista = $fabr->listarTodos();
					foreach($lista as $f)
						if($prod[0]['idFabricante'] == $f['id'])
							echo "<option value = \"{$f['id']}\" selected>{$f['nome']}</option>";			
						else
							echo "<option value = \"{$f['id']}\">{$f['nome']}</option>";										
					?>						
				</select>
			</div>
			<div class="form-item">
				<label for="arquivo" class="rotulo">Selecione uma imagem (<em>deixe em branco para manter a imagem atual</em>):</label>
				<input type="file" name="arquivo" id="arquivo">
				<input type="hidden" name="imagemAtual" value="<?=$prod[0]['imagem'];?>">
			</div>
			<div class="form-item">
				<label for="desc" class="rotulo">Descrição:</label>
				<textarea name="descricao" rows="5" cols="30" id="desc"><?=$prod[0]['descricao']?></textarea>
			</div>
			<div class="form-item">
				<label class="rotulo">Tensão: </label>
				<label><input type="radio" name="tensao" value="110" id="volt110" <?=($prod[0]['tensao']==110)? "checked":"";?>>110v</label>
				<label><input type="radio" name="tensao" value="220" id="volt220" <?=($prod[0]['tensao']==220)? "checked":"";?>>220v</label>
				<label><input type="radio" name="tensao" value="0" id="voltNone"  <?=($prod[0]['tensao']==0)? "checked":"";?>>Não se aplica</label>
			</div>
			<div class="form-item">
				<label class="rotulo">Categorias:</label>
				<label><input type="checkbox" id="marcenaria" name="marcenaria" <?=($prod[0]['catMarcenaria']==1)? "checked":"";?>>Marcenaria</label>
				<label><input type="checkbox" id="jardinagem" name="jardinagem" <?=($prod[0]['catJardinagem']==1)? "checked":"";?>>Jardinagem</label>
				<label><input type="checkbox" id="limpeza" name="limpeza"  <?=($prod[0]['catLimpeza']==1)? "checked":"";?>>Limpeza</label>
				<label><input type="checkbox" id="escritorio" name="escritorio"  <?=($prod[0]['catEscritorio']==1)? "checked":"";?>>Escritório</label>
				<label><input type="checkbox" id="mecanica" name="mecanica"  <?=($prod[0]['catMecanica']==1)? "checked":"";?>>Mecânica</label>
				<label><input type="checkbox" id="outros" name="outros"  <?=($prod[0]['catOutros']==1)? "checked":"";?>>Outros</label>
			</div>						
		</fieldset>
		<fieldset>
			<legend><strong>Dados da locação</strong></legend>
			<div class="form-item">
				<label for="quantidade" class="rotulo">Quantidade Disponível:</label>
				<input type="number" id="quantidade" name="quantidade"  value="<?=$prod[0]['qtde']?>" min="1">
			</div>
			<div class="form-item">
				<label for="valor" class="rotulo">Valor da locação:</label>
				<input type="text" id="valor" name="valor" placeholder="0.00" value="<?=$prod[0]['valor']?>" required onblur="document.getElementById('total').innerHTML = (this.value - document.getElementById('desconto').value).toFixed(2)">
			</div>
			<div class="form-item">
				<label for="desconto" class="rotulo">Desconto promocional:</label>
				<input type="text" id="desconto" name="desconto" value="<?=$prod[0]['desconto']?>" required onblur="document.getElementById('total').innerHTML = (document.getElementById('valor').value - this.value).toFixed(2)">
			</div>
			<div class="form-item">						
				<label class="rotulo">Total (R$):</label>
				<span id="total"><strong><?=formataPreco($prod[0]['valor'] - $prod[0]['desconto']);?></strong></span>
			</div>
			<div class="form-item">
				<label class="rotulo"></label>
				<input type="submit" id="botao" value="Alterar" name="alterar">
				<input type="reset" value="Limpar">
				<input type="hidden" name="idProduto" value="<?=$prod[0]['idProduto'];?>">
			</div>						
		</fieldset>
	</div>
</form>