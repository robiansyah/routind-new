var refTarif = Array([60,5],[250,15],[500,25],[5000,30],[999999,35]);
var nptkp = 54000000;
var ntbh = 4500000;

var number = (function () {
    function getValue(elem) {
        return Number($(elem).val().replace(/[^0-9,-]+/g,""));
    }

    function setValue(elem, value) {
        var number = numeral(value).format(0.0);
        return $(elem).val(number);
    }

    function setText(value) {
        var number = numeral(value).format(0.0);
        return number;
      }

    function getHtml(elem) {
        return Number($(elem).html().replace(/[^0-9,-]+/g,""));
    }

    function setHtml(elem, value) {
        var number = numeral(value).format(0.0);
        return $(elem).html(number);
    }
    

    numeral.register('locale', 'idn', {
        delimiters: {
            thousands: '.',
            decimal: ','
        },
        abbreviations: {
            thousand: 'rb',
            million: 'jt',
            billion: 'm',
            trillion: 't'
        },
        ordinal: function (number) {
            return '.';
        },
        currency: {
            symbol: 'Rp.'
        }
    });
    
    numeral.locale('idn'); 
  
    return {
        init: function () {},
        getVal: function (elem) {
            return getValue(elem);
        },
        setVal: function (elem, value) {
            return setValue(elem, value);
        },
        setText: function (value) {
            return setText(value);
          },
        getHtml: function (elem) {
            return getHtml(elem);
        },
        setHtml: function (elem, value) {
            return setHtml(elem, value);
        },
    };
})();