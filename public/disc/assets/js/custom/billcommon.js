var billcommon = function () {

    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          confirmButton: 'btn btn-primary',
          cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
    });

    var showMessage = function (judul, pesan) {
        swalWithBootstrapButtons.fire({
            title: judul,
            text: pesan,
            icon: "info",
            confirmButtonText: "<i class='la la-thumbs-up'></i> OK",
            buttonsStyling: false,
            allowOutsideClick: false
        });
    };

    var showMessageRedirectAnotherPage = function (judul, pesan, url) {
        swalWithBootstrapButtons.fire({
            title: judul,
            text: pesan,
            icon: "info",
            buttonsStyling: false,
            confirmButtonText: "<i class='la la-thumbs-up'></i> OK",
            allowOutsideClick: false
        }).then(function (result) {
            if (result.value) {
                $(location).attr('href', url);
            }
        });
    };

    var refcap = function () {
        $.get('/reload-captcha', function (data) {
            $(".captcha span").html(data.captcha);
        })
    }

    var cs = function (value) {
        return value.replace(/_/g, '').replace('-', '').replace(/\./gi, '').replace(/[\/]/g, '');
    };

    var cs2 = function (value) {
        return value.replace(/\s+/g, ' ');
    }

    var setInputMask = function () {
        $(".npwp").inputmask("99.999.999.9-999.999", {
            clearMaskOnLostFocus: true,
            placeholder: "_"
        });

        $(".nop").inputmask("99.99.999.999.999-9999.9", {
            clearMaskOnLostFocus: true,
            placeholder: "_"
        });
        $(".noSk").inputmask("99999/999/99/999/99", {
            clearMaskOnLostFocus: true,
            placeholder: "_"
        });

    };

    var resetform = function (ele) {
        $(ele + " input[type=text]").val('');
        $(ele + " textarea").val('');
        $(ele + " select").val('').trigger("change");
        $(ele + " input[type=checkbox]").removeAttr('checked');
        $(ele + " input[type=radio]").removeAttr('checked');
    };

    var setmaskrupiah = function () {
        $(".uang").autoNumeric('init', {aSep: '.', aDec: ',', mDec: '0', vMin: '0'});
    };

    var unsetmaskrupiahdollar = function () {
        $(".uang").autoNumeric('destroy');
    }

    var setmaskdollar = function () {
        console.log("setmaskdollar");
        $(".uang").autoNumeric('init', {aSep: ',', aDec: '.', mDec: '2', vMin: '0'});
    };

    var loadingMessage = function (judul, pesan) {
        swal.fire({
          title: judul,
          text: pesan,
          showConfirmButton: false,
          allowOutsideClick: false,
          onOpen: function () {
            swal.showLoading();
          },
        });
    };

    var defaultMasaPajak = function () {
        tempMsPjk = "";

        if (tempMsPjk === "") {
            date = new Date();
            tempMonth = "" + (parseInt(date.getMonth()) + 1);

            if (tempMonth.length < 2) {
                tempMonth = "0" + tempMonth;
            }

            $("#msPjkAwl").val(tempMonth);
            $("#msPjkAkr").val(tempMonth);
        } else {
            ms1 = tempMsPjk.substring(0, 2);
            ms2 = tempMsPjk.substring(2, 4);

            $("#msPjkAwl").val(ms1);
            $("#msPjkAkr").val(ms2);
        }
    };

    var downloadPdf = function (data, pdfname) {
        var link = document.createElement("a");
        link.href = "data:application/pdf;base64," + data;link.download = pdfname;
        link.target = "blank";document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);

    };

    return{
        init: function () {
            alert('de');
        }, loadingMessage: function (title, message) {
            loadingMessage(title, message);
        }, showMessageRedirectAnotherPage: function (a, b, c) {
            showMessageRedirectAnotherPage(a, b, c);
        }, showMessage: function (a, b) {
            showMessage(a, b);
        }, refreshcaptcha: function () {
            refcap();
        }, cleanString: function (val) {
            return cs(val);
        }, cleanString2: function (val) {
            return cs2(val);
        }, resetForm: function (ele) {
            resetform(ele);
        }, setMask: function () {
            setInputMask();
        }, setMaskRupiah: function () {
            setmaskrupiah();
        }, setMaskDollar: function () {
            setmaskdollar();
        }, unsetMaskDollarRupiah: function () {
            unsetmaskrupiahdollar();
        }, getDefaultMasaPajak: function () {
            defaultMasaPajak();
        }, downloadPdf: function (data, pdfname) {
            downloadPdf(data, pdfname);
        }
    }


}();