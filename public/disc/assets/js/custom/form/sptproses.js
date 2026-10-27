/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var refTarif = Array([60,5],[250,15],[500,25],[5000,30],[999999,35]);
var nptkp = 54000000;
var ntbh = 4500000;
//var rev;
var dataPrep = null;
var dataPrepFinal = null;

var sptproses = function () {

    function roundDown(nilai) {
        return 1000 * Math.floor(nilai / 1000);
    }

    function itungPtkp(kd, jml) {
        if (kd === '2') {
            return (nptkp * 2) + ((Number(jml) + Number(1)) * Number(ntbh));
        } else if (kd === '1') {
            return Number(nptkp) + ((Number(jml) + Number(1)) * Number(ntbh));
        } else {
            return Number(nptkp) + (jml * Number(ntbh));
        }
    }
    ;

    function itungPph(harta) {
        var jmlLapis = refTarif.length;
        pajak = 0;
        var max = 0;
        var pengurang;
        var trf;
        for (i = 0; i < jmlLapis; i++) {
            if (i === 0) {
                max = parseFloat(refTarif[i][0]);
            } else {
                max = parseFloat(refTarif[i][0]) - parseFloat(refTarif[i - 1][0]);
            }
            pengurang = max * parseFloat(1000000);
            trf = parseFloat(refTarif[i][1]) / parseFloat(100);
            if (harta > pengurang) {
                pajak = parseFloat(pajak) + (pengurang * trf);
                harta = parseFloat(harta) - (pengurang);
            } else {
                pajak = parseFloat(pajak) + (harta * trf);
                harta = 0;
            }
        }
        if (pajak < 0) {
            pajak = 0;
        }
        return pajak;
    }

    function cleanDate(tgl) {
        return new Date(tgl[2], tgl[1] - 1, tgl[0]);
    }

    function setTanggal(dt) {
        if (dt !== null) {
            if (typeof dt === 'number') {
                var parsedDate = new Date(parseInt(dt));
                var jsDate = new Date(parsedDate);
                return jsDate.getDate() + '-' + (parseInt(jsDate.getMonth()) + 1) + '-' + jsDate.getFullYear();
            } else {
                return dt.split("-").reverse().join("-");
            }
        }
    }

    var cekIsEditMode = function () {
        if (spt1770 !== "x" && spt1770 !== "w") {
            
            swalWithBootstrapButtons.fire({
                title: 'Apakah Anda ingin mengubah data SPT?',
                text: 'Sistem menemukan data SPT yang pernah Anda buat.',
                icon: 'warning',
                confirmButtonText: "<i class='la la-thumbs-up'></i> Ya",
                buttonsStyling: false,
                showCancelButton: true,
                cancelButtonText: "<i class='la la-ban'></i> Tidak",
                reverseButtons: true,
                allowOutsideClick: false
            }).then(function (result) {
                if (result.value) {
                    $('#year').val(spt1770.substr(0, 4)).trigger("change");
                    $('#status2').attr("checked", "checked").trigger("change");
                    $('#txtPembetulanKe').val(spt1770.substr(4));
                } else {
                    $(location).attr('href', '/spt/draf');
                }
            });
        }
    };

    var cekNmrPbyrn = function (frm, pnobyr, pbyr) {
        common.loadingMessage("Memproses", "Mohon sabar menunggu");
        if (pbyr !== null) {
            $.ajax({
                url: "/spt/pbyrn",
                type: 'POST',
                data: {th: $("#thnPajak").val(), jns: pbyr, no: pnobyr},
                success: function (data) {
                    switch (data.kdStatus) {
                        case "99" :
                            common.showMessageRedirectAnotherPage()("ERROR", data.message, "error", "/auth/login");
                            break;
                        case "0" :
                            common.showMessage("ERROR", data.message, "error");
                            $("#pbyrnTglBuktiByr").val('').focus();
                            $("#pbyrnJml").val('').focus();
                            break;
                        case "1" :
                            swal.close();
                            $("#pbyrnTglBuktiByr").val(data.message.tglBayar);
                            number.setVal('#pbyrnJml', data.message.jmlBayar);
                            break;
                        default :
                            common.showMessage("ERROR", "ERR090: Proses tidak berhasil dilakukan.", "error", "OK");
                            $("#pbyrnTglBuktiByr").val('').focus();
                            $("#pbyrnJml").val('').focus();
                            break;
                    }
                },
                error: function (jqXhr, status, er) {
                    common.showMessage("ERROR", "ERR099: Proses tidak berhasil dilakukan.", "error", "OK");
                }, complete: function (jqXHR, textStatus) {
                    // swal.close();
                }
            });
        } else {
            common.showMessage("INFO", "Jenis Pembayaran tidak Dipilih", "info");
        }
    };

    return{
        roundDown: function (nilai) {
            return roundDown(nilai);
        },
        getNilaiPtkp: function (kd, jml) {
            return itungPtkp(kd, jml);
        },
        hitungPph: function (harta) {
            return itungPph(harta);
        },
        setDate: function (tgl) {
            return cleanDate(tgl);
        },
        setTanggal: function (tgl) {
            return setTanggal(tgl);
        },
        cekIsEditMode: function () {
            cekIsEditMode();
        },
        cekNmrPbyrn: function (frm, pnobyr, pbyr) {
            cekNmrPbyrn(frm, pnobyr, pbyr);
        },
    };
}();

$(document).ready(function () {
    $(".uang").autoNumeric('init', {aDec: ',', aSep: '.', mDec: '0', vMin: '0.00'});
    $(".uangskppkp").autoNumeric('init', {aDec: ',', aSep: '.', mDec: '0', vMin: '-9999999999999'});
});