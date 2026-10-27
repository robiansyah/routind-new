$.fn.editable.defaults.mode = 'inline';
var ajaxUrl = "/eform/update/induk";
var year = new Date().getFullYear();
var yearMin = year-2;
$('.xedit').editable({
    url: ajaxUrl,
    type: 'tel',
    title: 'Update',
    success: function (response) {
        var column = response.column;
        $('.'+column).val(response.value);
        hitung();
        common.showNotif('Sukses', 'success');
    },
    display: function(value) {
        $(this).text(number.setText(value));
    }
});

function hitung(){
    var a1 = number.getVal('#a1');
    var a2 = number.getVal('#a2');
    var a3 = number.getVal('#a3');
    var b4 = number.getVal('#b4');
    var b5 = number.getVal('#b5');
    number.setVal('#b6', b4+b5);
    var b6 = number.getVal('#b6');
    var c7 = number.getVal('#c7');
    var c8a = number.getVal('#c8a');
    var c8b = number.getVal('#c8b');
    number.setVal('#c8c', c8a+c8b);
    var c8c = number.getVal('#c8c');
    number.setVal('#c9', b6-c7-c8c);
    var c9 = number.getVal('#c9');
    var c10a = number.getVal('#c10a');
    var c10b = number.getVal('#c10b');
    number.setVal('#c10c', c10a+c10b);
    var c10c = number.getVal('#c10c');
    number.setVal('#d11', c9-c10c);
    var d11 = number.getVal('#d11');
    if(c9>=0){
        $('input[type=radio][name=audit][value=butir9_option1]').prop("checked", true);
    }else{
        $('input[type=radio][name=audit][value=butir9_option2]').prop("checked", true);
    }
    if(d11>=0){
        $('input[type=radio][name=butir11_option][value=butir11_option1]').prop("checked", true);
        $('.butir11_option1').show();
        $('.butir11_option2').hide();
        $('input[type=radio][name=lebih_bayar][value=direstitusikan]').prop("disabled", true);
        $('input[type=radio][name=lebih_bayar][value=direstitusikan]').prop("checked", false);
    }else{
        $('input[type=radio][name=butir11_option][value=butir11_option2]').prop("checked", true);
        $('.butir11_option1').hide();
        $('.butir11_option2').show();
        $('input[type=radio][name=lebih_bayar][value=direstitusikan]').prop("disabled", false);
        $('input[type=radio][name=lebih_bayar][value=direstitusikan]').prop("checked", true);
        $('#tanggal').editable('setValue', null);
    }
    $.ajax({
        data: {jumlah: d11, type: 'pph'},
        url: "/eform/store/induk/"+spt_id,
        type: "POST",
        dataType: 'json',
        success: function (data) {
            // console.log(data);
        },
    });
}

$('.xeditable').editable({
    url: ajaxUrl,
    title: 'Update',
    rows: 2,
    success: function (data) {
        common.showNotif('Sukses', 'success');
    },
});

$('.xdate').editable({
    url: ajaxUrl,
    combodate: {
        minYear: yearMin,
        maxYear: year,
    },
    success: function (data) {
        common.showNotif('Sukses', 'success');
    },
});

$('#opini').editable({
    url: ajaxUrl,
    source: [
        {value: 'Wajar Tanpa Pengecualian', text: 'Wajar Tanpa Pengecualian'},
        {value: 'Wajar Dengan Pengecualian', text: 'Wajar Dengan Pengecualian'},
        {value: 'Tidak Wajar', text: 'Tidak Wajar'},
        {value: 'Tidak Ada Opini', text: 'Tidak Ada Opini'}
    ],
    success: function (data) {
        common.showNotif('Sukses', 'success');
    },
});

$('input[type=radio][name=audit]').change(function() {
    if (this.value == 'ya') {
        $('.opini').show();
        $('.audit').hide();
    }
    else if (this.value == 'tidak') {
        $('.opini').hide();
        $('.audit').show();
        $('#opini').editable('setValue', null);
        $('#nama_kap').editable('setValue', null);
        $('#npwp_kap').editable('setValue', null);
        $('#nama_akuntan').editable('setValue', null);
        $('#npwp_akuntan').editable('setValue', null);
    }
    $.ajax({
        data: {audit: this.value, type: 'audit'},
        url: "/eform/store/induk/"+spt_id,
        type: "POST",
        dataType: 'json',
        success: function (data) {
            common.showNotif(data.success, 'success');
        },
    });
});

$('input[type=radio][name=pph_terutang]').change(function() {
    var a3 = number.getVal('#a3');
    var tarif = 19;
    if (this.value == 'pasal 17 ayat 1b') {
        tarif = 22;
    }
    number.setVal('#b4', a3*tarif/100);
    var b4 = number.getVal('#b4');
    $.ajax({
        data: {tarif: this.value, terutang: b4, type: 'terutang'},
        url: "/eform/store/induk/"+spt_id,
        type: "POST",
        dataType: 'json',
        success: function (data) {
            common.showNotif(data.success, 'success');
            hitung();
        },
    });
});

$(document).ready(function () {
    hitung();
});