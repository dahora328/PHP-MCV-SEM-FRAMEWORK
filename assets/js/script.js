
$(document).ready(function(){
  $('#nome_cliente').focus();
	$('#cod_produto').on('blur', function(){

		var idProduto = $(this).val();
		getDadosProduto(idProduto, function(json){
			$('#nome_produto').val(json.produtos.nome_produto);
      $('#valor_produto').val( parseFloat(json.produtos.valor_produto).toFixed(2));
      $('#estoque').val(json.produtos.estoque);
      $('#resultado').val(json.produtos.resultado);
    	$('#quantidade').focus();
		});
	})
});

function somenteNumeros(num) {
  var er = /[^0-9.]/;
  er.lastIndex = 0;
  var campo = num;
    if (er.test(campo.value)) {
    campo.value = "";
  } 
}

var qnt = document.querySelector("input[name=quantidade]");
var precoU = document.querySelector("input[name=valor_produto]");
qnt.addEventListener("keyup", totalItem, false);
precoU.addEventListener("keyup", totalItem, false);

function totalItem(){
   var qnt = parseInt(document.getElementById('quantidade').value);
   var precoU = parseFloat(document.getElementById('valor_produto').value); 
   total = (qnt * precoU).toFixed(2); // "2" significa 2 casas decimais
   if(!isNaN(total)){
      document.querySelector("input[name=total_item]").value = total;  
   }
}
var qnt = document.querySelector("input[name=quantidade]");
var entrada = document.querySelector("input[name=estoque]");
qnt.addEventListener("keyup", EstoqueAtual, false);
entrada.addEventListener("keyup", EstoqueAtual, false);

function EstoqueAtual(){
   var qnt = parseInt(document.getElementById('quantidade').value);
   var entrada = parseInt(document.getElementById('estoque').value); 
   total = (entrada - qnt); // "2" significa 2 casas decimais
   if(!isNaN(total)){
      document.querySelector("input[name=resultado]").value = total;  
   }
}

function getDadosProduto(idProduto, callback){
  $.ajax({
      url: getBaseUrl()+'/produto/ConsultaProduto',
      type: 'post',
      dataType: 'json',
      data: {idProduto: idProduto},
      success: function(json){      		
        	callback(json);
      },
      error: function(erro){
          
      }
  })
}

function getBaseUrl(){
	return BASE_URL;
}