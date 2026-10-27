$( document ).ready(function() {
    $("#tbl_referensi").DataTable();
});

$('.edit').on('click', function(){
    var id = $(this).attr('data-id');
    $.get('/faktur/referensi/lawan_transaksi/' + id + '/edit', function (result) {
        $('#mname').val(result.name);
        $('#mphone').val(result.phone);
        $('#maddress').text(result.address);
        if(result.npwp != null){
            $('#mnpwp').val(result.npwp);
            $("#mnik").prop('disabled', true);
            $("#mnik").val('');
        }else{
            $('#mnot').prop('checked', true);
            $("#mnik").prop('disabled', false);
            $('#mnik').val(result.nik);
            $("#mnpwp").prop('disabled', true);
            $("#mnpwp").val('');
        }
        $("#myForm").attr("action", "/faktur/referensi/lawan_transaksi/"+id);
    });
});

$(".npwp").inputmask({
    mask: "9999999999999999",
    removeMaskOnSubmit: true
});

$(".nik").inputmask({
    mask: "9999999999999999",
    removeMaskOnSubmit: true
});

$("#not").change(function() {
    if(this.checked) {
        $("#npwp").prop('disabled', true);
        $("#npwp").val('');
        $("#nik").prop('disabled', false);
    }else{
        $("#nik").prop('disabled', true);
        $("#nik").val('');
        $("#npwp").prop('disabled', false);
    }
});

$("#mnot").change(function() {
    if(this.checked) {
        $("#mnpwp").prop('disabled', true);
        $("#mnpwp").val('');
        $("#mnik").prop('disabled', false);
    }else{
        $("#mnik").prop('disabled', true);
        $("#mnik").val('');
        $("#mnpwp").prop('disabled', false);
    }
});