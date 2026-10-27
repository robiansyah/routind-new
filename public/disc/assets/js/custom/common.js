var common = (function () {
  var refreshCaptcha = function () {
      $.get('/reload-captcha', function (data) {
          $(".captcha span").html(data.captcha);
          $("#captcha").val("");
      })
  };
  
  $('#reload').on('click', function(e){
      e.preventDefault();
      common.refreshCaptcha();
  });

  var resetForm = function (ele) {
    $(ele + " input[type=text]").val("");
    $(ele + " input[type=password]").val("");
  };

  const swalWithBootstrapButtons = Swal.mixin({
      customClass: {
        confirmButton: 'btn btn-primary',
        cancelButton: 'btn btn-danger'
      },
      buttonsStyling: false
  });

  var showNotif = function (judul, type){
      Swal.fire({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        icon: type,
        title: judul,
        iconColor: 'white',
        customClass: {
          popup: 'colored-toast'
        },
      });
  }

  var loadingMessage = function (judul, pesan) {
    swal.fire({
      title: judul,
      html: pesan,
      showConfirmButton: false,
      allowEscapeKey: false,
      allowOutsideClick: false,
    });
    swal.showLoading();
  };
  
  var showMessage = function (judul, pesan, type, confirmText="Ok") {
      swalWithBootstrapButtons.fire({
          title: judul,
          html: pesan,
          icon: type,
          confirmButtonText: confirmText,
          buttonsStyling: false,
      });
  };

  var showMessageWithAction = function (judul, pesan, type, confirmText, aksi) {
    swalWithBootstrapButtons.fire({
      title: judul,
      html: pesan,
      tyiconpe: type,
      allowEscapeKey: false,
      allowOutsideClick: false,
      confirmButtonText: confirmText,
      buttonsStyling: false,
    }).then(function (result) {
        if (result.value) {
          aksi();
        }
    });
  };

  var showMessageQuestionWithAction = function (judul,pesan,confirmText,cancelText,aksi) {
    swalWithBootstrapButtons.fire({
        title: judul,
        html: pesan,
        type: "warning",
        allowEscapeKey: false,
        allowOutsideClick: false,
        confirmButtonText: confirmText,
        buttonsStyling: false,
        showCancelButton: true,
        cancelButtonText: cancelText,
        reverseButtons: true,
      })
      .then(function (result) {
        if (result.value) {
          aksi();
        }
      });
  };
  
  var showMessageQuestionWithActionAndCancel = function (judul,pesan,tipe,confirmText,cancelText,aksi,aksiCancel) {
    swalWithBootstrapButtons.fire({
        title: judul,
        html: pesan,
        icon: tipe,
        allowEscapeKey: false,
        allowOutsideClick: false,
        confirmButtonText: confirmText,
        buttonsStyling: false,
        showCancelButton: true,
        cancelButtonText: cancelText,
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

  var showMessageOnReload = function (judul, pesan, type) {
      swalWithBootstrapButtons.fire({
          title: judul,
          html: pesan,
          icon: type,
          confirmButtonText: "<i class='fa fa-thumbs-up'></i> Ya",
          buttonsStyling: false,
          allowOutsideClick: false,
      }).then(function (result) {
          if (result.value) {
              location.reload();
          }
      });
  };

  var showMessageConfirmNotif = function (judul, pesan, type, cb){
      swalWithBootstrapButtons.fire({
          title: judul,
          html: pesan,
          icon: type,
          confirmButtonText: "<i class='fa fa-thumbs-up'></i> Ya",
          buttonsStyling: false,
          showCancelButton: true,
          cancelButtonText: "<i class='fa fa-ban'></i> Tidak",
          reverseButtons: true,
          allowOutsideClick: false,
          
      }).then(function (result) {
          if (result.value) {
              cb(true);
          } else{
              cb(false);
          }
      });
  };

  var blockPanel = function (panel) {
      const loadingEl = document.createElement("div");
      document.body.prepend(loadingEl);
      loadingEl.classList.add("page-loader");
      loadingEl.classList.add("flex-column");
      loadingEl.innerHTML = `
          <span class="spinner-border text-primary" role="status"></span>
          <span class="text-muted fs-6 fw-semibold mt-5">Loading...</span>
      `;
      // Show page loading
      KTApp.showPageLoading();
  };

  var unblockPanel = function (panel) {
      KTApp.hidePageLoading();
      // loadingEl.remove();
  };

  function formatNumber(num) {
      var dec = num.toString().split('.',2);
      
      dec[0]= dec[0].replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.');
      return dec.join(',');
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
        common.showMessageWithAction("Gagal","Terjadi kegagalan server, silahkan coba kembali beberapa saat lagi.","error","Tutup",actErrorMessage);
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
        common.showMessageWithAction("Gagal","Terjadi kegagalan server, silahkan coba kembali beberapa saat lagi.","error","Tutup",actErrorMessage);
      });
  }

  function generateTable(tableId,url,param,lengthPage,order,columnsArr,columnDefsArr,responsive,search,autoNum,afterAjax) {
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
              common.showMessageWithAction("Kesalahan",data.error_msg,"error","Tutup",actErrorMessage);
            } else {
              callback({});
            }
          },
          statusCode: {
            401: function () {
              var actErrorMessage = function () {
                location.reload();
              };
              common.showMessageWithAction("Kesalahan","Session telah berakhir. Silahkan login ulang.","error","Tutup",actErrorMessage);
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
        $('[data-bs-toggle="tooltip"]').tooltip({
          trigger: "hover",
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

  return {
    init: function () {},
    refreshCaptcha: function (element) {
        refreshCaptcha(element);
    },
    resetForm: function (element) {
      resetForm(element);
    },
    showNotif: function (title, type) {
      showNotif(title, type);
    },
    loadingMessage: function (title, message) {
      loadingMessage(title, message);
    },
    showMessage: function (title, message, type, confirmText) {
      showMessage(title, message, type, confirmText);
    },
    showMessageWithAction: function (title,message,type,confirmText,action) {
        showMessageWithAction(title, message, type, confirmText, action);
    },
    showMessageQuestionWithAction: function (title,message,type,confirmText,cancelText,action) {
      showMessageQuestionWithAction(title,message,type,confirmText,cancelText,action);
    },
    showMessageQuestionWithActionAndCancel: function (title,message,type,confirmText,cancelText,action,actionCancel) {
      showMessageQuestionWithActionAndCancel(title,message,type,confirmText,cancelText,action,actionCancel);
    },
    showMessageOnReload: function (title, message, type) {
        showMessageOnReload(title, message, type);
    },
    showMessageConfirmNotif: function (title, message, type, cb) {
        showMessageConfirmNotif(title, message, type, cb);
    },
    blockPanel: function (panel) {
        blockPanel(panel);
    },
    unBlockPanel: function (panel) {
        unblockPanel(panel);
    },
    formatNumber : function (num) {
        return formatNumber(num);
    },
    ajaxJsonPost: function (beforeAjax, paramAjax, urlAjax, doneAjax) {
      return ajaxJsonPost(beforeAjax, paramAjax, urlAjax, doneAjax);
    },
    ajaxJsonGet: function (beforeAjax, urlAjax, doneAjax) {
      return ajaxJsonGet(beforeAjax, urlAjax, doneAjax);
    },
    generateTable: function (tableId,url,param,lengthPage,order,columnsArr,columnDefsArr,responsive,search,autoNum,afterAjax){
      return generateTable(tableId,url,param,lengthPage,order,columnsArr,columnDefsArr,responsive,search,autoNum,afterAjax);
    },
    formSubmitPost: function (urlpath, params, method) {
      return formSubmitPost(urlpath, params, method);
    },
  };
})();