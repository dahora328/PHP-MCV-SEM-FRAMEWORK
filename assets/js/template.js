$(function(){

	$('.btn-sair').on('click', function(){
		var id = $(this).attr('data-id');
		$('#modal-confirm').attr('data-id', id);
		$('#modal-confirm').attr('data-origem', 'sair');

		$('.modal-title').html('Sair');
		$('#modal-conteudo').html('Deseja realmente sair? ['+id+']');
		$('#modal-confirm').modal('show');

	})
	$('.btn-deletar').on('click', function(){
		var id = $(this).attr('data-id');
		$('#modal-confirm').attr('data-id', id);
		$('#modal-confirm').attr('data-origem', 'deletar');

		$('.modal-title').html('Sair');
		$('#modal-conteudo').html('Deseja realmente excluir sua conta?  ['+id+']');
		$('#modal-confirm').modal('show');

	})

	$('#btn-modal-sim').on('click', function(){

		var origem = $('#modal-confirm').attr('data-origem');
		
		if (origem == 'deletar'){
 			window.location.href = getBaseUrl()+'/CadastroUsuario/DeleteUsuario/'+$('#modal-confirm').attr('data-id');
		}else if(origem == 'sair'){
			window.location.href = getBaseUrl()+'/Login/LogOut';
		}
	})
})