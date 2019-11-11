document.getElementById("fechar").onclick = function() {
    document.getElementById("ajuda").style.display = 'none';
};

document.getElementById("exibeMenu").onclick = function() {
    var menu = document.getElementsByClassName("menu-opcoes")[0];
    if (menu.style.display == 'block')
        menu.style.display = 'none';
    else
        menu.style.display = 'block';
};

document.body.onresize = function() {
    var w = window.outerWidth;
    var menu = document.getElementsByClassName("menu-opcoes")[0];
    if (w >= 1000) {
        menu.style.display = 'block';
    } else {
        menu.style.display = 'none';
    }
};

function taxaEntrega(taxa) {
    if (taxa == 0) {
        total = parseFloat(document.getElementById("totalProdutos").value);
        document.getElementById("taxaExibida").innerHTML = formataPreco(taxa);
        document.getElementById("totalExibido").innerHTML = formataPreco(total);
    } else {
        total = parseFloat(document.getElementById("totalProdutos").value) + parseFloat(taxa);
        document.getElementById("taxaExibida").innerHTML = formataPreco(taxa);
        document.getElementById("totalExibido").innerHTML = formataPreco(total);
    }
}

function formataPreco(valor) {
    valor = parseFloat(valor);
    return valor.toLocaleString('pt-br', { style: 'currency', currency: 'BRL' });
}

function compraRapida(idProduto, nomeProduto, quantidade, valorFinal) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById(idProduto).classList.add("noCarrinho"); // adiciona classe noCarrinho, tornando o botão verde
            document.getElementById(idProduto).innerHTML = "no carrinho!"; // muda o texto de "compra rápida" para "no carrinho"
            document.getElementById("numItensCarrinho").innerHTML = "(" + this.responseText + ")"; // responseText trará a saída do script PHP
        }
    };
    xhttp.open("GET", "ajax/compraRapida.php?id=" + idProduto + "&nome=" + nomeProduto + "&quantidade=" + quantidade + "&valorFinal=" + valorFinal, true);
    xhttp.send();
}

function atualizaQuantidade(idProduto, quantidade, valorFinal) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("preco" + idProduto).innerHTML = formataPreco(parseInt(quantidade) * parseFloat(valorFinal)); // atualiza valor do item
            document.getElementById("precoTotal").innerHTML = formataPreco(this.responseText); // atualiza o total com o retorno do PHP
        }
    };
    xhttp.open("GET", "ajax/atualizaQuantidade.php?id=" + idProduto + "&quantidade=" + quantidade, true);
    xhttp.send();
}