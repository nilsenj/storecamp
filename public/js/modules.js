(function() {
  $(function() {
    'use strict';

    /* ChartJS
     * -------
     * Here we will create a few charts using ChartJS
     */
    var PieData, pieChart, pieChartCanvas, pieOptions, salesChart, salesChartCanvas, salesChartData, salesChartOptions;
    if ($('#salesChart').length > 0) {
      salesChartCanvas = $('#salesChart').get(0).getContext('2d');
      salesChart = new Chart(salesChartCanvas);
      salesChartData = {
        labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
        datasets: [
          {
            label: 'Electronics',
            fillColor: 'rgb(210, 214, 222)',
            strokeColor: 'rgb(210, 214, 222)',
            pointColor: 'rgb(210, 214, 222)',
            pointStrokeColor: '#c1c7d1',
            pointHighlightFill: '#fff',
            pointHighlightStroke: 'rgb(220,220,220)',
            data: [65, 59, 80, 81, 56, 55, 40]
          }, {
            label: 'Digital Goods',
            fillColor: 'rgba(60,141,188,0.9)',
            strokeColor: 'rgba(60,141,188,0.8)',
            pointColor: '#3b8bba',
            pointStrokeColor: 'rgba(60,141,188,1)',
            pointHighlightFill: '#fff',
            pointHighlightStroke: 'rgba(60,141,188,1)',
            data: [28, 48, 40, 19, 86, 27, 90]
          }
        ]
      };
      salesChartOptions = {
        showScale: true,
        scaleShowGridLines: false,
        scaleGridLineColor: 'rgba(0,0,0,.05)',
        scaleGridLineWidth: 1,
        scaleShowHorizontalLines: true,
        scaleShowVerticalLines: true,
        bezierCurve: true,
        bezierCurveTension: 0.3,
        pointDot: false,
        pointDotRadius: 4,
        pointDotStrokeWidth: 1,
        pointHitDetectionRadius: 20,
        datasetStroke: true,
        datasetStrokeWidth: 2,
        datasetFill: true,
        legendTemplate: '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].lineColor%>"></span><%=datasets[i].label%></li><%}%></ul>',
        maintainAspectRatio: true,
        responsive: true
      };
      salesChart.Line(salesChartData, salesChartOptions);
      pieChartCanvas = $('#pieChart').get(0).getContext('2d');
      pieChart = new Chart(pieChartCanvas);
      PieData = [
        {
          value: 700,
          color: '#f56954',
          highlight: '#f56954',
          label: 'Chrome'
        }, {
          value: 500,
          color: '#00a65a',
          highlight: '#00a65a',
          label: 'IE'
        }, {
          value: 400,
          color: '#f39c12',
          highlight: '#f39c12',
          label: 'FireFox'
        }, {
          value: 600,
          color: '#00c0ef',
          highlight: '#00c0ef',
          label: 'Safari'
        }, {
          value: 300,
          color: '#3c8dbc',
          highlight: '#3c8dbc',
          label: 'Opera'
        }, {
          value: 100,
          color: '#d2d6de',
          highlight: '#d2d6de',
          label: 'Navigator'
        }
      ];
      pieOptions = {
        segmentShowStroke: true,
        segmentStrokeColor: '#fff',
        segmentStrokeWidth: 1,
        percentageInnerCutout: 50,
        animationSteps: 100,
        animationEasing: 'easeOutBounce',
        animateRotate: true,
        animateScale: false,
        responsive: true,
        maintainAspectRatio: false,
        legendTemplate: '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<segments.length; i++){%><li><span style="background-color:<%=segments[i].fillColor%>"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>',
        tooltipTemplate: '<%=value %> <%=label%> users'
      };
      pieChart.Doughnut(PieData, pieOptions);

      /* jVector Maps
       * ------------
       * Create a world map with markers
       */
      $('#world-map-markers').vectorMap({
        map: 'world_mill_en',
        normalizeFunction: 'polynomial',
        hoverOpacity: 0.7,
        hoverColor: false,
        backgroundColor: 'transparent',
        regionStyle: {
          initial: {
            fill: 'rgba(210, 214, 222, 1)',
            'fill-opacity': 1,
            stroke: 'none',
            'stroke-width': 0,
            'stroke-opacity': 1
          },
          hover: {
            'fill-opacity': 0.7,
            cursor: 'pointer'
          },
          selected: {
            fill: 'yellow'
          },
          selectedHover: {}
        },
        markerStyle: {
          initial: {
            fill: '#00a65a',
            stroke: '#111'
          }
        },
        markers: [
          {
            latLng: [41.90, 12.45],
            name: 'Vatican City'
          }, {
            latLng: [43.73, 7.41],
            name: 'Monaco'
          }, {
            latLng: [-0.52, 166.93],
            name: 'Nauru'
          }, {
            latLng: [-8.51, 179.21],
            name: 'Tuvalu'
          }, {
            latLng: [43.93, 12.46],
            name: 'San Marino'
          }, {
            latLng: [47.14, 9.52],
            name: 'Liechtenstein'
          }, {
            latLng: [7.11, 171.06],
            name: 'Marshall Islands'
          }, {
            latLng: [17.3, -62.73],
            name: 'Saint Kitts and Nevis'
          }, {
            latLng: [3.2, 73.22],
            name: 'Maldives'
          }, {
            latLng: [35.88, 14.5],
            name: 'Malta'
          }, {
            latLng: [12.05, -61.75],
            name: 'Grenada'
          }, {
            latLng: [13.16, -61.23],
            name: 'Saint Vincent and the Grenadines'
          }, {
            latLng: [13.16, -59.55],
            name: 'Barbados'
          }, {
            latLng: [17.11, -61.85],
            name: 'Antigua and Barbuda'
          }, {
            latLng: [-4.61, 55.45],
            name: 'Seychelles'
          }, {
            latLng: [7.35, 134.46],
            name: 'Palau'
          }, {
            latLng: [42.5, 1.51],
            name: 'Andorra'
          }, {
            latLng: [14.01, -60.98],
            name: 'Saint Lucia'
          }, {
            latLng: [6.91, 158.18],
            name: 'Federated States of Micronesia'
          }, {
            latLng: [1.3, 103.8],
            name: 'Singapore'
          }, {
            latLng: [1.46, 173.03],
            name: 'Kiribati'
          }, {
            latLng: [-21.13, -175.2],
            name: 'Tonga'
          }, {
            latLng: [15.3, -61.38],
            name: 'Dominica'
          }, {
            latLng: [-20.2, 57.5],
            name: 'Mauritius'
          }, {
            latLng: [26.02, 50.55],
            name: 'Bahrain'
          }, {
            latLng: [0.33, 6.73],
            name: 'São Tomé and Príncipe'
          }
        ]
      });

      /* SPARKLINE CHARTS
       * ----------------
       * Create a inline charts with spark line
       */
      $('.sparkbar').each(function() {
        var $this;
        $this = $(this);
        $this.sparkline('html', {
          type: 'bar',
          height: $this.data('height') ? $this.data('height') : '30',
          barColor: $this.data('color')
        });
      });
      $('.sparkpie').each(function() {
        var $this;
        $this = $(this);
        $this.sparkline('html', {
          type: 'pie',
          height: $this.data('height') ? $this.data('height') : '90',
          sliceColors: $this.data('color')
        });
      });
      $('.sparkline').each(function() {
        var $this;
        $this = $(this);
        $this.sparkline('html', {
          type: 'line',
          height: $this.data('height') ? $this.data('height') : '90',
          width: '100%',
          lineColor: $this.data('linecolor'),
          fillColor: $this.data('fillcolor'),
          spotColor: $this.data('spotcolor')
        });
      });
    } else {
      salesChartCanvas = null;
      return salesChart = null;
    }
  });

}).call(this);

(function() {
  $.StoreCamp.dropzone = {
    paramName: 'file',
    maxFilesize: 1024,
    acceptedFiles: '.mp4,.mkv,.avi, image/*,application/pdf,.psd,.docx,.doc,.aac,.ogg,.oga,.mp3,.wav, .zip',
    accept: function(file, done) {
      done();
    },
    init: function() {
      this.on('success', function(file, messageOrDataFromServer, myEvent) {
        var folderBody, folderBodyUrl;
        folderBody = $('#folder-body');
        folderBodyUrl = folderBody.data('folder-url');
        return $.ajax({
          url: folderBodyUrl,
          type: 'GET',
          success: function(data) {
            var players;
            folderBody.html(data);
            players = plyr.setup();
            $.StoreCamp.media.reindex($('.media-plyr-item'), players);
          },
          error: function(xhr, textStatus, errorThrown) {
            folderBody.html('<b class=\'text-warning\'>' + xhr.responseJSON + '</b>' + '<br><code class=\'text-warning\'>' + 'code - ' + xhr.status + ' statusText - ' + xhr.statusText + '</code>');
            console.error(xhr);
          }
        }, false);
      });
    }
  };

  Dropzone.options.myAwesomeDropzone = $.StoreCamp.dropzone;

  Dropzone.options.myAwesomeDropzoneBody = $.StoreCamp.dropzone;

}).call(this);

(function() {
  var ref, ref1, ref2, ref3;

  $.StoreCamp.fileLinker = {
    options: {
      typesAvailable: [''],
      fileLinker: $('.file-linker'),
      requestUrl: (ref = $('.file-linker').attr('data-requestUrl')) != null ? ref : APP_URL + "/admin/media/file_linker/local",
      fileTypes: (ref1 = $('.file-linker').attr('data-file-types')) != null ? ref1 : "image, document, audio, video, archive",
      fileMultiple: (ref2 = $('.file-linker').attr('data-multiple')) != null ? ref2 : false,
      fileAttachOutputPath: (ref3 = $('.file-linker').attr('data-attach-output-path')) != null ? ref3 : "form .tab-content",
      fileLinkerModal: $('#fileLinker-modal'),
      submitBtn: $('#fileLinker-modal').find('button[type=submit]'),
      modalTitle: $('#fileLinker-modal').find('.modal-title'),
      modalBody: $('#fileLinker-modal').find('.modal-body')
    },
    activate: function() {
      var _this;
      _this = this;
      return _this.fileSystemEvents();
    },
    fileSystemEvents: function() {
      var _this;
      _this = this;
      _this.options.fileLinkerModal.on('shown.bs.modal', function(event) {
        var fileLinker;
        fileLinker = $(event.relatedTarget);
        $(this).modal('show');
        _this.showFiles();
      });
      $(".file-item .select-file").on("click", function(event) {
        var btn, fileItem, folderBody, selectUrl;
        event.preventDefault();
        btn = $(this);
        selectUrl = btn.attr('data-href');
        fileItem = btn.closest('.file-item');
        folderBody = $('#folder-body');
        _this.selectFile(selectUrl, fileItem);
        console.log(btn.attr('href'));
      });
      $(".directory-item .select-folder").on("click", function(event) {
        var btn, fileItem, folderBody, folderDisk, folderId, folderUrl;
        event.preventDefault();
        btn = $(this);
        folderUrl = btn.attr('data-href');
        folderId = btn.attr('data-file-id');
        folderDisk = btn.attr('data-disk');
        fileItem = btn.closest('.directory-item');
        folderBody = $('#folder-body');
        _this.selectFolder(folderUrl, fileItem);
      });
    },
    showFiles: function() {
      var _this, dataObject;
      _this = this;
      dataObject = {
        multiple: _this.options.fileMultiple,
        dataTypes: _this.options.fileTypes
      };
      return $.ajax({
        url: _this.options.requestUrl,
        type: 'POST',
        data: dataObject,
        success: function(data) {
          _this.options.modalBody.html(data);
        },
        error: function(xhr, textStatus, errorThrown) {
          $.StoreCamp.templates.alert('danger', xhr.statusText, 'Sorry error appeared');
          console.error(xhr);
        }
      }, false);
    },
    reindex: function(mediaItems, players) {
      var _this;
      _this = this;
      return [].forEach.call(mediaItems, function(item, i, arr) {
        $(item).attr('data-media-number', i);
        return;
        return _this._triggerNewFile(mediaItems, players);
      });
    },
    selectFile: function(fileURL, fileItem) {
      var _this;
      return _this = this;
    },
    selectFolder: function(folderUrl) {
      var _this;
      _this = this;
      return $.ajax({
        url: deleteUrl,
        type: 'GET',
        success: function(data) {
          fileItem.remove();
          $.StoreCamp.templates.alert('success', data.title, data.message);
          console.log(data);
        },
        error: function(xhr, textStatus, errorThrown) {
          $.StoreCamp.templates.alert('danger', xhr.statusText, xhr.responseText);
          console.error(xhr);
        }
      }, false);
    }
  };

  $.StoreCamp.fileLinker.activate();

}).call(this);

(function() {
  $.StoreCamp.imageLoad = {
    activate: function() {
      var _this;
      _this = this;
      _this.initiateInstanceImage();
      _this.initiateProfileImage();
    },
    renderInstanceImage: function(file, fileinput, settings) {
      var _this, image, reader;
      _this = this;
      reader = new FileReader;
      image = new Image;
      reader.onload = function(_file) {
        image.src = _file.target.result;
        image.onload = function() {
          var h, n, s, scaleWidth, t, w;
          w = this.width;
          h = this.height;
          t = file.type;
          n = file.name;
          s = ~~(file.size / 1024) / 1024;
          scaleWidth = settings.thumbnail_size;
          $('.p').append('<div class=\'s-12 m-12 l-12 xs-12\'><div class=\'thumbnail\' style=\'background: #ffffff\'><img class="img-responsive" src=\'' + image.src + '\' /><div class=\'caption\' style=\'position: absolute;right: 10px;top:10px;\'> <h4  style=\'background: black;padding: 4px; color: white\'>' + s.toFixed(2) + ' Mb </h4></div></div> </div> ');
          _this.renderLabelFileName(n, 'success');
        };
        image.onerror = function() {
          alert('Invalid file type: ' + file.type);
          _this.renderLabelFileName(file.name, "error");
          fileinput.val(null);
        };
      };
      reader.readAsDataURL(file);
    },
    renderProfileImage: function(file, fileinput, settings) {
      var _this, image, reader;
      _this = this;
      reader = new FileReader;
      image = new Image;
      reader.onload = function(_file) {
        image.src = _file.target.result;
        image.onload = function() {
          var h, n, s, scaleWidth, t, w;
          w = this.width;
          h = this.height;
          t = file.type;
          n = file.name;
          s = ~~(file.size / 1024) / 1024;
          scaleWidth = settings.thumbnail_size;
          $('.profile-img').attr("src", image.src).css({
            position: 'relative'
          });
          _this.renderLabelFileProfile(n, "success");
          _this.downButton("success");
        };
        image.onerror = function() {
          alert('Invalid file type: ' + file.type);
          _this.renderLabelFileProfile(file.name, file.type);
          _this.downButton("error");
          fileinput.val(null);
        };
      };
      reader.readAsDataURL(file);
    },
    downButton: function(message) {
      var _this, button;
      _this = this;
      button = $('#upload-button');
      button.removeClass("text-info");
      button.removeClass("text-danger");
      if (message === "success") {
        button.removeClass("hidden");
        button.addClass("block");
        return button.val('to download press').addClass("text-info");
      } else {
        button.addClass("hidden");
        button.removeClass("block");
        button.addClass("text-danger");
        button.val('wrong file format');
        return button.bind("click", function(event) {
          event.preventDefault();
          return $(this).unbind(event);
        });
      }
    },
    renderLabelFileName: function(filename, message) {
      var _this, fileLabel;
      _this = this;
      fileLabel = $('.filelabel');
      if (fileLabel.find("span.text-info").length > 0 || fileLabel.find("span.text-danger").length > 0) {
        fileLabel.find("span.text-info").remove();
        fileLabel.find("span.text-danger").remove();
      }
      if (message === "success") {
        return $('.filelabel').append($('<span>').addClass('text-info').css({
          'font-size': '100%',
          'display': 'inline-block',
          'font-weight': 'normal',
          'margin-left': '1em',
          'font-style': 'normal'
        }));
      } else {
        return $('.filelabel').append($('<span>').addClass('text-danger').text(" format is not valid").css({
          'font-size': '100%',
          'display': 'inline-block',
          'font-weight': 'normal',
          'margin-left': '1em',
          'font-style': 'normal'
        }));
      }
    },
    renderLabelFileProfile: function(filename, message) {
      var ImgBlock, _this, fileLabel;
      _this = this;
      fileLabel = $('.label');
      ImgBlock = $('.profile-img');
      if (ImgBlock.next("span.text-info").length > 0 || ImgBlock.next("span.text-danger").length > 0) {
        console.log(ImgBlock.next());
        ImgBlock.next("span.text-info").remove();
        ImgBlock.next("span.text-danger").remove();
      }
      if (message === "success") {
        return ImgBlock.after($('<span>').addClass('text-info').css({
          'font-size': '100%',
          'display': 'inline-block',
          'font-weight': 'normal',
          'margin-left': '1em',
          'font-style': 'normal'
        }));
      } else {
        return ImgBlock.after($('<span>').addClass('text-danger').html("<br/><b>format is not valid </b>").css({
          'font-size': '100%',
          'display': 'inline-block',
          'font-weight': 'normal',
          'margin-left': '1em',
          'font-style': 'normal'
        }));
      }
    },
    initiateInstanceImage: function() {
      var _this, fileinput, settings;
      _this = this;
      fileinput = $('#fileupload').attr('accept', 'image/jpeg,image/png,image/gif');
      settings = {
        thumbnail_size: 460,
        thumbnail_bg_color: '#ddd',
        thumbnail_border: '1px solid #fff',
        thumbnail_shadow: '0 0 0px rgba(0, 0, 0, 0.5)',
        label_text: '',
        warning_message: 'Not an image file.',
        warning_text_color: '#f00',
        input_class: 'custom-file-input button button-primary button-block'
      };
      fileinput.change(function(e) {
        var F, i;
        $('.p').html('');
        if (this.disabled) {
          return alert('File upload not supported!');
        }
        F = this.files;
        if (F && F[0]) {
          i = 0;
          while (i < F.length) {
            if (F[i].type.match('image.*')) {
              _this.renderInstanceImage(F[i], fileinput, settings);
            } else {
              _this.renderLabelFileName(F[i].name, "error");
            }
            i++;
          }
        }
      });
    },
    initiateProfileImage: function() {
      var _this, fileElement, settings;
      _this = this;
      fileElement = $('#file').attr('accept', 'image/jpeg,image/png,image/gif');
      settings = {
        thumbnail_size: 100,
        thumbnail_bg_color: '#ddd',
        thumbnail_border: '3px solid white',
        thumbnail_border_radius: '3px',
        label_text: '',
        warning_message: 'Not an image file.',
        warning_text_color: '#f00',
        input_class: 'custom-file-input button button-primary button-block'
      };
      fileElement.change(function(e) {
        var F, i;
        $('.profile-img-block').html('');
        if (this.disabled) {
          return alert('File upload not supported!');
        }
        F = this.files;
        if (F && F[0]) {
          i = 0;
          while (i < F.length) {
            if (F[i].type.match('image.*')) {
              _this.renderProfileImage(F[i], fileElement, settings);
              _this.renderLabelFileProfile(F[i].name, "success");
            } else {
              _this.renderLabelFileProfile(F[i].name, 'error');
              _this.downButton("error");
              fileElement.val(null);
            }
            i++;
          }
        }
      });
    }
  };

  $.StoreCamp.imageLoad.activate();

}).call(this);

(function() {
  $.StoreCamp.media = {
    options: {
      players: plyr.setup(),
      playerStatus: $('.play-status'),
      mediaItems: $('.media-plyr-item')
    },
    activate: function() {
      var _this;
      _this = this;
      _this.fileSystemEvents();
      if (_this.options.mediaItems.length > 0) {
        _this.mediaEvents();
        _this.reindex(_this.options.mediaItems, _this.options.players);
      }
    },
    mediaEvents: function() {
      var _this;
      _this = this;
      return _this.options.players.forEach(function(player, i, arr) {
        player.on('ready timeupdate pause ended play playing', function(event) {
          var playInstanse;
          switch (event.type) {
            case 'ended':
              if (arr.length - 1 > i) {
                _this.options.players[i + 1].play();
                _this.options.playerStatus.toggle(200);
                _this.options.playerStatus.html('<a href="#"><i class="fa fa-step-forward"></i></a>');
                setTimeout(function() {
                  return _this.options.playerStatus.html('<a onclick="$.StoreCamp.media.pausePlayers()" href="#"><i class="fa fa-pause"></i></a>');
                }, 2000);
              } else {
                _this.options.players[0].play();
                _this.options.playerStatus.toggle(200);
                _this.options.playerStatus.html('<a href="#"><i class="fa  fa-step-forward"></i></a>');
                setTimeout(function() {
                  return _this.options.playerStatus.html('<a onclick="$.StoreCamp.media.pausePlayers()" href="#"><i class="fa fa-pause"></i></a>');
                }, 2000);
              }
              break;
            case 'pause':
              console.log('fuck off');
              _this.options.playerStatus.toggle(200);
              _this.options.playerStatus.html('<a onclick="$.StoreCamp.media.pausePlayers()" href="#"><i class="fa fa-pause"></i></a>');
              break;
            case 'play':
              $('.media-plyr-item').removeClass('playing');
              playInstanse = $(event.target);
              playInstanse.closest('.media-plyr-item').addClass('playing');
          }
        });
      });
    },
    fileSystemEvents: function() {
      var _this;
      _this = this;
      $(".file-item .delete-file").on("click", function(event) {
        var btn, deleteUrl, fileItem, folderBody;
        event.preventDefault();
        btn = $(this);
        deleteUrl = btn.attr('href');
        fileItem = btn.closest('.file-item');
        folderBody = $('#folder-body');
        _this.deleteFile(deleteUrl, fileItem);
        console.log(btn.attr('href'));
      });
      $(".directories .directory-item .delete-file").on("click", function(event) {
        var btn, deleteUrl, fileItem, folderBody;
        event.preventDefault();
        btn = $(this);
        deleteUrl = btn.attr('href');
        fileItem = btn.closest('.directory-item');
        folderBody = $('#folder-body');
        _this.deleteFile(deleteUrl, fileItem);
      });
    },
    reindex: function(mediaItems, players) {
      var _this;
      _this = this;
      [].forEach.call(mediaItems, function(item, i, arr) {
        $(item).attr('data-media-number', i);
      });
      return _this._triggerNewFile(mediaItems, players);
    },
    deleteFile: function(deleteUrl, fileItem) {
      var _this;
      _this = this;
      return $.ajax({
        url: deleteUrl,
        type: 'GET',
        success: function(data) {
          fileItem.remove();
          $.StoreCamp.templates.alert('success', data.title, data.message);
          console.log(data);
        },
        error: function(xhr, textStatus, errorThrown) {
          $.StoreCamp.templates.alert('danger', xhr.statusText, xhr.responseText);
          console.error(xhr);
        }
      }, false);
    },
    pausePlayers: function() {
      var _this, players;
      _this = this;
      players = _this.options.players;
      return players.forEach(function(player, i, arr) {
        player.stop();
        players[i].pause();
        $('.media-plyr-item').removeClass('playing');
      });
    },
    _triggerNewFile: function(mediaItems, players) {
      var _this, playButtons;
      _this = this;
      playButtons = [mediaItems.find('.plyr__controls button[data-plyr="play"]'), $('.plyr .plyr__play-large')];
      playButtons.forEach(function(item, i, arr) {
        return item.on('click', function(event) {
          var audioItem, audioItemClass;
          audioItemClass = $(event.target).closest('.media-plyr-item');
          audioItem = audioItemClass.data('media-number');
          $('.media-plyr-item').removeClass('playing');
          players.forEach(function(player, i, arr) {
            player.pause();
            players[audioItem].play();
            audioItemClass.addClass('playing');
          });
        });
      });
    }
  };

  $.StoreCamp.media.activate();

}).call(this);

(function() {
  $.StoreCamp.templates = {
    options: {
      alertTemplate: function(type, title, message) {
        return "<div class=\"alert alert-" + type + " alert-dismissible\">\n<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>\n<h4>" + title + "</h4>\n" + message + "\n</div>";
      },
      modalTemplate: function(modalId, Message, Header, AriaLabel, Ok, Cancel) {
        return "<div class=\"modal fade\" id=\"" + modalId + "\" tabindex=\"-1\" role=\"dialog\" aria-labelledby=\"" + AriaLabel + "\" aria-hidden=\"true\">\n<div class=\"modal-dialog\"><div class=\"modal-content\"><div class=\"modal-header\">\n<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">&times;</button>\n<h3>" + Header + "</h3></div>\n<div class=\"modal-body\"><p>" + Message + "</p></div><div class=\"modal-footer\">\n<button class=\"btn btn-primary\" data-dismiss=\"ok\">" + Ok + "</button>\n<button class=\"btn btn-default\" data-dismiss=\"modal\">" + Cancel + "</button></div>\n</div></div></div>";
      }
    },
    activate: function() {
      var _this;
      return _this = this;
    },
    alert: function(type, title, message) {
      var _this;
      _this = this;
      return $('#alerts').append(_this.options.alertTemplate(type, title, message));
    },
    modal: function(modalId, Message, Header, btntrigger, AriaLabel, Ok, Cancel) {
      var _this, aria, autoLaunch, cancelText, confirmLink, defaultCallback, genericModal, html, message, okText, title, triggerLink;
      _this = this;
      title = Header != null ? Header : 'Please confirm...';
      message = Message != null ? Message : 'Are you sure?';
      okText = Ok != null ? Ok : 'Ok';
      cancelText = Cancel != null ? Cancel : 'Cancel';
      modalId = '';
      aria = AriaLabel != null ? AriaLabel : modalId;
      autoLaunch = true;
      triggerLink = btntrigger != null ? btntrigger : $('.modal-auto-Trigger');
      html = _this.options.modalTemplate(modalId, message, title, aria, okText, cancelText);
      defaultCallback = function(target) {
        window.location.hash = target.hash;
      };
      if (modalId === '') {
        modalId = 'genericModal' + parseInt(Date.now());
      }
      html = _this.options.modalTemplate(modalId, message, title, AriaLabel, okText, cancelText);
      $('body').append(html);
      genericModal = $('#' + modalId);
      confirmLink = triggerLink;
      if (autoLaunch) {
        genericModal.modal('show');
        defaultCallback(genericModal);
      }
      confirmLink.on('click', function(e) {
        e.preventDefault();
        if (autoLaunch) {
          genericModal.modal('show');
        }
      });
      $('button[data-dismiss="ok"]', genericModal).on('click', function() {
        genericModal.modal('hide');
        defaultCallback(confirmLink);
      });
    }
  };

  $.StoreCamp.templates.activate();

}).call(this);

//# sourceMappingURL=modules.js.map
