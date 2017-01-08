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
      _this.mediaEvents();
      _this.reindex(_this.options.mediaItems, _this.options.players);
    },
    mediaEvents: function() {
      var _this;
      _this = this;
      return _this.options.players.forEach(function(player, i, arr) {
        player.on('ready timeupdate pause ended playing', function(event) {
          switch (event.type) {
            case 'ended':
              if (arr.length - 1 > i) {
                _this.options.players[i + 1].play();
                _this.options.playerStatus.toggle(2000);
                _this.options.playerStatus.html('<i class="fa  fa-step-forward"></i>');
              } else {
                _this.options.players[0].play();
                _this.options.playerStatus.toggle(2000);
                _this.options.playerStatus.html('<i class="fa  fa-step-forward"></i>');
              }
              break;
            case 'pause':
              console.log('fuck off');
              _this.options.playerStatus.toggle(2000);
              _this.options.playerStatus.html('<i class="fa fa-pause"></i>');
          }
        });
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
    _triggerNewFile: function(mediaItems, players) {
      var _this;
      _this = this;
      return mediaItems.find('.plyr__controls button[data-plyr="play"]').on('click', function(event) {
        var audioItem;
        audioItem = $(event.target).closest('.media-plyr-item').data('media-number');
        players.forEach(function(player, i, arr) {
          player.stop();
          players[audioItem].play();
        });
      });
    }
  };

  $.StoreCamp.media.activate();

}).call(this);

//# sourceMappingURL=modules.js.map
