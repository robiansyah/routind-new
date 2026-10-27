/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var prodata = function () {
    var getSptModel = function (sform, sprep) {
        return {
            tahunpajak: $("#year").val(),
            pembetulanke: $("#txtPembetulanKe").val(),
            kodeformulir: '1770S',
            detils: getModelSpt(),
            nilaipajak: Number(number.getVal("#Idk16")),
            payment: (kdlbkbn === "1" && $("#rb2").is(":checked")) ? billing.getDaftarNoPembayaran() : [],
            nilaipayment: kdlbkbn === "1" ? Number(number.getVal("#txtJmlNtpnPbk")) : 0,
            statusspt: kdlbkbn,
            tglLunas: kdlbkbn === "1" ? $("#tglSsp").val() !== '' ? $("#tglSsp").val() : "" : "",
            flagreskom: kdlbkbn === "2" ? $("#CbLebihBayar").val() : 0,
            flagkirim: statusLengkap,
            fgform: sform,
            fgprep: sprep
        };

    };
    function getModelSpt() {
        var sptDetil = {
            headerSPT: getHeader(),
            indukSPT: getIndukSpt(),
            bagIA: getBagIA(),
            bagIB: getBagIB(),
            bagIC: getBagIC(),
            bagIIA: getBagIIA(),
            bagIIB: getBagIIB(),
            bagIIC: getBagIIC(),
            bagIID: getBagIID(),
            bagPisahHarta: getPisahHarta()

        };
        return sptDetil;
    }
    function getHeader() {
        return {
            npwp: '',
            tahunPajak: $("#year").val(),
            kewajibanPajak: $("#ddlStatusKwjbnPajak").val(),
            npwpPasangan: $('#txtNpwpPasangan').val(),
            nomorHp: '',
            klu: ''
        };
    }
    function getIndukSpt() {
        return {
            ubahData: 0,
            phNettoDN: number.getVal("#Idk1"),
            phNettoDNLain: number.getVal("#Idk2"),
            phLN: number.getVal("#Idk3"),
            jmlPhNetto: number.getVal("#Idk4"),
            zakatSumbang: number.getVal("#Idk5"),
            jmlPhNettoAkhir: number.getVal("#Idk6"),
            jnsPtkp: (Number($("#IdkPtkp").val())) + Number(1),
            jmlTanggungan: $("#Idk7").val(),
            phTKP: number.getVal("#Idk71"),
            phKP: number.getVal("#Idk8"),
            pphTerutang: number.getVal("#Idk9"),
            penguranganPs24: number.getVal("#Idk10"),
            jmlPPhTerutang: number.getVal("#Idk11"),
            pphDipotong: number.getVal("#Idk12"),
            statusBayarPph: statusbyr,
            jmlBayarPPh: number.getVal("#Idk13"),
            pphPasal25: number.getVal("#Idk14a"),
            stppphPasal25: number.getVal("#Idk14b"),
            fiskalLN: number.getVal("#Idk14c"),
            jmlKreditPajak: number.getVal("#Idk15"),
            lbKbN: kdlbkbn,
            ntpn: '',
            tglLunas: $("#tglSsp").val(),
            pph: number.getVal("#Idk16"),
            permohonanLB: kdlbkbn === "2" ? $("#CbLebihBayar").val() !== '' ? Number($("#CbLebihBayar").val()) : "" : "",
            angsPPh25: number.getVal("#IdkAngs25"),
            dsrHitAngs: $("#cbDsrHitPs25").val()
        };
    }
    function getBagIA() {
        var bgA = {
            phBunga: number.getVal("#BagA01"),
            phRoyalti: number.getVal("#BagA02"),
            phSewa: number.getVal("#BagA03"),
            phHadiah: number.getVal("#BagA04"),
            phAlihHarta: number.getVal("#BagA05"),
            phLain: number.getVal("#BagA06")
        };
        return bgA;
    }
    function getBagIB() {
        var bgB = {
            bantuanHibah: number.getVal("#BagB01"),
            warisan: number.getVal("#BagB02"),
            labaAnggota: number.getVal("#BagB03"),
            asuransi: number.getVal("#BagB04"),
            beasiswa: number.getVal("#BagB05"),
            phBOPLain: number.getVal("#BagB06")
//            phBOPLainA: number.getVal("#BagB06a"),
//            phBOPLainB: number.getVal("#BagB06b"),
//            phBOPLainC: number.getVal("#BagB06c")
        };
        return bgB;
    }
    function getBagIC() {
        return {
            daftarBuktiPotong: getBuktiPotong()
        };
    }
    function getBuktiPotong() {
        var oTable = $('#tblBuktiPotong').dataTable().api();
        var data = oTable.data();
        var buktiPotong = [];
        for (i = 0; i < data.length; i++) {
            var jnsPjk;
            switch (data[i][4]) {
                case "Pasal 21":
                    jnsPjk = "1";
                    break;
                case "Pasal 22":
                    jnsPjk = "2";
                    break;
                case "Pasal 23":
                    jnsPjk = "3";
                    break;
                case "Pasal 24":
                    jnsPjk = "4";
                    break;
                case "Pasal 26":
                    jnsPjk = "5";
                    break;
                case "DTP":
                jnsPjk = "6";
                break;
                default:
                    jnsPjk = "7";
                    break;
            }
            var bp = data[i][5];
            var tgl = data[i][3];
            buktiPotong.push({
                nmPemotong: data[i][0],
                npwpPemotong: data[i][1].replace(/_/g, '').replace('-', '').replace(/\./gi, ''),
                nomorBP: data[i][2],
                tglBP: tgl,
                pasalPph: jnsPjk,
                jmlPPhDiPotong: bp

            });
        }
        return buktiPotong;
    }
    function getBagIIA() {
        var o = new Object();
        var oTable = $('#tblPphFinal').dataTable().api();
        var data = oTable.data();
        for (i = 0; i < data.length; i++) {
            switch (data[i][0]) {
                case "1":
                    o.phBungaDep = data[i][2];
                    o.pjkBungaDep = data[i][3];
                    break;
                case "2":
                    o.phBungaObl = data[i][2];
                    o.pjkBungaObl = data[i][3];
                    break;
                case "3":
                    o.phJualSaham = data[i][2];
                    o.pjkJualSaham = data[i][3];
                    break;
                case "4":
                    o.phHadiah = data[i][2];
                    o.pjkHadiah = data[i][3];
                    break;
                case "5":
                    o.phPesangon = data[i][2];
                    o.pjkPesangon = data[i][3];
                    break;
                case "6":
                    o.phHonor = data[i][2];
                    o.pjkHonor = data[i][3];
                    break;
                case "7":
                    o.phAlihTB = data[i][2];
                    o.pjkAlihTB = data[i][3];
                    break;
                case "8":
                    o.phSewaTB = data[i][2];
                    o.pjkSewaTB = data[i][3];
                    break;
                case "9":
                    o.phBgnGunaSerah = data[i][2];
                    o.pjkBgnGunaSerah = data[i][3];
                    break;
                case "10":
                    o.phBungaSimp = data[i][2];
                    o.pjkBungaSimp = data[i][3];
                    break;
                case "11":
                    o.phTrDerivatif = data[i][2];
                    o.pjkTrDerivatif = data[i][3];
                    break;
                case "12":
                    o.phDividen = data[i][2];
                    o.pjkDividen = data[i][3];
                    break;
                case "13":
                    o.phIstri = data[i][2];
                    o.pjkPhIstri = data[i][3];
                    break;
                case "14":
                    o.phLain = data[i][2];
                    o.pjkPhLain = data[i][3];
                    break;
                default:
                    break;
            }
        }
        return o;
    }
    function getDaftarHarta() {
        var oTable = $('#tblHarta').dataTable().api();
        var data = oTable.rows().data();
        var lsHarta = [];
        for (i = 0; i < data.length; i++) {
            lsHarta.push({
                kodeHarta: data[i][0],
                jnsHarta: data[i][1],
                thPerolehan: data[i][2],
                harga: data[i][3],
                ket: data[i][4]
            });
        }
        return lsHarta;
    }
    function getBagIIB() {
        return{
            daftarHarta: getDaftarHarta()
        };
    }
    function getDaftarUtang() {
        var oTable = $('#tblHutang').dataTable().api();
        var data = oTable.data();
        var lsHtg = [];
        for (i = 0; i < data.length; i++) {
            lsHtg.push({
                kodeUtang: data[i][0],
                nmPbrPinjam: data[i][1],
                almtPbrPinjam: data[i][2],
                thPinjam: data[i][3],
                jmlPinjam: data[i][4]
            });
        }


        return lsHtg;
    }
    function getBagIIC() {
        return {
            daftarUtang: getDaftarUtang()
        };
    }
    function getDaftarKel() {
        var oTable = $('#tblTanggungan').dataTable().api();
        var data = oTable.data();
        var lsKel = [];
        for (i = 0; i < data.length; i++) {
            lsKel.push({
                nmAgKel: data[i][0],
                tglLahir: data[i][1],
                nik: data[i][2],
                hubKel: data[i][3],
                kerja: data[i][4]
            });
        }

        return lsKel;
    }
    function getBagIID() {
        return {
            daftarKeluarga: getDaftarKel()
        };
    }
    function getPisahHarta() {
        return {
            phSuami: number.getVal("#idkPenghasilanSuami"),
            phIstri: number.getVal("#idkPenghasilanIstri"),
            phGab: Number(number.getVal("#idkPenghasilanSuami")) + Number(number.getVal("#idkPenghasilanIstri"))
        };
    }


    var loadBagIA = function (data) {
        if (data !== null) {
            number.setVal("#BagA01", data.phBunga);
            number.setVal("#BagA02", data.phRoyalti);
            number.setVal("#BagA03", data.phSewa);
            number.setVal("#BagA04", data.phHadiah);
            number.setVal("#BagA05", data.phAlihHarta);
            number.setVal("#BagA06", data.phLain);
            $("#BagA06").blur();
        }
    };
    var loadBagIB = function (data) {
        if (data !== null) {
            number.setVal("#BagB01", data.bantuanHibah);
            number.setVal("#BagB02", data.warisan);
            number.setVal("#BagB03", data.labaAnggota);
            number.setVal("#BagB04", data.asuransi);
            number.setVal("#BagB05", data.beasiswa);
            number.setVal("#BagB06", data.phBOPLain);
//            number.setVal("#BagB06a", data.phBOPLainA);
//            number.setVal("#BagB06b", data.phBOPLainB);
//            number.setVal("#BagB06c", data.phBOPLainC);
            $("#BagB06").blur();
        }
    };
    var loadBagIC = function (data) {
        var lsBp = data.daftarBuktiPotong;
        daftarBuktiPotongHandler.setDataBuktiPotong(lsBp);
        var jmlPphDiPotong = 0;
        for (var i = 0; i < lsBp.length; i++) {
            jmlPphDiPotong += Number(lsBp[i].jmlPPhDiPotong);
        }
        number.setVal("#Idk12", jmlPphDiPotong).trigger("blur");
    };
    var loadBagIIA = function (data) {
        daftarFinalHandler.setFinal(data);
    };
    var loadBagIIB = function (data) {
        daftarAsetHandler.setharta(data.daftarHarta);
    };
    var loadBagIIC = function (data) {
        daftarUtangHandler.setUtang(data.daftarUtang);
    };
    var loadBagIID = function (data) {
        daftarKeluargaHandler.setTanggungan(data.daftarKeluarga);
    };
    var loadBagPH = function (data) {
        if (data !== null) {
            number.setVal("#idkPenghasilanSuami", data.phSuami);
            number.setVal("#idkPenghasilanIstri", data.phIstri);
        }
    };
    var loadBagInduk = function (data) {
        number.setVal("#Idk1", data.phNettoDN);
        number.setVal("#Idk3", data.phLN);
        number.setVal("#Idk5", data.zakatSumbang);
        $("#IdkPtkp").val(Number(data.jnsPtkp) - 1);
        $("#Idk7").val(data.jmlTanggungan).change();

        number.setVal("#Idk10", data.penguranganPs24);
        number.setVal("#Idk14a", data.pphPasal25);
        number.setVal("#Idk14b", data.stppphPasal25);
        number.setVal("#Idk14c", data.fiskalLN);
        $("#Idk14c").blur();
        $("#tglSsp").val(data.tglLunas);

        var a = (data.tglLunas);
        $("#CbLebihBayar").val(data.permohonanLB);
        $("#cbDsrHitPs25").val(data.dsrHitAngs);
        number.setVal("#IdkAngs25", data.angsPPh25);

    };

    var loadDataSpt = function (data) {
        if (data.detils !== null) {
            loadBagIA(data.detils.bagIA);
            loadBagIB(data.detils.bagIB);
            loadBagIC(data.detils.bagIC);
            loadBagIIA(data.detils.bagIIA);
            loadBagIIB(data.detils.bagIIB);
            loadBagIIC(data.detils.bagIIC);
            loadBagIID(data.detils.bagIID);
            loadBagPH(data.detils.bagPisahHarta);

            var kwPjk = data.detils.headerSPT.kewajibanPajak;
            if (kwPjk !== null) {
                if (kwPjk == "0") {
                    $('#rbnikah1').prop("checked", true);
                    $('#ddlStatusKwjbnPajak').val("0").change();
                } else {
                    $('#rbnikah2').prop("checked", true);
                    $('#ddlStatusKwjbnPajak').val(kwPjk).change();
                }
            }
            loadBagInduk(data.detils.indukSPT);
        }

        if (data.payment !== null) {
            if (data.payment.length > 0) {
                $("#rb2").prop("checked", true);
                billing.loadDataSpt(data.payment);
                $("#formTblByr").show();
                $("#buktiBayar_new").show();
                $("#tblJnsPembayaran").show();
                $('#tblJnsPembayaran_info').show();
                $('#tblJnsPembayaran_paginate').show();
            } else {
                console.log('tidak ada');
                $("#rb1").prop("checked", true);
            }
        }
    };



    return {
        setData: function (a, b) {
            return getSptModel(a, b);
        }, loadSpt: function (data) {
            loadDataSpt(data);
        }
    };
}();

