/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var sessi = function () {

    var supported = function () {
        return window.sessionStorage;
    };

    var save = function (npwp, data) {
        if (supported) {
            window.sessionStorage.setItem('dataSpt-' + npwp + "-" + data.kodeformulir + "-" + data.tahunpajak, JSON.stringify(data));
        }
//        $window.sessionStorage.dataTempSpt = data;
    };

    var get = function (npwp, kodeformulir, tahunpajak) {
        if (supported) {
            return JSON.parse(sessionStorage.getItem('dataSpt-' + npwp + "-" + kodeformulir + "-" + tahunpajak));
        }
    };

    var clear = function (npwp) {
        for (var key in window.sessionStorage) {
            if (key.indexOf(npwp) === -1)
                window.sessionStorage.removeItem(key);
        }
    };

    return{
        isSupported: function () {
            supported();
        },
        save: function (npwp, data) {
            save(npwp, data);
        },
        get: function (npwp, kodeformulir, tahunpajak) {
            get(npwp, kodeformulir, tahunpajak);
        },
        clear: function (npwp) {
            clear(npwp);
        }
    };
}();