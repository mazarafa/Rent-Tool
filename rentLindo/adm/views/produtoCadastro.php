<h2>Cadastro de Produtos</h2>
<form action="" method="post" id="form-cadastro" enctype="multipart/form-data">
	<div>
		<fieldset>
			<legend><strong>Dados do Produto</strong></legend>
			<div class="form-item">
				<label for="nome" class="rotulo">Nome:</label>
				<input type="text" id="nome" name="nome" size="50" required autofocus>								
			</div>

			<div class="form-item">
				<label for="fabricante" class="rotulo">Fabricante:</label>
				<select name="idFabricante" id="fabricante">
					<option value="0">Não informado</option>
					<?php
					$fabr = new Fabricante();
					$lista = $fabr->listarTodos();
					foreach($lista as $f)
						echo "<option value = \"{$f['id']}\">{$f['nome']}</option>";										
					?>						
				</select>
			</div>
			<div class="form-item">
				<label for="arquivo" class="rotulo">Selecione uma imagem:</label>
				<input type="file" name="arquivo" id="arquivo">
			</div>
			<div class="form-item">
				<label for="desc" class="rotulo">Descrição:</label>
				<textarea name="descricao" rows="5" cols="30" id="desc"></textarea>
			</div>
			<div class="form-item">
				<label class="rotulo">Tensão: </label>
				<label><input type="radio" name="tensao" value="110" id="volt110">110v</label>
				<label><input type="radio" name="tensao" value="220" id="volt220">220v</label>							
				<label><input type="radio" name="tensao" value="0" id="voltNone" checked>Não se aplica</label>
			</div>
			<div class="form-item">
				<label class="rotulo">Categorias:</label>
				<label><input type="checkbox" id="marcenaria" name="marcenaria">Marcenaria</label>
				<label><input type="checkbox" id="jardinagem" name="jardinagem">Jardinagem</label>
				<label><input type="checkbox" id="limpeza" name="limpeza">Limpeza</label>
				<label><input type="checkbox" id="escritorio" name="escritorio">Escritório</label>
				<label><input type="checkbox" id="mecanica" name="mecanica">Mecânica</label>
				<label><input type="checkbox" id="outros" name="outros">Outros</label>
			</div>						
		</fieldset>
		<fieldset>
			<legend><strong>Dados da locação</strong></legend>
			<div class="form-item">
				<label for="quantidade" class="rotulo">Quantidade Disponível:</label>
				<input type="number" id="quantidade" name="quantidade" value="1" min="1">
			</div>
			<div class="form-item">
				<label for="valor" class="rotulo">Valor da locação:</label>
				<input type="text" id="valor" name="valor" placeholder="0.00" required onblur="document.getElementById('total').innerHTML = (this.value - document.getElementById('desconto').value).toFixed(2)">
			</div>
			<div class="form-item">
				<label for="desconto" class="rotulo">Desconto promocional:</label>
				<input type="text" id="desconto" name="desconto" value="0.00" required onblur="document.getElementById('total').innerHTML = (document.getElementById('valor').value - this.value).toFixed(2)">
			</div>
			<div class="form-item">						
				<label class="rotulo">Total (R$):</label>
				<span id="total"><strong>0.00</strong></span>
			</div>
			<div class="form-item">
				<label class="rotulo"></label>
				<input type="submit" id="botao" value="Cadastrar" name="cadastrar">
				<input type="reset" value="Limpar">
			</div>						
		</fieldset>
	</div>
</form>