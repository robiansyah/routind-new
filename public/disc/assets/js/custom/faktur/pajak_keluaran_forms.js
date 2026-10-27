$( document ).ready(function() {
    var item = $('#item').DataTable({
        processing: true,
        serverSide: true,
        "bPaginate": false,
        "bLengthChange": false,
        "bFilter": false,
        "bInfo": false,
        ajax: "/faktur/produk/view/"+invoice_id,
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false, className: "text-center align-middle"},
            {data: 'name', name: 'name', orderable: false, searchable: false, className: "align-middle"},
            {data: 'price', name: 'price', render: $.fn.dataTable.render.number( '.', ',', 0 ), orderable: false, searchable: false, className: "align-middle text-center"},
            {data: 'amount', name: 'amount', render: $.fn.dataTable.render.number( '.', ',', 0 ), orderable: false, searchable: false, className: "align-middle text-center"},
            {data: 'total', name: 'total', render: $.fn.dataTable.render.number( '.', ',', 0 ), orderable: false, searchable: false, className: "align-middle text-center"},
            {data: 'discount', name: 'discount', render: $.fn.dataTable.render.number( '.', ',', 0 ), orderable: false, searchable: false, className: "align-middle text-center"},
            {data: 'dpp', name: 'dpp', render: $.fn.dataTable.render.number( '.', ',', 0 ), orderable: false, searchable: false, className: "align-middle text-center"},
            {data: 'ppn', name: 'ppn', render: $.fn.dataTable.render.number( '.', ',', 0 ), orderable: false, searchable: false, className: "align-middle text-center"},
            {data: 'ppnbm', name: 'ppnbm', render: $.fn.dataTable.render.number( '.', ',', 0 ), orderable: false, searchable: false, className: "align-middle text-center"},
            {data: 'action', name: 'action', orderable: false, searchable: false, className: "text-center"},
        ]
    });
    
    $('#tambahItem').click(function () {
        $('#itemBtn').val("create");
        $('#item_id').val('');
        $('#itemForm').trigger("reset");
        $("#reference_id").attr('required', '');
        $('#itemHeading').html("Tambah Barang / Jasa");
        $('#itemBtn').html('Simpan');
        $('#itemModal').modal('show');
        $("#barjas").show();
        $("#detailBarjas").hide();
    });
    
    $('body').on('click', '.editItem', function () {
        var item_id = $(this).data('id');
        $.get('/faktur/produk/' + item_id +'/edit', function (data) {
            $('#itemHeading').html("Edit Barang / Jasa "+data.name);
            $('#itemBtn').html('Update');
            $('#itemBtn').val("edit-item");
            $('#itemModal').modal('show');
            $('#item_id').val(data.id);
            $("#detailBarjas").show();
            $("#reference_id").removeAttr('required');
            $('#munit').val(data.unit).change();
            $('#mname').val(data.name);
            $("#"+data.type).prop("checked", true);
            number.setVal('#mprice', data.price);
            number.setVal('#mtotal', data.price*data.amount);
            number.setVal('#mdpp', data.dpp);
            number.setVal('#mppn', data.ppn);
            number.setVal('#mamount', data.amount);
            number.setVal('#mdiscount', data.discount);
            number.setVal('#mtarif_ppnbm', data.tarif_ppnbm);
            number.setVal('#mppnbm', data.ppnbm);
        })
    });
    
    $('#itemBtn').click(function (e) {
        e.preventDefault();
        if($("#itemForm").valid()){
            $.ajax({
                data: $('#itemForm').serialize(),
                url: "/faktur/produk/store/"+invoice_id,
                type: "POST",
                dataType: 'json',
                success: function (data) {
                    $('#itemForm').trigger("reset");
                    $('#itemModal').modal('hide');
                    common.showNotif('Sukses', 'success');
                    item.draw();
                    number.setVal('#dpp', data.data.dpp);
                    number.setVal('#ppn', data.data.ppn);
                    number.setVal('#ppnbm', data.data.ppnbm);
                    $('.dpp').text($('#dpp').val());
                    $('.ppn').text($('#ppn').val());
                    $('.ppnbm').text($('#ppnbm').val());
                },
                error: function (data) {
                    console.log('Error:', data);
                    $('#itemBtn').html('Simpan');
                }
            });
        }
    });
    
    $('body').on('click', '.deleteItem', function () {
        var item_id = $(this).data('id');
        var judul = "Perhatian...";
        var pesan = "Anda akan menghapus Data ini?";
        var type = "warning";
        common.showMessageConfirmNotif(judul, pesan, type, function (e) {
            if (e) {
                $.ajax({
                    type: "DELETE",
                    url: '/faktur/produk/'+item_id,
                    success: function (data) {
                        item.draw();
                        number.setVal('#dpp', data.data.dpp);
                        number.setVal('#ppn', data.data.ppn);
                        number.setVal('#ppnbm', data.data.ppnbm);
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
            }
        });
    });
    
    $('#transaction_id').change(function() {
        var status = $('#status').val();
        var code = '.00';
        if(status=='Normal - Pengganti'){
            code = '.01';
        }
        $('#mtransaction_code').text(this.value+code);
        $('#transaction_code').val(this.value+code);
    });
    
    $('#reference_id').change(function() {
        var id = this.value;
        $.get('/faktur/referensi/barang_jasa/' + id +'/edit', function (data) {
            $('#mamount').val(1);
            $('#mdiscount').val(0);
            $('#mtarif_ppnbm').val(0);
            $('#mppnbm').val(0);
            number.setVal('#mprice', data.price);
            number.setVal('#mtotal', data.price);
            number.setVal('#mdpp', data.price);
            number.setVal('#mppn', data.price*0.12);
        });
    });
    
    $(".hitung").change(function(){
        var price = number.getVal('#mprice');
        var amount = number.getVal('#mamount');
        var discount = number.getVal('#mdiscount');
        var tarif_ppnbm = number.getVal('#mtarif_ppnbm');
        var id = $(this).attr('id');
    
        var total = price*amount;
        if(id != 'mdpp' && id != 'mtarif_ppnbm'){
            var dpp = total-discount;
        }else{
            var dpp = number.getVal('#mdpp');
        }
        var ppnbm = tarif_ppnbm*dpp/100;
        var ppn = dpp*0.12;
        number.setVal('#mtotal', total);
        number.setVal('#mdpp', dpp);
        number.setVal('#mppn', ppn);
        number.setVal('#mppnbm', ppnbm);
    });
    
    Inputmask({
        "mask" : "99.999-99999999"
    }).mask("#invoice_no");
    $('#invoice_date').flatpickr();
    $('#invoice_date').change(function() {
        date = new Date($(this).val());
        var year = date.getFullYear();
        var month = date.getMonth()+1;
        var inv_period = $('#invoice_period').val();
        var inv_year = $('#invoice_year').val();
//        if(inv_period == '' && inv_year==''){
            if(month < 10){
                month = '0'+month;
            }
            $('#invoice_year').val(year).change();
            $('#invoice_period').val(month).change();
//        }

    });
    
    $(".uang").autoNumeric('init', {aSep: '.', aDec: ',', mDec: '0', vMin: '0'});

    $("#detailBarjas").hide();
    $("#detailTermin").hide();

    $("#termin").change(function() {
        if(this.checked) {
            $("#detailTermin").show();
        }else{
            $("#detailTermin").hide();
            $('input[type=radio][name=payment]').prop( "checked", false );
            $("#dpp_split").attr('readonly', '');
            $("#ppn_split").attr('readonly', '');
            $("#ppnbm_split").attr('readonly', '');
            $("#dpp_split").addClass("form-control-solid");
            $("#ppn_split").addClass("form-control-solid");
            $("#ppnbm_split").addClass("form-control-solid");
            number.setVal('#dpp_split', 0);
            number.setVal('#ppn_split', 0);
            number.setVal('#ppnbm_split', 0);
        }
    });

    $('input[type=radio][name=payment]').click(function() {
        $("#dpp_split").removeAttr('readonly');
        $("#ppn_split").removeAttr('readonly');
        $("#ppnbm_split").removeAttr('readonly');
        $("#dpp_split").removeClass("form-control-solid");
        $("#ppn_split").removeClass("form-control-solid");
        $("#ppnbm_split").removeClass("form-control-solid");
    });

    var payment = $('#old_payment').val();
    if(payment != 'lunas'){
        console.log(payment);
        $("#detailTermin").show();
        $("#termin").prop("checked", true);
        $("input[type=radio][name=payment][value='"+payment+"']").prop("checked", true);
        $("#dpp_split").removeAttr('readonly');
        $("#ppn_split").removeAttr('readonly');
        $("#ppnbm_split").removeAttr('readonly');
        $("#dpp_split").removeClass("form-control-solid");
        $("#ppn_split").removeClass("form-control-solid");
        $("#ppnbm_split").removeClass("form-control-solid");
    }

    jQuery.validator.addMethod("noSpace", function (value, element) {
        return value.indexOf("_") < 0 && value !== "";
    }, "Harap periksa kembali Kode & No Seri Faktur Pajak");

    $("#myForm").validate({
        errorElement: 'div', //default input error message container
        errorClass: 'fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback', // default input error message class
        rules: {
            invoice_no : {
                required: true,
                noSpace: true,
            },
            customer_id : {
                required: true,
            },
            invoice_date : {
                required: true,
            },
            invoice_period : {
                required: true,
            },
            invoice_year : {
                required: true,
            },
            transaction_id : {
                required: true,
            },
        },
    });
});
