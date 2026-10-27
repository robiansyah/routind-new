$( document ).ready(function() {
    $('#cek_diskon').click(function (e) {
        e.preventDefault();
        var diskon = $("#diskon").val();
        if(diskon!=''){
            $.ajax({
                data: {code: diskon},
                url: "/paket/discount/",
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
                            var persen = ($('#paket').val()=='premium') ? data.data.amount : data.data.amount/2;
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
            url: "/paket/checkout/",
            type: "POST",
            dataType: 'json',
            success: function (data) {
                if(data.success){
                    const redirectUrl = data.url;
                    const actSuccess = function () {
                        location.href = redirectUrl;
                    };
                    // Show message popup. For more info check the plugin's official documentation: https://sweetalert2.github.io/
                    common.showMessageWithAction('Sukses', 'Paket Berhasil Ditambahkan', 'success', 'Lakukan Pembayaran!', actSuccess);
                }else{
                    common.showMessage('Gagal', data.message, 'error', 'Ok, got it!');
                }
            },
            error: function (data) {
                console.log('Error:', data);
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