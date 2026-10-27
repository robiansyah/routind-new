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
        number.setVal('#e14d', response.terutang_14);
        common.showNotif('Sukses', 'success');
        hitung();
    },
    display: function(value) {
        $(this).text(number.setText(value));
    }
});

function hitung(){
    var e14a = number.getVal('#e14a');
    var e14b = number.getVal('#e14b');
    number.setVal('#e14c', e14a-e14b);
    var e14c = number.getVal('#e14c');
    var tarif = $('#tarif').val();
    var e14d = number.getVal('#e14d');
    var e14e = number.getVal('#e14e');
    number.setVal('#e14f', e14d-e14e);
    var e14f = number.getVal('#e14f');
    number.setVal('#e14g', (1/12)*e14f);
    var e14g = number.getVal('#e14g');
}

$('.xeditable').editable({
    url: ajaxUrl,
    title: 'Update',
    rows: 2,
    success: function (data) {
        common.showNotif('Sukses', 'success');
    },
});

$('.required').editable({
    url: ajaxUrl,
    validate: function(value) {
       if($.trim(value) == '') return 'This field is required';
    }
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