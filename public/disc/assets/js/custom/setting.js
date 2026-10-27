$( document ).ready(function() {
    $('#cek_kelas').click(function (e) {
        e.preventDefault();
        var code = $("#code").val();
        if(code!='') {
            $.ajax({
                data: {code},
                url: "/pengaturan/kelas",
                type: "GET",
                dataType: 'json',
                success: function (data) {
                    if (data.code == '1') {
                        common.showMessage('Sukses', 'Kelas Ditemukan', 'success');
                        $('#dosen').val(data.data.user.name);
                        $("#kelas_button").removeAttr('disabled');
                    } else {
                        common.showMessage('Gagal', 'Kelas Tidak Ditemukan', 'error');
                        $('#dosen').val('');
                        $("#kelas_button").attr('disabled', '');
                    }
                },
                error: function (data) {
                    console.log('Error:', data);
                },
            });
        }else{
            common.showMessage('Gagal', 'Kelas Tidak Ditemukan', 'error');
            $('#dosen').val('');
            $("#kelas_button").attr('disabled', '');
        }
    });

    $("#kelas_button").attr('disabled', '');
});