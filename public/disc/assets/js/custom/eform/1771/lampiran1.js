$.fn.editable.defaults.mode = 'inline';

$('.xedit').editable({
    url: "/eform/update/lampiran1",
    type: 'tel',
    title: 'Update',
    success: function (response) {
        var column = response.column;
        $('#'+column).val(response.value);
        common.showNotif('Sukses', 'success');
        hitung();
    },
    display: function(value) {
        $(this).text(number.setText(value));
    }
});

function hitung(){
    var a1 = number.getVal('#peredaran_usaha');
    var a2 = number.getVal('#jumlah_hpp');
    var a3 = number.getVal('#jumlah_bul');
    number.setVal('#jumlah_1d', parseInt(a1)-parseInt(a2)-parseInt(a3));
    var a4 = number.getVal('#jumlah_1d');
    var a5 = number.getVal('#penghasilan_luar');
    var a6 = number.getVal('#jumlah_bdlu');
    number.setVal('#jumlah_1g', parseInt(a5)-parseInt(a6));
    var a7 = number.getVal('#jumlah_1g');
    number.setVal('#jumlah_1h', parseInt(a4)+parseInt(a7));
    var a8 = number.getVal('#jumlah_1h');
    var b = number.getVal('#luar_negeri');
    number.setVal('#jumlah_3', parseInt(a8)+parseInt(b));
    var c = number.getVal('#jumlah_3');
    var d = number.getVal('#pph_final');
    var e1 = number.getVal('#butir_5a');
    var e2 = number.getVal('#butir_5b');
    var e3 = number.getVal('#butir_5c');
    var e4 = number.getVal('#butir_5d');
    var e5 = number.getVal('#butir_5e');
    var e6 = number.getVal('#butir_5f');
    var e7 = number.getVal('#butir_5g');
    var e8 = number.getVal('#butir_5h');
    var e9 = number.getVal('#butir_5i');
    var e10 = number.getVal('#butir_5j');
    var e11 = number.getVal('#butir_5k');
    var e12 = number.getVal('#butir_5l');
    number.setVal('#butir_5m', parseInt(e1)+parseInt(e2)+parseInt(e3)+parseInt(e4)+parseInt(e5)+parseInt(e6)+parseInt(e7)+parseInt(e8)+parseInt(e9)+parseInt(e10)+parseInt(e11)+parseInt(e12));
    var e13 = number.getVal('#butir_5m');
    var f1 = number.getVal('#butir_6a');
    var f2 = number.getVal('#butir_6b');
    var f3 = number.getVal('#butir_6c');
    var f4 = number.getVal('#butir_6d');
    number.setVal('#butir_6e', parseInt(f1)+parseInt(f2)+parseInt(f3)+parseInt(f4));
    var f5 = number.getVal('#butir_6e');
    var g = number.getVal('#butir_7');
    number.setVal('#butir_8', parseInt(c)-parseInt(d)+parseInt(e13)-parseInt(f5)-parseInt(g));
    var total = number.getVal('#butir_8');
    $.ajax({
        data: {komersial: a8, total: total},
        url: "/eform/store/lampiran1/"+spt_id,
        type: "POST",
        dataType: 'json',
        success: function (data) {
            console.log(data);
        },
    });
}


$(document).ready(function () {
    hitung();
});