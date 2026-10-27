$(document).ready(function () {
    $('.bpe').click(function (e) {
        e.preventDefault();
        $("#divBpe").modal('show');
        var id = $(this).data('id');
        $.ajax({
            data: {id},
            url: "/spt/dashboard/spt_detail",
            type: "POST",
            dataType: 'json',
            success: function (result) {
                var data = result.data;
                $('#mname').text("Nama : " + data.name);
                $('#mnpwp').text("NPWP : " + data.npwp);
                $('#myear').text("Tahun Pajak : " + (data.tahun));
                $('#mperiod').text("Masa Pajak : " + (data.periode));
                $('#mtype').text("Jenis SPT : " + (data.jenis));
                $('#mcorrection').text("Pembetulan ke : " + (data.pembetulanke));
                $('#mstatus').text("Status SPT :" + setStatusSpt(data.status));
                $('#mnominal').text(common.formatNumber(data.nilaipajak));
                $('#mntte').text("Nomor Tanda Terima Elektronik : " + data.ntte);
                $('#mdate').text(" Tanggal Penyampaian : " + data.tgl);
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });

    function setStatusSpt(value) {
        switch (value) {
            case "0":
                return "Nihil";
                break;
            case "1":
                return "Kurang Bayar";
                break;
            case "2":
                return "Lebih Bayar";
                break;
            default:
                return "Lainnya";
                break;
        }
    }

    $('.submit').click(function (e) {
        $("#submit").modal('show');
        var id = $(this).data('id');
        var code = $(this).data('code');
        $('#spt').val(id);
        $.ajax({
            url: '/ruang/kelas/' + code + '/question',
            method: 'POST',
            success: function (response) {
                $('#question_id').empty();
                $('#question_id').append('<option value="">Pilih Penugasan</option>');
                $.each(response, function (id, type) {
                    $('#question_id').append(new Option(type, id))
                });
            }
        });
    });

    $("#tbl_spt").DataTable();
});