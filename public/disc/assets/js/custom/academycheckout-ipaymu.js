$( document ).ready(function() {
    $('#cek_diskon').click(function (e) {
        e.preventDefault();
        var diskon = $("#diskon").val();
        if(diskon!=''){
            $.ajax({
                data: {code: diskon},
                url: "/discount/",
                type: "POST",
                dataType: 'json',
                success: function (data) {
                    if (data.code == '1') {
                        common.showMessage('Sukses', 'Selamat Diskon Berhasil Diklaim', 'success');
                        $("#diskon_id").val(data.data.id);
                        if(data.data.type=='rupiah'){
                            number.setHtml('#diskon_nominal',data.data.amount);
                        }else{
                            var sub = number.getHtml('#sub');
                            var persen = data.data.amount;
                            number.setHtml('#diskon_nominal',sub * persen/100);
                        }
                        getCost();
                    } else {
                        common.showMessage('Gagal', 'Kode Diskon Tidak Ditemukan', 'error');
                    }
                },
                error: function (data) {
                    console.log('Error:', data);
                },
            });
        }else{
            common.showMessage('Gagal', 'Kode Diskon Tidak Ditemukan', 'error');
        }
    });
    if(number.getHtml('#total') > 0){
        $("#checkout_button").attr('disabled', '');
    }
    $('.payment').click(function () {
        $("#checkout_button").attr('disabled', '');
        getCost();
    });

    $('.detail').change(function () {
        $("#name").val($("#mname").val());
        $("#email").val($("#memail").val());
        $("#mobile").val($("#mmobile").val());
        $("#institution").val($("#minstitution").val());
    });

    function getCost(){
        var sub = number.getHtml('#sub');
        var diskon = number.getHtml('#diskon_nominal');
        var amount = sub-diskon;
        var code = $('input[name="payment_method"]:checked').val();
        if(code != null){
            $.ajax({
                data: {code, amount},
                url: "/cost/",
                type: "POST",
                dataType: 'json',
                success: function (data) {
                    if (data.code == '1') {
                        $("#code").val(data.data[0].code);
                        number.setHtml('#biaya_admin',data.data[0].total_fee.customer);
                        total();
                        $("#checkout_button").removeAttr('disabled');
                    }
                },
                error: function (data) {
                    console.log('Error:', data);
                },
            });
        }else{
            total();
        }
    }

    function total(){
        var sub = number.getHtml('#sub');
        var diskon = number.getHtml('#diskon_nominal');
        var biaya = number.getHtml('#biaya_admin');
        var total = sub-diskon+biaya;
        number.setHtml('#total', total);
    }

    submitButton = document.querySelector('#checkout_button');
    form = document.querySelector('#checkout_form');
    $('#checkout_button').click(function (e) {
        e.preventDefault();
        // Show loading indication
        submitButton.setAttribute('data-kt-indicator', 'on');

        // Disable button to avoid multiple click
        submitButton.disabled = true;
        $.ajax({
            data: $('#checkout_form').serialize(),
            url: "/ipaymucheckout/",
            type: "POST",
            dataType: 'json',
            success: function (data) {
                const redirectUrl = '/order/'+data.purchase_id
                const actSuccess = function () {
                    location.href = redirectUrl;
                };

                // Show message popup. For more info check the plugin's official documentation: https://sweetalert2.github.io/
                common.showMessageWithAction('Sukses', 'Anda Berhasil Mendaftar Pada Course Ini', 'success', data.button, actSuccess);
            },
            error: function (data) {
                common.showMessage('Gagal', 'Nama, Email, No HP dan Lembaga Tidak Boleh Kosong', 'error', 'Ok, got it!');
            },
            complete: function () {
                // Hide loading indication
                submitButton.removeAttribute('data-kt-indicator');
                // Enable button
                submitButton.disabled = false;
            }
        });
    });

});