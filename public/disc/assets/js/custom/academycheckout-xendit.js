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
                        total();
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

    $("#checkout_button").attr('disabled', '');
    $('.payment').click(function () {
        var sub = number.getHtml('#sub');
        var diskon = number.getHtml('#diskon_nominal');
        var amount = sub-diskon;
        var payment_method = $('input[name="payment_method"]:checked').val();
        $("#checkout_button").removeAttr('disabled');
        if(payment_method=='QRIS'){
            number.setHtml('#biaya_admin', (0.7*amount/100)+750);
        }else{
            number.setHtml('#biaya_admin', 5000);
        }
        $("#code").val(payment_method);
        total();
    });

    $('.detail').change(function () {
        $("#name").val($("#mname").val());
        $("#email").val($("#memail").val());
        $("#mobile").val($("#mmobile").val());
        $("#institution").val($("#minstitution").val());
        $("#file").val($("#mfile").val());
    });

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
        // Create FormData object from the form
        var formData = new FormData(form);
        $.ajax({
            url: "/checkout/",
            type: "POST",
            data: formData,
            processData: false,  // Don't process the data
            contentType: false,  // Don't set content type
            dataType: 'json',
            success: function (data) {
                if(data.success){
                    const redirectUrl = data.url
                    const actSuccess = function () {
                        location.href = redirectUrl;
                    };

                    // Show message popup. For more info check the plugin's official documentation: https://sweetalert2.github.io/
                    common.showMessageWithAction('Sukses', 'Anda Berhasil Mendaftar Pada Course Ini', 'success', data.button, actSuccess);
                }else{
                    common.showMessage('Gagal', data.message, 'error', 'Ok, got it!');
                }
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