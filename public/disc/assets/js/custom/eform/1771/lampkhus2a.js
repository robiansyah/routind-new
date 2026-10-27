$.fn.editable.defaults.mode = 'inline';

$('.xedit').editable({
    url: "/eform/update/lampkhus2a",
    type: 'tel',
    title: 'Update',
    success: function (response) {
        console.log(response);
        var column = response.column;
        number.setVal('#'+column, response.value);
        common.showNotif('Sukses', 'success');
        
    },
    display: function(value) {
        $(this).text(number.setText(value));
    }
});