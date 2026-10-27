var commons = (function () {
    var refreshCaptcha = function () {
        $.get('/reload-captcha', function (data) {
            $(".captcha span").html(data.captcha);
        })
    };

    $('#reload').on('click', function(e){
        e.preventDefault();
        commons.refreshCaptcha();
    });
  
    var resetForm = function (ele) {
      $(ele + " input[type=text]").val("");
      $(ele + " input[type=password]").val("");
    };
  
    var loadingMessage = function (judul, pesan) {
      swal.fire({
        title: judul,
        text: pesan,
        showConfirmButton: false,
        allowEscapeKey: false,
        allowOutsideClick: false,
        onOpen: function () {
          swal.showLoading();
        },
      });
    };
  
    var setMaskRupiah = function () {
      $(".uang").autoNumeric("init", {
        aSep: ".",
        aDec: ",",
        mDec: "0",
        vMin: "0",
      });
    };
  
    function getValue(elem) {
      return $(elem).autoNumeric("get");
    }
  
    function setValue(elem, value) {
      return $(elem).autoNumeric("set", value !== null ? value : "0");
    }
  
    var showMessage = function (judul, pesan, type, confirmText) {
      swal.fire({
        title: judul,
        text: pesan,
        type: type,
        allowEscapeKey: false,
        allowOutsideClick: false,
        confirmButtonText: confirmText,
        buttonsStyling: false,
        confirmButtonClass: "btn btn-djp",
      });
    };
  
    var showMessageHtml = function (judul, pesan, type, confirmText) {
      swal.fire({
        title: judul,
        html: pesan,
        type: type,
        allowEscapeKey: false,
        allowOutsideClick: false,
        confirmButtonText: confirmText,
        buttonsStyling: false,
        confirmButtonClass: "btn btn-djp",
      });
    };
  
    var showMessageRedirectAnotherPage = function (
      judul,
      pesan,
      type,
      confirmText,
      url,
      msgLoading
    ) {
      swal
        .fire({
          title: judul,
          text: pesan,
          type: type,
          allowEscapeKey: false,
          allowOutsideClick: false,
          confirmButtonText: confirmText,
          buttonsStyling: false,
          confirmButtonClass: "btn btn-djp",
        })
        .then(function (result) {
          if (result.value) {
            loadingMessage(msgLoading, "Mohon sabar menunggu");
            $(location).attr("href", url);
          }
        });
    };
  
    var showMessageHtmlRedirectAnotherPage = function (
      judul,
      pesan,
      type,
      confirmText,
      url,
      msgLoading
    ) {
      swal
        .fire({
          title: judul,
          html: pesan,
          type: type,
          allowEscapeKey: false,
          allowOutsideClick: false,
          confirmButtonText: confirmText,
          buttonsStyling: false,
          confirmButtonClass: "btn btn-djp",
        })
        .then(function (result) {
          if (result.value) {
            loadingMessage(msgLoading, "Mohon sabar menunggu");
            $(location).attr("href", url);
          }
        });
    };
  
    var showMessageWithAction = function (judul, pesan, type, confirmText, aksi) {
      swal
        .fire({
          title: judul,
          text: pesan,
          type: type,
          allowEscapeKey: false,
          allowOutsideClick: false,
          confirmButtonText: confirmText,
          buttonsStyling: false,
          confirmButtonClass: "btn btn-djp",
        })
        .then(function (result) {
          if (result.value) {
            aksi();
          }
        });
    };
  
    var showMessageQuestionWithAction = function (
      judul,
      pesan,
      confirmText,
      cancelText,
      aksi
    ) {
      swal
        .fire({
          title: judul,
          text: pesan,
          type: "question",
          allowEscapeKey: false,
          allowOutsideClick: false,
          confirmButtonText: confirmText,
          buttonsStyling: false,
          confirmButtonClass: "btn btn-djp",
          showCancelButton: true,
          cancelButtonText: cancelText,
          cancelButtonClass: "btn btn-warning",
          reverseButtons: true,
        })
        .then(function (result) {
          if (result.value) {
            aksi();
          }
        });
    };
  
    var showMessageQuestionWithActionAndCancel = function (
      judul,
      pesan,
      tipe,
      confirmText,
      cancelText,
      aksi,
      aksiCancel
    ) {
      swal
        .fire({
          title: judul,
          html: pesan,
          type: tipe,
          allowEscapeKey: false,
          allowOutsideClick: false,
          confirmButtonText: confirmText,
          buttonsStyling: false,
          confirmButtonClass: "btn btn-djp",
          showCancelButton: true,
          cancelButtonText: cancelText,
          cancelButtonClass: "btn btn-warning",
          reverseButtons: true,
        })
        .then(function (result) {
          if (result.value) {
            aksi();
          } else if (result.dismiss === "cancel") {
            aksiCancel();
          }
        });
    };
  
    var downloadFile = function (data, filename, format) {
      var link = document.createElement("a");
      link.href = "data:"+format+";base64," + data;
  
      //Set properties as you wise
      link.download = filename;
      link.target = "blank";
  
      //this part will append the anchor tag and remove it after automatic click
      document.body.appendChild(link);
      link.click();
      document.body.removeChild(link);
    };
  
    function validateForm(formParam, rulesParam, messageParam, action) {
      var form = formParam;
      var error = $(".alert-danger", form);
      var success = $(".alert-success", form);
  
      jQuery.validator.addMethod(
        "noSpace",
        function (value, element) {
          return value.indexOf("_") < 0 && value !== "";
        },
        "Isian belum lengkap"
      );
  
      jQuery.validator.addMethod(
        "noZero",
        function (value, element) {
          return value !== "0";
        },
        "Isian tidak boleh 0"
      );
  
      jQuery.validator.addMethod(
        "numericDotDash",
        function (value, element) {
          var regex = new RegExp("^[0-9.-]+$");
          var key = value;
  
          if (!regex.test(key)) {
            return false;
          }
          return true;
        },
        "Isian hanya boleh angka, titik(.), strip(-)"
      );
  
      jQuery.validator.addMethod(
        "numericSlashDash",
        function (value, element) {
          var regex = new RegExp("^[0-9 .\(\)/-]+$");
          var key = value;
  
          if (!regex.test(key)) {
            return false;
          }
          return true;
        },
        'Isian hanya boleh angka dan karakter \" . / - ( ) \"'
      );
  
      jQuery.validator.addMethod(
        "alphanumericDotDash",
        function (value, element) {
          var regex = new RegExp("^[0-9A-Za-z./-]+$");
          var key = value;
  
          if (!regex.test(key)) {
            return false;
          }
          return true;
        },
        "Isian hanya boleh huruf, angka, titik(.), strip(-), garis miring(/)"
      );
  
      jQuery.validator.addMethod(
        "alphanumericSpaceDotCommaDashSingleQuote",
        function (value, element) {
          var regex = new RegExp("^[0-9A-Za-z .,'-]+$");
          var key = value;
  
          if (!regex.test(key)) {
            return false;
          }
          return true;
        },
        "Isian hanya boleh huruf, angka, spasi, titik(.), koma(,),  petik tunggal('), strip(-)"
      );
  
      jQuery.validator.addMethod(
              "withoutsemicolon",
              function (value, element) {
                  var regex = new RegExp("^[0-9A-Za-z .,'-]+$");
                  var key = value;
  
                  if (!regex.test(key) && key !== "") {
                      return false;
                  }
                  return true;
              },
              "Isian hanya boleh huruf, angka, spasi, titik(.), koma(,),  petik tunggal('), strip(-)"
          );
  
      jQuery.validator.addMethod(
        "alphanumericSymbol",
        function (value, element) {
          var regex = new RegExp("^[0-9A-Za-z .,':/&#-]+$");
          var key = value;
  
          if (!regex.test(key)) {
            return false;
          }
          return true;
        },
        "Isian hanya boleh huruf, angka, spasi, titik(.), koma(,),  petik tunggal('), titik dua(:), strip(-), garis miring(/), tanda pagar(#), ampersand(&)"
      );
  
      jQuery.validator.addMethod(
        "alphanumeric",
        function (value, element) {
          var regex = new RegExp("^[0-9A-Za-z]+$");
          var key = value;
  
          if (!regex.test(key)) {
            return false;
          }
          return true;
        },
        "Isian hanya boleh huruf dan angka"
      );
      
      jQuery.validator.addMethod(
        "nikFormat",
        function (value, element) {
          var regex1 = new RegExp("^[1-9][0-9]{14}[1-9]{1}$");
          var regex2 = new RegExp("^[1-9][0-9]{15}$");
          var key = value;
          
          if (key.substr(12, 3) === '000') {
              if (!regex1.test(key)) {
                return false;
              }
          } else {
              if (!regex2.test(key)) {
                return false;
              }
          }
  
          return true;
        },
        "Pastikan isian NIK benar"
      );
  
      form.validate({
        errorElement: "span",
        errorClass: "help-block help-block-error invalid-feedback",
        focusInvalid: false,
        ignore: "",
        rules: rulesParam,
        messages: messageParam,
        errorPlacement: function (error, element) {
          // render error placement for each input type
          if (element.parent(".input-group").length > 0) {
            error.insertAfter(element.parent(".input-group"));
          } else if (element.parent(".kt-input-icon").length > 0) {
            error.insertAfter(element.parent(".kt-input-icon"));
          } else if (element.attr("data-error-container")) {
            error.appendTo(element.attr("data-error-container"));
          } else if (element.parents(".select2-container-djp").length > 0) {
            error.insertAfter(element.parent(".select2-container-djp"));
          } else if (element.parents(".kt-radio-list").length > 0) {
            error.appendTo(
              element.parents(".kt-radio-list").attr("data-error-container")
            );
          } else if (element.parents(".kt-radio-inline").length > 0) {
            error.appendTo(
              element.parents(".kt-radio-inline").attr("data-error-container")
            );
          } else if (element.parents(".checkbox-list").length > 0) {
            error.appendTo(
              element.parents(".checkbox-list").attr("data-error-container")
            );
          } else if (element.parents(".checkbox-inline").length > 0) {
            error.appendTo(
              element.parents(".checkbox-inline").attr("data-error-container")
            );
          } else {
            error.insertAfter(element); // for other inputs, just perform default behavior
          }
        },
        invalidHandler: function (event, validator) {
          success.hide();
          error.show();
          // Metronic.scrollTo(error, -200);
          KTUtil.scrollTop();
        },
        highlight: function (element) {
          $(element).closest(".form-group").addClass("has-error");
          $(element).addClass("is-invalid");
        },
        unhighlight: function (element) {
          $(element).closest(".form-group").removeClass("has-error");
          $(element).removeClass("is-invalid");
        },
        success: function (label) {
          label.closest(".form-group").removeClass("has-error");
          label.removeClass("is-invalid");
        },
        submitHandler: function (form) {
          // success.show();
          error.hide();
          action();
        },
      });
    }
  
    function settingFormUpload(ext, size, funcCustom) {
          $('#divTableProgress').hide();
          $('#btnChooseFile').on("click", function () {
              $('#filepicker').click();
          });
  
          $('#filepicker').on("change", function (e) {
  
              $("#btnChooseFile").html("Pilih File ....");
              $("#file_error").html("");
              $("#progress").css("width", 0 + "%");
              $("#progress").html(0 + "%");
              if ($('#filepicker').val() === '') {
                  cancelFile();
              } else {
                  var files = e.target.files[0];
                  ukuran = files.size;
                  fullNameFile = files.name;
                  var validExt = false;
                  var validSize = false;
                  var nameFileOnly = fullNameFile.substr(0, fullNameFile.lastIndexOf('.')) || fullNameFile;
                  var ekstensi = fullNameFile.split('.').pop();
                  if (ekstensi === ext) {
                      validExt = true;
                  }
                  var fullsize = parseInt(size) * 1048576;
                  if (ukuran <= fullsize) {
                      validSize = true;
                  }
  
                  if (!validExt && !validSize) {
                      commons.showMessage("Format dan ukuran file tidak sesuai", "Mohon pilih file berformat ."+ext+", dan file tidak boleh melebihi "+size+"MB", "info", "OK");
                      $("#file_error").html("File harus berformat ."+ext+" dan tidak boleh melebihi "+size+"MB");
                      cancelFile();
                  } else if (!validExt && validSize) {
                      commons.showMessage("Format file tidak sesuai", "Mohon pilih file berformat ."+ext, "info", "OK");
                      $("#file_error").html("File harus berformat ."+ext);
                      cancelFile();
                  } else if (validExt && !validSize) {
                      commons.showMessage("Ukuran file tidak sesuai", "Mohon pilih file tidak melebihi "+size+"MB", "info", "OK");
                      $("#file_error").html("File harus tidak melebihi "+size+"MB");
                      cancelFile();
                  } else {
                      var customFunc = funcCustom(nameFileOnly);
                      if(customFunc){
                          if (files) {
                              tableFile();
                              $("#btnChooseFile").html("Ubah File ....");
                              $('#btnUpload').removeAttr("disabled");
                          }
                      }else{
                          cancelFile();
                      }
                  }
              }
          });
  
          function cancelFile() {
              $('#filepicker').val('');
              $("#btnChooseFile").html("Pilih File ....");
              var rowCount = $('#table tr').length;
              if (rowCount > 0) {
                  $('#divTableProgress').hide();
                  document.getElementById("table").deleteRow(0);
                  $('#btnUpload').attr("disabled", true);
              }
              return false;
          }
  
          function tableFile() {
              var x = document.getElementById("filepicker");
              var rowCount = $('#table tr').length;
              if (rowCount > 0) {
                  document.getElementById("table").deleteRow(0);
              }
              if ('files' in x) {
                  if (x.files.length === 0) {
                      txt = "Select one file.";
                  } else {
                      $('#divTableProgress').show();
                      for (var i = 0; i < x.files.length; i++) {
                          var table = document.getElementById("table");
                          var row = table.insertRow(0);
                          var cell1 = row.insertCell(0);
                          var cell2 = row.insertCell(1);
                          var cell3 = row.insertCell(2);
                          var file = x.files[i];
                          if ('name' in file) {
                              cell1.innerHTML = file.name;
                          }
                          if ('size' in file) {
                              cell2.innerHTML = filesize(file.size);
                              cell3.innerHTML = "<button type='button' id='cancel' class='btn btn-sm btn-danger btn-elevate btn-circle btn-icon cancel'><i class='fa fa-trash-alt'></i></button>";
                              $('#table tr td:last').css("text-align", "center");
                          }
                          $('#cancel').on('click', function () {
                              cancelFile();
                          });
                      }
                  }
              }
          }
      }
  
    function ajaxJsonPost(beforeAjax, paramAjax, urlAjax, doneAjax) {
      beforeAjax();
      $.ajax({
        url: urlAjax,
        type: "POST",
        data: JSON.stringify(paramAjax),
        dataType: "json",
        contentType: "application/json",
        mimeType: "application/json",
      })
        .done(function (data) {
          doneAjax(data);
        })
        .fail(function (jqXHR, textStatus, errorThrown) {
          var actErrorMessage = function () {
            location.reload();
          };
          commons.showMessageWithAction(
            "Gagal",
            "Terjadi kegagalan server, silahkan coba kembali beberapa saat lagi.",
            "error",
            "Tutup",
            actErrorMessage
          );
        });
    }
  
    function ajaxJsonGet(beforeAjax, urlAjax, doneAjax) {
      beforeAjax();
      $.ajax({
        url: urlAjax,
        type: "GET",
        dataType: "json",
        contentType: "application/json",
        mimeType: "application/json",
      })
        .done(function (data) {
          doneAjax(data);
        })
        .fail(function (jqXHR, textStatus, errorThrown) {
          var actErrorMessage = function () {
            location.reload();
          };
          commons.showMessageWithAction(
            "Gagal",
            "Terjadi kegagalan server, silahkan coba kembali beberapa saat lagi.",
            "error",
            "Tutup",
            actErrorMessage
          );
        });
    }
  
    function formSubmitPost(path, params, method) {
      method = method || "post";
  
      var form = document.createElement("form");
      form.setAttribute("method", method);
      form.setAttribute("action", path);
  
      for (var key in params) {
        if (params.hasOwnProperty(key)) {
          var hiddenField = document.createElement("input");
          hiddenField.setAttribute("type", "hidden");
          hiddenField.setAttribute("name", key);
          hiddenField.setAttribute("value", params[key]);
  
          form.appendChild(hiddenField);
        }
      }
  
      document.body.appendChild(form);
      form.submit();
    }
  
    function unmaskNpwp(name) {
      var npwp15 = $("#" + name)
        .val()
        .toString();
      npwp15 = npwp15.split("_").join("");
      npwp15 = npwp15.split(".").join("");
      npwp15 = npwp15.split("-").join("");
      return npwp15;
    }
  
    function checkStatus(name, status) {
      if (status == true) {
        $("#" + name)
          .closest(".kt-input-icon")
          .append(
            "" +
              '<span class="status-icon kt-input-icon__icon kt-input-icon__icon--right">' +
              '<span><i class="fa fa-check text-success"></i></span>' +
              "</span>"
          );
      } else {
        $("#" + name)
          .closest(".kt-input-icon")
          .append(
            "" +
              '<span class="status-icon kt-input-icon__icon kt-input-icon__icon--right">' +
              '<span><i class="fa fa-times text-danger"></i></span>' +
              "</span>"
          );
      }
    }
  
    function generateTable(
      tableId,
      url,
      param,
      lengthPage,
      order,
      columnsArr,
      columnDefsArr,
      responsive,
      search,
      autoNum,
      afterAjax
    ) {
      $.fn.DataTable.ext.pager.numbers_length = lengthPage;
      var table = $("#" + tableId).DataTable({
        responsive: responsive,
        searching: search,
        bDestroy: true,
        lengthMenu: [
          [5, 10, 25, 30],
          [5, 10, 25, 30],
        ],
        pageLength: lengthPage,
        processing: true,
        language: {
          processing:
            '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Sedang memproses...</span>',
          sLengthMenu: "Tampilkan _MENU_ entri",
          sZeroRecords: "Tidak ditemukan",
          sInfo: "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
          sInfoEmpty: "Menampilkan 0 sampai 0 dari 0 entri",
          sInfoFiltered: "(disaring dari _MAX_ entri keseluruhan)",
          sInfoPostFix: "",
          sSearch: "Cari:",
          sUrl: "",
          oPaginate: {
            sFirst: "Pertama",
            sPrevious: "Sebelumnya",
            sNext: "Selanjutnya",
            sLast: "Terakhir",
          },
        },
        ajax: function (data, callback, settings) {
          $.ajax({
            url: url,
            type: "POST",
            data: JSON.stringify(param),
            dataType: "json",
            contentType: "application/json",
            mimeType: "application/json",
            success: function (data) {
              if (data.code == 1) {
                callback(data.data);
              } else if (data.code == 9) {
                callback({});
                var actErrorMessage = function () {
                  location.reload();
                };
                commons.showMessageWithAction(
                  "Kesalahan",
                  data.error_msg,
                  "error",
                  "Tutup",
                  actErrorMessage
                );
              } else {
                callback({});
              }
            },
            statusCode: {
              401: function () {
                var actErrorMessage = function () {
                  location.reload();
                };
                commons.showMessageWithAction(
                  "Kesalahan",
                  "Session telah berakhir. Silahkan login ulang.",
                  "error",
                  "Tutup",
                  actErrorMessage
                );
              },
             400: function () {
                callback({});
             },
             404: function () {
                callback({});
             },
             403: function () {
                callback({});
             },
            },
          }).fail(function () {
            callback({});
          });
        },
        sAjaxDataProp: "",
        order: [[0, order]],
        columns: columnsArr,
        columnDefs: columnDefsArr,
        drawCallback: function (settings) {
          $('[data-toggle="kt-tooltip"]').tooltip({
            trigger: "hover",
          });
          $(".npwp-mask").inputmask("99.999.999.9-999.999");
          $(".currency-mask").inputmask({
            alias: "currency",
            prefix: "",
            groupSeparator: ".",
            digits: "0",
          });
          $(".currency-mask").each(function () {
            if ($(this).val() == "") {
              $(this).val(0);
            }
          });
        },
      });
      if (autoNum == true) {
        table
          .on("order.dt search.dt", function () {
            table
              .column(0, { search: "applied", order: "applied" })
              .nodes()
              .each(function (cell, i) {
                cell.innerHTML = i + 1;
              });
          })
          .draw();
      }
  
      afterAjax();
    }
  
    function generateTableWithCustomOrder(
      tableId,
      url,
      param,
      lengthPage,
      order,
      columnsArr,
      columnDefsArr,
      responsive,
      search,
      autoNum,
      afterAjax
    ) {
      $.fn.DataTable.ext.pager.numbers_length = lengthPage;
      var table = $("#" + tableId).DataTable({
          responsive: responsive,
          searching: search,
          bDestroy: true,
          lengthMenu: [
              [5, 10, 25, 30],
              [5, 10, 25, 30],
          ],
          pageLength: lengthPage,
          processing: true,
          language: {
              processing:
                  '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Sedang memproses...</span>',
              sLengthMenu: "Tampilkan _MENU_ entri",
              sZeroRecords: "Tidak ditemukan",
              sInfo: "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
              sInfoEmpty: "Menampilkan 0 sampai 0 dari 0 entri",
              sInfoFiltered: "(disaring dari _MAX_ entri keseluruhan)",
              sInfoPostFix: "",
              sSearch: "Cari:",
              sUrl: "",
              oPaginate: {
                  sFirst: "Pertama",
                  sPrevious: "Sebelumnya",
                  sNext: "Selanjutnya",
                  sLast: "Terakhir",
              },
          },
          ajax: function (data, callback, settings) {
              $.ajax({
                  url: url,
                  type: "POST",
                  data: JSON.stringify(param),
                  dataType: "json",
                  contentType: "application/json",
                  mimeType: "application/json",
                  success: function (data) {
                      if (data.code == 1) {
                          callback(data.data);
                      } else if (data.code == 9) {
                          callback({});
                          var actErrorMessage = function () {
                              location.reload();
                          };
                          commons.showMessageWithAction(
                              "Kesalahan",
                              data.error_msg,
                              "error",
                              "Tutup",
                              actErrorMessage
                          );
                      } else {
                          callback({});
                      }
                  },
                  statusCode: {
                      401: function () {
                          var actErrorMessage = function () {
                              location.reload();
                          };
                          commons.showMessageWithAction(
                              "Kesalahan",
                              "Session telah berakhir. Silahkan login ulang.",
                              "error",
                              "Tutup",
                              actErrorMessage
                          );
                      },
                      400: function () {
                          callback({});
                      },
                      404: function () {
                          callback({});
                      },
                      403: function () {
                          callback({});
                      },
                  },
              }).fail(function () {
                  callback({});
              });
          },
          sAjaxDataProp: "",
          order: order,
          columns: columnsArr,
          columnDefs: columnDefsArr,
          drawCallback: function (settings) {
              $('[data-toggle="kt-tooltip"]').tooltip({
                  trigger: "hover",
              });
              $(".npwp-mask").inputmask("99.999.999.9-999.999");
              $(".currency-mask").inputmask({
                  alias: "currency",
                  prefix: "",
                  groupSeparator: ".",
                  digits: "0",
              });
              $(".currency-mask").each(function () {
                  if ($(this).val() == "") {
                      $(this).val(0);
                  }
              });
          },
      });
      if (autoNum == true) {
          table
              .on("order.dt search.dt", function () {
                  table
                      .column(0, { search: "applied", order: "applied" })
                      .nodes()
                      .each(function (cell, i) {
                          cell.innerHTML = i + 1;
                      });
              })
              .draw();
      }
  
      afterAjax();
    }
  
    return {
      init: function () {},
      resetForm: function (element) {
        resetForm(element);
      },
      loadingMessage: function (title, message) {
        loadingMessage(title, message);
      },
      setMaskRupiah: function () {
        setMaskRupiah();
      },
      getVal: function (elem) {
        return getValue(elem);
      },
      setVal: function (elem, value) {
        return setValue(elem, value);
      },
      showMessage: function (title, message, type, confirmText) {
        showMessage(title, message, type, confirmText);
      },
      showMessageHtml: function (title, message, type, confirmText) {
        showMessageHtml(title, message, type, confirmText);
      },
      showMessageRedirectAnotherPage: function (
        title,
        message,
        type,
        confirmText,
        url,
        msgLoading
      ) {
        showMessageRedirectAnotherPage(
          title,
          message,
          type,
          confirmText,
          url,
          msgLoading
        );
      },
      showMessageHtmlRedirectAnotherPage: function (
        title,
        message,
        type,
        confirmText,
        url,
        msgLoading
      ) {
        showMessageHtmlRedirectAnotherPage(
          title,
          message,
          type,
          confirmText,
          url,
          msgLoading
        );
      },
      showMessageWithAction: function (
        title,
        message,
        type,
        confirmText,
        action
      ) {
        showMessageWithAction(title, message, type, confirmText, action);
      },
      showMessageQuestionWithAction: function (
        title,
        message,
        type,
        confirmText,
        cancelText,
        action
      ) {
        showMessageQuestionWithAction(
          title,
          message,
          type,
          confirmText,
          cancelText,
          action
        );
      },
      showMessageQuestionWithActionAndCancel: function (
        title,
        message,
        type,
        confirmText,
        cancelText,
        action,
        actionCancel
      ) {
        showMessageQuestionWithActionAndCancel(
          title,
          message,
          type,
          confirmText,
          cancelText,
          action,
          actionCancel
        );
      },
      refreshCaptcha: function (element) {
        refreshCaptcha(element);
      },
      validateForm: function (formParam, rulesParam, messageParam, action) {
        return validateForm(formParam, rulesParam, messageParam, action);
      },
      ajaxJsonPost: function (beforeAjax, paramAjax, urlAjax, doneAjax) {
        return ajaxJsonPost(beforeAjax, paramAjax, urlAjax, doneAjax);
      },
      ajaxJsonGet: function (beforeAjax, urlAjax, doneAjax) {
        return ajaxJsonGet(beforeAjax, urlAjax, doneAjax);
      },
      formSubmitPost: function (urlpath, params, method) {
        return formSubmitPost(urlpath, params, method);
      },
      unmaskNpwp: function (name) {
        return unmaskNpwp(name);
      },
      checkStatus: function (name, status) {
        return checkStatus(name, status);
      },
      settingFormUpload: function (ext, size, funcCustom) {
        return settingFormUpload(ext, size, funcCustom);
      },
      generateTable: function (
        tableId,
        url,
        param,
        lengthPage,
        order,
        columnsArr,
        columnDefsArr,
        responsive,
        search,
        autoNum,
        afterAjax
      ) {
        return generateTable(
          tableId,
          url,
          param,
          lengthPage,
          order,
          columnsArr,
          columnDefsArr,
          responsive,
          search,
          autoNum,
          afterAjax
        );
      },
      generateTableWithCustomOrder: function (
            tableId,
            url,
            param,
            lengthPage,
            order,
          columnsArr,
          columnDefsArr,
          responsive,
          search,
          autoNum,
          afterAjax
      ) {
        return generateTableWithCustomOrder(
            tableId,
            url,
            param,
            lengthPage,
            order,
          columnsArr,
          columnDefsArr,
          responsive,
          search,
          autoNum,
          afterAjax
        );
      },
      downloadFile: function (data, filename, format) {
        return downloadFile(data, filename, format);
      },
    };
  })();