$( document ).ready(function() {

    $('#ttd_date').flatpickr();
    $(".uang").autoNumeric('init', {aSep: '.', aDec: ',', mDec: '0', vMin: '0'});
    itemButton = document.querySelector('#itemBtn');
    indukButton = document.querySelector('#indukBtn');
    ntpn();

    $('#itemBtn').click(function (e) {
        e.preventDefault();
        if($("#itemForm").valid()){
            itemButton.setAttribute('data-kt-indicator', 'on');
            itemButton.disabled = true;
            $.ajax({
                data: $('#itemForm').serialize(),
                url: "/faktur/spt/"+spt_id,
                type: "PUT",
                dataType: 'json',
                success: function (data) {
                    if(data.ab=='ya' && data.induk=='ya'){
                        $('#submit').removeAttr('hidden');
                    }
                    common.showMessage('Sukses', data.success, 'success');
                    induk();
                    ntpn();

                },
                error: function (data) {
                    console.log('Error:', data);
                },
                complete: function () {
                    itemButton.removeAttribute('data-kt-indicator');
                    itemButton.disabled = false;
                }
            });
        }
    });

    $('#indukBtn').click(function (e) {
        e.preventDefault();
        if($("#indukForm").valid()){
            indukButton.setAttribute('data-kt-indicator', 'on');
            indukButton.disabled = true;
            $.ajax({
                data: $('#indukForm').serialize(),
                url: "/faktur/spt/"+spt_id,
                type: "PUT",
                dataType: 'json',
                success: function (data) {
                    if(data.ab=='ya' && data.induk=='ya'){
                        $('#submit').removeAttr('hidden');
                    }
                    common.showMessage('Sukses', data.success, 'success');
                },
                error: function (data) {
                    console.log('Error:', data);
                },
                complete: function () {
                    indukButton.removeAttribute('data-kt-indicator');
                    indukButton.disabled = false;
                }
            });
        }
    });

    var dpp_a21_init = number.getVal('#dpp_a21_init');
    var ppn_a21_init = number.getVal('#ppn_a21_init');
    var ppnbm_a21_init = number.getVal('#ppnbm_a21_init');

    $('.hitung_a2').change(function() {
        var dpp_a2_covered = number.getVal('#dpp_a2_covered');
        var ppn_a2_covered = number.getVal('#ppn_a2_covered');
        var ppnbm_a2_covered = number.getVal('#ppnbm_a2_covered');
        number.setHtml('#dpp_a21', dpp_a2_covered+dpp_a21_init);
        number.setHtml('#ppn_a21', ppn_a2_covered+ppn_a21_init);
        number.setHtml('#ppnbm_a21', ppnbm_a2_covered+ppnbm_a21_init);
    });

    $('#ppn_input').change(function(){
            var ppn_3a = number.getHtml('#ppn_3a');
            var ppn_input = number.getVal('#ppn_input');
            var ppn_correction = number.getVal('#ppn_correction');

            number.setHtml('#ppn_3b', ppn_correction+ppn_input);
            number.setHtml('#ppn_3c', ppn_3a+ppn_correction+ppn_input);
        })

    $('#ppn_correction').change(function(){
        var ppn_3a = number.getHtml('#ppn_3a');
        var ppn_input = number.getVal('#ppn_input');
        var ppn_correction = number.getVal('#ppn_correction');

        number.setHtml('#ppn_3b', ppn_correction+ppn_input);
        number.setHtml('#ppn_3c', ppn_3a+ppn_correction+ppn_input);
    })

    $('#dpp_not').change(function(){
        var dpp_jumlah = number.getHtml('#dpp_jumlah');
        var dpp_not = number.getVal('#dpp_not');
        number.setHtml('#dpp_all', dpp_jumlah+dpp_not);
    })

    function induk(){
        var dpp_a2_covered = number.getVal('#dpp_a2_covered');
        var ppn_a2_covered = number.getVal('#ppn_a2_covered');
        number.setHtml('#dpp_a21_induk', dpp_a2_covered+dpp_a21_init);
        number.setHtml('#ppn_a21_induk', ppn_a2_covered+ppn_a21_init);
        number.setHtml('#ppn_a21_induk2', ppn_a2_covered+ppn_a21_init);
        var dpp_a21_induk = number.getHtml('#dpp_a21_induk'); 
        var ppn_a21_induk = number.getHtml('#ppn_a21_induk');
        var dpp_a22_induk = number.getHtml('#dpp_a22_induk'); 
        var ppn_a22_induk = number.getHtml('#ppn_a22_induk');
        var dpp_a23_induk = number.getHtml('#dpp_a23_induk'); 
        var ppn_a23_induk = number.getHtml('#ppn_a23_induk');
        var dpp_a24_induk = number.getHtml('#dpp_a24_induk'); 
        var ppn_a24_induk = number.getHtml('#ppn_a24_induk');
        number.setHtml('#dpp_jumlah', dpp_a21_induk+dpp_a22_induk+dpp_a23_induk+dpp_a24_induk);
        number.setHtml('#ppn_jumlah', ppn_a21_induk+ppn_a22_induk+ppn_a23_induk+ppn_a24_induk);
        var dpp_jumlah = number.getHtml('#dpp_jumlah');
        var dpp_not = number.getVal('#dpp_not');
        number.setHtml('#dpp_all', dpp_jumlah+dpp_not);
        var ppn_3c = number.getHtml('#ppn_3c');
        number.setHtml('#ppn_calculated', ppn_3c);
        number.setHtml('#ppn_kurang', ppn_a21_induk-ppn_3c);
    }

    $('#check_ppn').click(function (e) {
        var ntpn = $("#ntpn_ppn").val();
        if(ntpn != ''){
            common.loadingMessage("Memproses", "Mohon sabar menunggu");
            setTimeout(function () {
                searchBpe(ntpn, 'ppn');
            }, 1000);
        }else{
            common.showNotif('NTPN tidak boleh kosong', 'error');
        }
    });

    $('#check_own').click(function (e) {
        var ntpn = $("#ntpn_own").val();
        if(ntpn != ''){
            common.loadingMessage("Memproses", "Mohon sabar menunggu");
            setTimeout(function () {
                searchBpe(ntpn, 'own');
            }, 1000);
        }else{
            common.showNotif('NTPN tidak boleh kosong', 'error');
        }
    });

    $('#check_fail').click(function (e) {
        var ntpn = $("#ntpn_fail").val();
        if(ntpn != ''){
            common.loadingMessage("Memproses", "Mohon sabar menunggu");
            setTimeout(function () {
                searchBpe(ntpn, 'fail');
            }, 1000);
        }else{
            common.showNotif('NTPN tidak boleh kosong', 'error');
        }
    });

    $('#check_ppnbm').click(function (e) {
        var ntpn = $("#ntpn_ppnbm").val();
        if(ntpn != ''){
            common.loadingMessage("Memproses", "Mohon sabar menunggu");
            setTimeout(function () {
                searchBpe(ntpn, 'ppnbm');
            }, 1000);
        }else{
            common.showNotif('NTPN tidak boleh kosong', 'error');
        }
    });

    function searchBpe(ntpn, column) {
        var paramAjakBpe = {
            ntpn: ntpn,
            thnPajak: spt_year
        };

        var doneAjaxBpe = function (data) {
            if (data.code == 1) {
                common.showMessage("", "Data ditemukan.", "info", "Oke");
                $('#nominal_'+column).val(data.data.jmlSetor);
                $('#date_'+column).val(data.data.tglSetor);
            } else if (data.code == 9) {
                var actErrorMessage = function () {
                    location.reload();
                };
                common.showMessageWithAction("Kesalahan", data.error_msg, "error", "Tutup", actErrorMessage);
            } else {
                common.showMessage("Kesalahan", data.error_msg, "error", "Tutup");
            }
        };

        common.ajaxJsonPost(function () {
        }, paramAjakBpe, "/api/common/check_ntpn", doneAjaxBpe);
    }

    function ntpn() {
        var ppn_kurang = number.getHtml('#ppn_kurang');
        var ppn_own = number.getVal('#ppn_own');
        var ppn_fail = number.getVal('#ppn_fail');
        var ppnbm_kurang = number.getHtml('#ppnbm_kurang');
//        if(ppn_kurang>0){
//            $("#panel_ntpn_ppn").show();
//            $("#ntpn_ppn").attr('required', '');
//            $("#date_ppn").attr('required', '');
//            $("#nominal_ppn").attr('required', '');
//        }else{
            $("#panel_ntpn_ppn").hide();
            $("#ntpn_ppn").removeAttr('required');
            $("#date_ppn").removeAttr('required');
            $("#nominal_ppn").removeAttr('required');
//        }
//        if(ppn_kurang<0){
//            $(".lebih_bayar").removeAttr('disabled');
//            $(".lebih_bayar").attr('required', '');
//        }else{
//            $(".lebih_bayar").removeAttr('required');
//            $(".lebih_bayar").attr('disabled', '');
//        }

//        if(ppnbm_kurang>0){
//            $("#panel_ntpn_ppnbm").show();
//            $("#ntpn_ppnbm").attr('required', '');
//            $("#date_ppnbm").attr('required', '');
//            $("#nominal_ppnbm").attr('required', '');
//        }else{
            $("#panel_ntpn_ppnbm").hide();
            $("#ntpn_ppnbm").removeAttr('required');
            $("#date_ppnbm").removeAttr('required');
            $("#nominal_ppnbm").removeAttr('required');
//        }
//        if(ppn_own>0){
//            $("#panel_ntpn_own").show();
//            $("#ntpn_own").attr('required', '');
//            $("#date_own").attr('required', '');
//            $("#nominal_own").attr('required', '');
//        }else{
            $("#panel_ntpn_own").hide();
            $("#ntpn_own").removeAttr('required');
            $("#date_own").removeAttr('required');
            $("#nominal_own").removeAttr('required');
//        }
//        if(ppn_fail>0){
//            $("#panel_ntpn_fail").show();
//            $("#ntpn_fail").attr('required', '');
//            $("#date_fail").attr('required', '');
//            $("#nominal_fail").attr('required', '');
//        }else{
            $("#panel_ntpn_fail").hide();
            $("#ntpn_fail").removeAttr('required');
            $("#date_fail").removeAttr('required');
            $("#nominal_fail").removeAttr('required');
//        }
    }

    $('.ntpn').change(function() {
        ntpn();
    });
    
});