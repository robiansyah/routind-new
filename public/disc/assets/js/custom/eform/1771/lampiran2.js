$.fn.editable.defaults.mode = 'inline';

$('.xedit').editable({
    url: "/eform/update/lampiran2",
    type: 'tel',
    title: 'Update',
    success: function (response) {
        var hcolumn = response.hcolumn;
        var vcolumn = response.vcolumn;
        number.setVal('#'+hcolumn, response.hjumlah);
        number.setVal('#'+vcolumn, response.vjumlah);
        number.setVal('#total', response.total);
        common.showNotif('Sukses', 'success');
    },
    display: function(value) {
        $(this).text(number.setText(value));
    }
});