$.fn.editable.defaults.mode = 'inline';
var ajaxUrl = "/eform/1770/update/induk";
var year = new Date().getFullYear();
var yearMin = year-2;
$('.xedit').editable({
    url: ajaxUrl,
    type: 'tel',
    title: 'Update',
    success: function (response) {
        // console.log(response);
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
    var butir1 = number.getVal('#butir1');
    var butir2 = number.getVal('#butir2');
    var butir3 = number.getVal('#butir3');
    var butir4 = number.getVal('#butir4');
    number.setVal('#butir5', butir1+butir2+butir3+butir4);
    var butir5 = number.getVal('#butir5');
    var butir6 = number.getVal('#butir6');
    number.setVal('#butir7', (butir5-butir6 > 0) ? butir5-butir6 : 0);
    var butir7 = number.getVal('#butir7');
    var butir8 = number.getVal('#butir8');
    number.setVal('#butir9', (butir7-butir8 > 0) ? butir7-butir8 : 0);
    var butir9 = number.getVal('#butir9');
    var butir10 = number.getVal('#butir10');
    number.setVal('#butir11',(butir9-butir10 > 0) ? butir9-butir10 : 0);
    var butir11 = number.getVal('#butir11');
    number.setVal('#butir12', itungPph(butir11));
    var butir12 = number.getVal('#butir12');
    var butir13 = number.getVal('#butir13');
    number.setVal('#butir14', butir12+butir13);
    var butir14 = number.getVal('#butir14');
    var butir15 = number.getVal('#butir15');
    number.setVal('#butir16', butir14-butir15);
    var butir16 = number.getVal('#butir16');
    var butir17a = number.getVal('#butir17a');
    var butir17b = number.getVal('#butir17b');
    number.setVal('#butir18', butir17a+butir17b);
    var butir18 = number.getVal('#butir18');
    number.setVal('#butir19', butir16-butir18);
    var butir19 = number.getVal('#butir19');
    var butir21 = number.getVal('#butir21');

    if(butir16>=0){
        $('input[type=radio][name=butir16_option][value=1]').prop("checked", true);
    }else{
        $('input[type=radio][name=butir16_option][value=2]').prop("checked", true);
    }
    if(butir19>=0){
        $('#lebih_bayar').prop("checked", false);
        $('input[type=radio][name=butir19_option][value=1]').prop("checked", true);
    }else{
        $('#lebih_bayar').prop("checked", true);
        $('input[type=radio][name=lebih_bayar][value=1]').prop("checked", true);
    }

    $.ajax({
        data: {butir5: butir5, butir11: butir11, butir12: butir12, butir19: butir19, type: 'hitung'},
        url: "/eform/1770/store/induk/"+spt_id,
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

$('#ptkp_code').editable({
    url: ajaxUrl,
    source: [
        {value: '00', text: 'TK/0'},
        {value: '01', text: 'TK/1'},
        {value: '02', text: 'TK/2'},
        {value: '03', text: 'TK/3'},
        {value: '10', text: 'K/0'},
        {value: '11', text: 'K/1'},
        {value: '12', text: 'K/2'},
        {value: '13', text: 'K/3'},
        {value: '20', text: 'K/I/0'},
        {value: '21', text: 'K/I/1'},
        {value: '22', text: 'K/I/2'},
        {value: '23', text: 'K/I/3'},
    ],
    success: function (response) {
        var kd = response.value.charAt(0);
        var jml = response.value.charAt(1);
        number.setVal('#butir10', itungPtkp(kd, jml));
        hitung();
        common.showNotif('Sukses', 'success');
    },
});

$('#angsuran_check').change(function() {
    if(this.checked) {
        var butir16 = number.getVal('#butir16');
        var angsuran = 1/12*butir16;
        number.setVal('#butir21', angsuran);
        $('#angsuran').editable('setValue', angsuran);
    }else{
        var angsuran = 0;
        number.setVal('#butir21', angsuran); 
        $('#angsuran').editable('setValue', angsuran);
    }

    $.ajax({
        data: {angsuran: angsuran, type: 'angsuran'},
        url: "/eform/1770/store/induk/"+spt_id,
        type: "POST",
        dataType: 'json',
        success: function (data) {
            common.showNotif('Sukses', 'success');
        },
    });
});

var refTarif = Array([60,5],[250,15],[500,25],[5000,30],[999999,35]);
var nptkp = 54000000;
var ntbh = 4500000;

function itungPtkp(kd, jml) {
    if (kd === '2') {
        return (nptkp * 2) + ((Number(jml) + Number(1)) * Number(ntbh));
    } else if (kd === '1') {
        return Number(nptkp) + ((Number(jml) + Number(1)) * Number(ntbh));
    } else {
        return Number(nptkp) + (jml * Number(ntbh));
    }
}

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

$(document).ready(function () {
    hitung();
});