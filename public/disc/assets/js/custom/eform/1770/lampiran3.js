$.fn.editable.defaults.mode = 'inline';

$('.xedit').editable({
    url: "/eform/1770/update/lampiran3a",
    type: 'tel',
    title: 'Update',
    success: function (response) {
        number.setVal('#terutang', response.jumlah);
        common.showNotif('Sukses', 'success');
    },
    display: function(value) {
        $(this).text(number.setText(value));
    }
});

$('.xupdate').editable({
    url: "/eform/1770/update/lampiran3b",
    type: 'tel',
    title: 'Update',
    success: function (response) {
        number.setVal('#jbb', response.jumlah);
        number.setVal('#tidak', response.lainnya);
        common.showNotif('Sukses', 'success');
    },
    display: function(value) {
        $(this).text(number.setText(value));
    }
});

