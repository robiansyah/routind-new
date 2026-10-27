$.fn.editable.defaults.mode = 'inline';
var ajaxUrl = "/eform/1770/update/lampiran1";
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
    var butir1a = number.getVal('#butir1a');
    var butir1b = number.getVal('#butir1b');
    number.setVal('#butir1c', butir1a - butir1b);
    var butir1c = number.getVal('#butir1c');
    var butir1d = number.getVal('#butir1d');
    number.setVal('#butir1e', butir1c - butir1d);
    var butir1e = number.getVal('#butir1e');
    var butir2a = number.getVal('#butir2a');
    var butir2b = number.getVal('#butir2b');
    var butir2c = number.getVal('#butir2c');
    var butir2d = number.getVal('#butir2d');
    var butir2e = number.getVal('#butir2e');
    var butir2f = number.getVal('#butir2f');
    var butir2g = number.getVal('#butir2g');
    var butir2h = number.getVal('#butir2h');
    var butir2i = number.getVal('#butir2i');
    var butir2j = number.getVal('#butir2j');
    var butir2k = number.getVal('#butir2k');
    number.setVal('#butir2l', butir2a + butir2b + butir2c + butir2d + butir2e + butir2f + butir2g + butir2h + butir2i + butir2j + butir2k );
    var butir2l = number.getVal('#butir2l');
    var butir3a = number.getVal('#butir3a');
    var butir3b = number.getVal('#butir3b');
    var butir3c = number.getVal('#butir3c');
    number.setVal('#butir3d', butir3a + butir3b + butir3c);
    var butir3d = number.getVal('#butir3d');
    number.setVal('#butir4', butir1e + butir2l - butir3d);
    var butir4 = number.getVal('#butir4');
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
       ]
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
        url: "/eform/1770/store/lampiran1/"+spt_id,
        type: "POST",
        dataType: 'json',
        success: function (data) {
            common.showNotif('Sukses', 'success');
        },
    });
});