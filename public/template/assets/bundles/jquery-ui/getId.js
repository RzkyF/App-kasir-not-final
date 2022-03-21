$(document).on('click','#btn-pesan', function(){
    $('.modal-body #id_order').val($(this).data('id'));
})

$(document).on('click','#btn-bayar', function(){
    $('.modal-body #id_order').val($(this).data('id'));
    $('.modal-body #total').val($(this).data('total'));
})