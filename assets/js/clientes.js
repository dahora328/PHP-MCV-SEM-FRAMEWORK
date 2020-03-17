$(function(){

	$('.bt-delete-cliente').on('click', function(){
		var id = $(this).attr('data-id');
		$('#modal-confirm').attr('data-id', id);
		$('#modal-confirm').attr('data-origem', 'excluir');

		$('.modal-title').html('Exclusão do Registro');
		$('#modal-conteudo').html('Deseja excluir ['+id+']?');
		$('#modal-confirm').modal('show');

	})

	$('.btn-sair').on('click', function(){
		var id = $(this).attr('data-id');
		$('#modal-confirm').attr('data-id', id);
		$('#modal-confirm').attr('data-origem', 'sair');

		$('.modal-title').html('Sair');
		$('#modal-conteudo').html('Deseja realmente sair ['+id+']?');
		$('#modal-confirm').modal('show');

	})

	$('#btn-modal-sim').on('click', function(){

		var origem = $('#modal-confirm').attr('data-origem');

		if (origem == 'excluir'){
 			window.location.href = getBaseUrl()+'/cliente/DeleteCliente/'+$('#modal-confirm').attr('data-id');
		}else if(origem == 'sair'){
			window.location.href = getBaseUrl()+'/Login/LogOut';
		}
		
	})
})