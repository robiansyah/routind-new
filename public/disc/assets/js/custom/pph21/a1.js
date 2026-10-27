$( document ).ready(function() {
    var refTarif = Array([60,5],[250,15],[500,25],[5000,30],[999999999, 35]);
    if(item_id != ''){
        $.get('/pph21/bupot/pegawai/' + item_id +'/edit', function (result) {
            $('#ptkp_code').val(result.ptkp_code).change();
            $('#id').val(result.id);
            $('#no').val(result.no);
            $('#nik').val(result.nik);
            $('#name').val(result.name);
            $('#address').val(result.address);
            $('#position').val(result.position);
            $('#year').val(result.year).change();
            $('#period').val(result.period).change();
            $('#end_year').val(result.end_year).change();
            $('#end_period').val(result.end_period).change();
            if(result.status=='Pegawai Tetap'){
                $('#object_code').val('21-100-01').change();
            }else{
                $('#object_code').val('21-100-02').change();
            }
            number.setVal('#salary', result.salary);
            number.setVal('#pph', result.pph);
            number.setVal('#other', result.other);
            number.setVal('#honorarium', result.honorarium);
            number.setVal('#premi', result.premi);
            number.setVal('#natura', result.natura);
            number.setVal('#thr', result.thr);
            number.setVal('#pension', result.pension);
            number.setVal('#zakat', result.zakat);
            number.setVal('#previous', result.previous);
            hitung();
        });
    }

    $('#penghasilan').change(function() {
        hitung();
    });
    $('#pengurang').change(function() {
        hitung();
    });
    $('#sebelum').change(function() {
        hitung();
    });

    function hitung(){
        var salary = number.getVal('#salary');
        var pph = number.getVal('#pph');
        var other = number.getVal('#other');
        var honorarium = number.getVal('#honorarium');
        var premi = number.getVal('#premi');
        var natura = number.getVal('#natura');
        var thr = number.getVal('#thr');
        number.setVal('#bruto', salary+pph+other+honorarium+premi+natura+thr);
        var bruto = number.getVal('#bruto');
        var position = (bruto*0.05>=6000000) ? 6000000 : bruto*0.05;
        number.setVal('#position_fee', position);
        var pension = number.getVal('#pension');
        var zakat = number.getVal('#zakat');
        var nett = bruto-position-pension-zakat;
        number.setVal('#pengurangan', position+zakat+pension);
        number.setVal('#netto', nett);
        number.setVal('#nett', nett);
        var previous = number.getVal('#previous');
        var ptkp = number.getVal('#ptkp');
        if(nett > ptkp){
            number.setVal('#pkp', nett-ptkp);
            var terutang = itungPph(nett-ptkp);
            number.setVal('#pph21', terutang);
            number.setVal('#terutang', terutang);
        }else{
            number.setVal('#pkp', 0);
            number.setVal('#pph21', 0);
            number.setVal('#terutang', 0);
        }
        number.setVal('#lebih', terutang-previous);
        number.setVal('#akhir', terutang-previous);
    }

    $('#ptkp_code').change(function(){
        var ptkp = itungPtkp($(this).val());
        number.setVal('#ptkp', ptkp);
        hitung();
    });

    $(".uang").autoNumeric('init', {aSep: '.', aDec: ',', mDec: '0', vMin: '0'});

    Inputmask({
        "mask" : "9999999999999999"
    }).mask("#nik");

    function itungPtkp(ptkp) {
        var kd = ptkp.substr(0,1);
        var jml = parseInt(ptkp.substr(1));
        var nptkp = 54000000;
        var ntbh = 4500000;
        if (kd == '2') {
            return (nptkp * 2) + ((jml + 1) * ntbh);
        } else if (kd == '1') {
            var tambah = (jml + 1);
            var news = tambah * ntbh;
            console.log(tambah);
            return nptkp + ((jml + 1) * ntbh);
        } else {
            return nptkp + (jml * ntbh);
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

    $("#itemForm").validate({
        errorElement: 'div', //default input error message container
        errorClass: 'fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback', // default input error message class
        rules: {
            salary : {
                required: true,
            },
            pph : {
                required: true,
            },
            other : {
                required: true,
            },
            honorarium : {
                required: true,
            },
            premi : {
                required: true,
            },
            natura : {
                required: true,
            },
            thr : {
                required: true,
            },
            bruto : {
                required: true,
            },
            pension : {
                required: true,
            },
            zakat : {
                required: true,
            },
        },
    });


});
