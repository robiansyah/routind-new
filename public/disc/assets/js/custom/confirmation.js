const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
      confirmButton: 'btn btn-primary',
      cancelButton: 'btn btn-danger'
    },
    buttonsStyling: false
});

function confirmation(e, pesan, type='url', form='myForm') {
    e.preventDefault();
    var url = e.currentTarget.getAttribute('href')   
    swalWithBootstrapButtons.fire({
        title: "Perhatian...",
        text: pesan,
        icon: "warning",
        confirmButtonText: "<i class='fa fa-thumbs-up'></i> Ya",
        buttonsStyling: false,
        showCancelButton: true,
        cancelButtonText: "<i class='fa fa-ban'></i> Tidak",
        reverseButtons: true,
        allowOutsideClick: false,
        
    }).then(function (result) {
        if (result.value) {
            if(type=='url'){
                window.location.href=url;
            }else{
                $('#'+type).modal('show');
                $.get('/reload-captcha', function (data) {
                    $(".captcha span").html(data.captcha);
                });
                $("."+type).val('');
                $("#"+form).attr("action", url);
            }
        }
    });          
};

function confirmation2(e, pesan, type='url', form='myForm2') {
    e.preventDefault();
    var url = e.currentTarget.getAttribute('href')
    swalWithBootstrapButtons.fire({
        title: "Perhatian...",
        text: pesan,
        icon: "warning",
        confirmButtonText: "<i class='fa fa-thumbs-up'></i> Ya",
        buttonsStyling: false,
        showCancelButton: true,
        cancelButtonText: "<i class='fa fa-ban'></i> Tidak",
        reverseButtons: true,
        allowOutsideClick: false,

    }).then(function (result) {
        if (result.value) {
            if(type=='url'){
                window.location.href=url;
            }else{
                $('#'+type).modal('show');
                $.get('/reload-captcha', function (data) {
                    $(".captcha span").html(data.captcha);
                });
                $("."+type).val('');
                $("#"+form).attr("action", url);
            }
        }
    });
};