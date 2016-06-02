;
(function () {
    window.URL = window.URL || window.webkitURL;
    var userAgent = navigator.userAgent;

    function Lrz(file, options, callback) {
        this.file = file;
        this.callback = callback;
        this.defaults = {quality: 7};

        if (callback) {
            for (var p in options) {
                this.defaults[p] = options[p];
            }
            if (this.defaults.quality > 10) this.defaults.quality = 10;
        } else {
            this.callback = options;
        }

        this.results = {
            blob: null,
            origin: null,
            base64: null
        };

        this.init();
    }

    Lrz.prototype = {
        constructor: Lrz,

        init: function () {
            var that = this;

            that.create(that.file, that.callback);
        },

        create: function (file, callback) {
            var that = this,
                img = new Image(),
                results = that.results,
                blob = URL.createObjectURL(file);

            img.onload = function () {
                var resize = that.resize(this);

                var canvas = document.createElement('canvas'), ctx;
                canvas.width = resize.w;
                canvas.height = resize.h;
                ctx = canvas.getContext('2d');

                var mpImg = new MegaPixImage(img);
                EXIF.getData(img, function () {
                    mpImg.render(canvas, {
                        width: canvas.width,
                        height: canvas.height,
                        orientation: EXIF.getTag(this, "Orientation")
                    });

                    ctx.fillStyle = '#fff';
                    ctx.fillRect(0, 0, canvas.width, canvas.height);
                    
                    results.blob = blob;
                    results.origin = file;
                    var re;
                    if(img.width <img.height){
                       re = img.width;
                    }else{
                       re = img.height;
                    }
                    ctx.drawImage(img,0, 0, re,re, 0, 0, resize.w, resize.h);

                    if (/Android/i.test(userAgent)) {
                        try {
                            var encoder = new JPEGEncoder();

                            results.base64 = encoder.encode(ctx.getImageData(0, 0, canvas.width, canvas.height), that.defaults.quality * 100);
                        } catch (_error) {
                            alert('未引用mobile补丁，无法生成图片。');
                        }
                    }

                    // 其他情况&IOS
                    else {
                        results.base64 = canvas.toDataURL('image/jpeg', that.defaults.quality);
                    }

                    // 执行回调
                    callback(results);
                });
            };

            img.src = blob;
        },

        resize: function (img) {
            var w = this.defaults.width,
                h = this.defaults.height,
                scale = img.width / img.height,
                ret = {w: img.width, h: img.height};

            if (w & h) {
                ret.w = w;
                ret.h = h;
            }
            else if (w) {
                ret.w = w;
                ret.h = Math.ceil(w / scale);
            }

            else if (h) {
                ret.w = Math.ceil(h * scale);
                ret.h = h;
            }

            return ret;
        }
    };
    window.lrz = function (file, options, callback) {
        return new Lrz(file, options, callback);
    };
})();
