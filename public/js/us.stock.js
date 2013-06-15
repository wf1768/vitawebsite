//系统js库。

//制作的通用alert
openalert = function(text) {
    var html = $(
        '<div id="dialog-message" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">' +
            '<div class="modal-header">' +
                '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>' +
                '<h3 id="myModalLabel">系统提示</h3>' +
            '</div>' +
            '<div class="modal-body">' +
                '<p id="continfo">' + text + '</p>' +
            '</div>' +
            '<div class="modal-footer">' +
                '<button class="btn" data-dismiss="modal" id="closeidnow" aria-hidden="true">关闭</button>' +
            '</div>' +
        '</div>');
    return html.modal()
}

openloading = function() {
    var html = $(
        '<div id="dialog-loading" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">' +

            '<div class="modal-body">' +
            '<img src="../img/loading.gif"><p id="continfo">正在操作，请等待......</p>' +
            '</div>');
    return html.modal()
}

upload_single = function(path,url) {
    var html =
        '<div id="upload-pic-dialog" class="modal hide fade" aria-hidden="true">' +
            '<div class="modal-header">' +
                '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>' +
                '上传图片' +
            '</div>' +
            '<div class="modal-body">' +
                '<div id="filelist" name="filelist" ></div>' +
                '<br />' +
                '<img src="" id="pic" >' +
            '</div>' +
            '<div class="modal-footer">' +
                '<button class="btn" data-dismiss="modal" aria-hidden="true">关闭</button>' +
                '<a href="javascript:;" id="selectpic" class="btn btn-primary">选择图片</a>' +
                '<a href="javascript:;" id="uploadfiles" onclick="" class="btn btn-primary">上传</a>' +
            '</div>' +
        '</div>';

    $('body').append(html);
    var uploader = new plupload.Uploader({
        runtimes : 'html5,flash',
        browse_button : 'selectpic', // 单击时间的id
        max_file_size : '2mb',
        unique_names : true,
        url : path + 'index.php/' + url,
        multiple_queues : false,
        multi_selection : false,
        multipart_params:{},
        flash_swf_url : path + 'plugins/plupload/js/plupload.flash.swf',
        filters : [{title : "图片文件", extensions : "png,jpg,jpeg,gif"}]// 允许的文件后缀
    });
    uploader.bind('UploadProgress', function(up, file) {
        //上传的进度
        $('#' + file.id + " b").html(file.percent + "%");
    });

    uploader.bind('QueueChanged', function(){
        //上传的队列改变 也就是选择文件的完成
    });
    uploader.bind('FilesAdded', function(up, files) {
        $.each(files, function(i, file) {
            $('#filelist').append(
                '<div id="' + file.id + '">' +
                    file.name + ' (' + plupload.formatSize(file.size) + ') <b></b>' +
                    '</div>');
        });

        up.refresh(); // Reposition Flash/Silverlight
    });

    uploader.bind('FileUploaded', function(up, file, response) {
        //上传图片已改名，ajax传回新文件名
        var data = $.parseJSON(response.response);
        $('#pic').attr('src',path + data.newfilename);
    });


    uploader.bind("Error", function(up, err) {
        $('#filelist').append("<div>Error: " + err.code +
            ", Message: " + err.message +
            (err.file ? ", File: " + err.file.name : "") +
            "</div>"
        );

        up.refresh(); // Reposition Flash/Silverlight
        // 上传失败
    });

    $('#uploadfiles').click(function(e) {
        uploader.start();
        e.preventDefault();
    });

    uploader.init();//初始化
    //            uploader.start();// 开始上传 自己定义事件

    $('#upload-pic-dialog').on('hidden', function () {
        window.location.reload();
    })

    return $('#upload-pic-dialog').modal();
}

upload_multi = function(path,url) {

    var html =
        '<div id="upload-dialog" class="modal hide fade" aria-hidden="true">' +
            '<div class="modal-header">' +
                '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>' +
                '上传图片' +
            '</div>' +
            '<div class="modal-body">' +
                '<div style="width: 100%;height:90%;">' +
                    '<form id="upload-form" action="" method="post">' +
                        '<div id="uploader" style="width: 100%;height: 100%">' +
                            '<p>您的浏览器未安装 Flash, Silverlight, Gears, BrowserPlus 或者支持 HTML5 .</p>' +
                        '</div>' +
                    '</form>' +
                '</div>' +
            '</div>' +
            '<div class="modal-footer">' +
                '<button class="btn" data-dismiss="modal" aria-hidden="true">关闭</button>' +
            '</div>' +
        '</div>';

    $('body').append(html);

    $("#uploader").pluploadQueue({
        runtimes : 'html5,flash,html4,gears',
        browse_button : 'selectfile',
        max_file_size : '50mb',
        chunk_size: '2mb',
        url : path + 'index.php/' + url,
        unique_names : true,
        flash_swf_url : path + 'plugins/plupload/js/plupload.flash.swf',
        filters : [
            {
                title : "图片文件",
                extensions : "png,jpg,jpeg,gif"
            }
        ]
    });
    // Client side form validation
    $('#upload-form').submit(function(e) {
        var uploader = $('#uploader').pluploadQueue();
        if (uploader.files.length > 0) {
            uploader.bind('StateChanged', function() {
                if (uploader.files.length === (uploader.total.uploaded + uploader.total.failed)) {
                    $('#upload-form')[0].submit();
                }
            });
            uploader.start();
        } else {
            openalert('请先上传图片!');
        }
        return false;
    });

    $('#upload-dialog').on('hidden', function () {
        window.location.reload();
    });

    return $('#upload-dialog').modal();
}

/**
 * input 只能输入数字
 * @param e
 */
function isnumber(e) {
    var k = window.event ? e.keyCode : e.which;
    if (((k >= 48) && (k <= 57)) || k == 8 || k == 0 ) {
    } else {
        if (window.event) {
            window.event.returnValue = false;
        }
        else {
            e.preventDefault(); //for firefox
        }
    }
}

/**
 * input 只能输入数字+小数点
 * @param e
 */
function isfloat(e) {
    var k = window.event ? e.keyCode : e.which;
    if (((k >= 48) && (k <= 57)) || k == 8 || k == 0 || k == 46) {
    } else {
        if (window.event) {
            window.event.returnValue = false;
        }
        else {
            e.preventDefault(); //for firefox
        }
    }
}