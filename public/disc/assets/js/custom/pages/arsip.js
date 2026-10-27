$(document).ready(function () {
    tbldftrspt();
    if ($("#popup").val() !== "") {
        var images = $("#popup").val().toString();
        var img = images.split(";");
        var html = ""
        for(var i = 0; i < img.length; i++){
            html = html + '<div><img alt="Popup '+i+'" src="'+img[i]+'"></div>'
        }
        swal.fire({
            padding: '2.5rem 1.25rem 1.25rem 1.25rem',
            width: '600px',
            showConfirmButton: false,
            showCloseButton: true,
            html:'<div class="owl-carousel owl-theme">' +
                html +
                '</div>'
        });

        $('.owl-carousel').owlCarousel({
            loop:true,
            autoplay:true,
            autoplayTimeout:3000,
            autoplayHoverPause:true,
            items:1
        });
        $('.play').on('click',function(){
            owl.trigger('play.owl.autoplay',[3000])
        })
        $('.stop').on('click',function(){
            owl.trigger('stop.owl.autoplay')
        })
    }
});

function tbldftrspt() {
    var tblDftrSpt = "tbl_arsipspt";
    var paramTblDftrSpt = {};
    var urlTblDftrSpt = "/ajax/dftr_spt";
    var colTblDftrSpt = [
        {data: null},
        {data: "jenis"},
        {data: "masaTahun"},
        {data: "pembetulanke"},
        {data: "status"},
        {data: "nilaipajak"},
        {data: "sumber"},
        {data: "idspt"}
    ];
    var colDefTblDftrSpt = [
        {
            targets: 0,
            responsivePriority: 1,
            orderable: false,
            className: 'text-center',
            render: function (data, type, full, meta) {
                return '<div style="width: 100%;">' + data + '<div>';
            }
        },
        {
            targets: 1,
            responsivePriority: 3,
            className: 'text-center',
            render: function (data, type, full, meta) {
                return 'SPT '+data;
            }
        },
        {
            targets: [2,3, -2],
            responsivePriority: 2,
            className: 'text-center'
        },
        {
            targets: 4,
            responsivePriority: 5,
            className: 'text-center',
            render: function (data, type, full, meta) {
                return setStatusSpt(data);
            }
        },
        {
            targets: 5,
            responsivePriority: 6,
            className: 'text-right',
            render: function (data, type, full, meta) {
                return '<div class="currency-mask">' + data + '<div>';
            }
        },
        {
            targets: -1,
            responsivePriority: 1,
            orderable: false,
            className: 'text-center',
            render: function (data, type, full, meta) {
                return '<span data-toggle="modal" data-target="#modal_djp"><button type="button" ' +
                    'class="btn btn-djp btn-sm btn-elevate btn-circle btn-icon mb-1 mr-1 bpe-btn" ' +
                    'data-skin="djp" data-container="body" ' +
                    'data-toggle="kt-tooltip" data-placement="bottom" title=""' +
                    'data-original-title="Lihat BPE">' +
                    '<i class="fa fa-envelope-open-text"></i>' +
                    '</button></span>';
            }
        }
    ];

    var afterAjaxTblDftrSpt = function () {
        $('#tbl_arsipspt tbody').on('click', '.bpe-btn', function (e) {
            e.preventDefault();
            if($('#containerBpe').length){
                $('#containerBpe').remove();
            }
            var data = $("#tbl_arsipspt").DataTable().row($(this).parents('tr')).data();
            $("#divBpe").modal('show');
            var str = '<div id="containerBpe" style="width: 100%;height: auto; font-family: serif;">' +
                '<div style="background-color: #99CCFF">' +
                '<div style="text-align: center">' +
                '<span style="font-size:small">Penyampaian SPT Elektronik</span><br>' +
                '<span style="font-size:small">Â© Direktorat Jenderal Pajak</span>' +
                '</div>' +
                '</div>' +
                '<div>' +
                '<div style="background-color: #CCFFFF; text-align: center;">' +
                'Berikut ini adalah Bukti Penerimaan Elektronik Anda.<br>' +
                '---------------------------------------------------' +
                '</div>' +
                '</div>' +
                '<div>' +
                '<div style="background-color: #CCFFFF; text-align: center;">' +
                '<div id="vNama">Nama : '+$("#namaUser").val()+'</div>' +
                '<div>' +
                '<label style="margin-bottom: 0px">NPWP : </label>' +
                '<label id="vNpwp" class="npwp" style="margin-bottom: 0px">'+$("#npwpUser").val()+'</label>' +
                '</div>' +
                '<div id="vThPajak">Tahun Pajak : '+(data.masaTahun).substring(0, 4)+'</div>' +
                '<div id="vMasaPajak">Masa Pajak : '+(data.masaTahun).substring(5, 10)+'</div>' +
                '<div id="vJnsSpt">Jenis SPT : '+(data.jenis)+'</div>' +
                '<div id="vRevno">Pembetulan ke : '+(data.pembetulanke)+'</div>' +
                '<div id="vStatusLbKbn">Status SPT : '+setStatusSpt(data.status)+'</div>' +
                '<div>' +
                '<label style="margin-bottom: 0px">Nominal :</label>' +
                '<label id="vJmlLbkbn" class="currency" style="margin-bottom: 0px">'+data.nilaipajak+'</label>' +
                '</div>' +
                '<div id="vTglKirim">Tanggal Penyampaian : '+data.tgl+'</div>' +
                '<div id="vNtte">Nomor Tanda Terima Elektronik : '+data.ntte+'</div>' +
                '</div>' +
                '</div>' +
                '<div>' +
                '<div style="background-color: #CCFFFF;text-align: center;">' +
                'Terima kasih telah menyampaikan Laporan SPT Anda.' +
                '</div>' +
                '</div>' +
                '</div>';
            $('#modalBpe').append(str);
            masking();
        });

    };

    djpcommon.generateTable(
        tblDftrSpt,
        urlTblDftrSpt,
        paramTblDftrSpt,
        5,
        "asc",
        colTblDftrSpt,
        colDefTblDftrSpt,
        true,
        false,
        true,
        afterAjaxTblDftrSpt);
}

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

function masking() {
    $(".currency").each(function () {
        $(this).inputmask({
            alias: "currency",
            prefix: "",
            groupSeparator: ".",
            digits: "0",
        });
    });
    $(".npwp").each(function () {
        $(this).inputmask({
            "mask": "99.999.999.9-999.999"
        });
    });
}