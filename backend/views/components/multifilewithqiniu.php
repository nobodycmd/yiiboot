
<?php

/*
使用方法

单个文件

 <?= $this->render('/components/multifilewithqiniu',[
    'name' => 'apk',
    'value' =>  ''
]) ?>


<?= $this->render('/components/multifilewithqiniu',[
    'name' => 'apk',
    'value' =>  'http://1.jpg'
]) ?>


多个文件

<?= $this->render('/components/multifilewithqiniu',[
    'name' => 'images',
    'value' =>  []
]) ?>

<?= $this->render('/components/multifilewithqiniu',[
    'name' => 'images',
    'value' =>  ['http://1.jpg','http://2.jpg']
]) ?>
 *
 *
 */


?>


<script src="https://unpkg.com/qiniu-js@2.5.3/dist/qiniu.min.js"></script>
<script src="https://cdn.bootcss.com/blueimp-md5/2.10.0/js/md5.js"></script>



<script>
    /**
     * @fileDom such as document.getElementById('xxxx')
     * @onuploading  callback
     * @onfinish  callback
     */
    function uploadWithFileDom(fileDom,onuploading,onfinish) {
        for(var i=0;i<fileDom.files.length; i++){
            uploadWithSDK(i + 1,fileDom.files[i], onuploading, onfinish);
        }
    }


    //https://developer.mozilla.org/en-US/docs/Web/API/XMLHttpRequest/Using_XMLHttpRequest
    //https://developer.qiniu.com/kodo/sdk/1283/javascript

    /**
     * @param fileIndex 第几个文件这是，从数字1开始算
     * @param file 文件对象本身
     * @param onuploading function(fileIndex,int percent)
     * @param onfinish function(fileIndex, {key:'',bucket:'',....})
     */
    function uploadWithSDK(fileIndex, file, onuploading, onfinish) {

        var self = this;

        // progress on transfers from the server to the client (downloads)
        function updateProgress(oEvent) {
            if (oEvent.lengthComputable) {
                var percentComplete = oEvent.loaded / oEvent.total * 100;
                // ...
            } else {
                // Unable to compute progress information since the total size is unknown
            }
        }

        function transferCompleteForGotToken(evt) {
            //response type is text,  this.responseText
            console.log("The transfer is complete." + this.responseText);
            var token = this.responseText;
            var config = {
                useCdnDomain: false,
                disableStatisticsReport: false,
                retryCount: 6,
                //region: qiniu.region.z2 //选择上传域名区域；当为 null 或 undefined 时，自动分析上传域名区域
                region: null,
            };
            var putExtra = {
                fname: "",
                params: {},
                mimeType: null
            };


            var file_ext = '';
            var dot_index = file.name.lastIndexOf('.');
            if (dot_index > 0) {
                file_ext = file.name.substr(dot_index);
            }
            console.log(file_ext);
            var key = md5(new Date().toDateString() + Math.random().toString() + file.name) + file_ext;
            putExtra.params["x:name"] = key.split(".")[0];

            // 设置next,error,complete对应的操作，分别处理相应的进度信息，错误信息，以及完成后的操作
            var error = function (err) {
                console.log(err);
                alert("上传出错")
            };

            var complete = function (res) {
                //res.hash
                //res.bucket
                //res.key
                //domain
                onfinish(fileIndex, res);
            };

            var next = function (response) {
                var chunks = response.chunks || [];
                var total = response.total;
                // 这里对每个chunk更新进度，并记录已经更新好的避免重复更新，同时对未开始更新的跳过
                for (var i = 0; i < chunks.length; i++) {
                    if (chunks[i].percent === 0) {
                        continue;
                    }
                    if (chunks[i].percent === 100) {
                        continue;
                    }
                }
                //total.percent
                onuploading(fileIndex, total.percent);
            };

            var subObject = {
                next: next,
                error: error,
                complete: complete
            };
            var subscription;
            // 调用sdk上传接口获得相应的observable，控制上传和暂停
            observable = qiniu.upload(file, key, token, putExtra, config);

            self.start = function () {
                subscription = observable.subscribe(subObject);
            }

            self.stop = function () {
                subscription.unsubscribe();
            }

            self.start();
        }

        function transferFailed(evt) {
            console.log("An error occurred while transferring the file.");
        }

        function transferCanceled(evt) {
            console.log("The transfer has been canceled by the user.");
        }


        var oReq = new XMLHttpRequest();
        //oReq.addEventListener("progress", updateProgress);
        oReq.addEventListener("load", transferCompleteForGotToken);
        oReq.addEventListener("error", transferFailed);
        //oReq.addEventListener("abort", transferCanceled);
        oReq.open('get', '/qiniu/get-upload-token'); //echo $token;exit; 返回一个上传TOKEN即可
        oReq.send();

    }

</script>


<script>
    String.prototype.endWith=function(str){
        if(str==null||str==""||this.length==0||str.length>this.length)
            return false;
        if(this.substring(this.length-str.length)==str)
            return true;
        else
            return false;
        return true;
    }

    String.prototype.startWith=function(str){
        if(str==null||str==""||this.length==0||str.length>this.length)
            return false;
        if(this.substr(0,str.length)==str)
            return true;
        else
            return false;
        return true;
    }
</script>

<script type="text/javascript">
    function allowDrop(ev)
    {
        ev.preventDefault();
    }

    var srcdiv = null;
    function drag(ev,divdom)
    {
        srcdiv=divdom;
        ev.dataTransfer.setData("text/html",divdom.innerHTML);
    }

    function drop(ev,divdom)
    {
        ev.preventDefault();
        if(srcdiv != divdom){
            srcdiv.innerHTML = divdom.innerHTML;
            divdom.innerHTML=ev.dataTransfer.getData("text/html");
        }
    }
</script>

<?php
// 参数2个,都为可选参数
// $name 上传文件地址的hidden input，多个文件的话，名称应该是 filesrc[] 这种带[] 的
// $value 以前上传的文件地址，单个字符串或者字符串数组

if(isset($name) && $name){
    $filedName = $name;
}else{
    if(isset($onlyone)){
        $filedName = 'file';
    }else {
        $filedName = 'files[]';
    }
}

if(isset($label) == false){
    $label = '云端文件';
}

//if(isset($value) == false){
//    $value = [];
//}
//if(is_array($value) && count($value)==1 && isset($value[0]) && $value[0]==false){
//    $value=[];
//}

//随机的一个上传文件的FILE INPUT
$randomUploadName = str_shuffle('abcdfdjkeruiqpodfakljxABCADAE');
?>
<script>
    var <?= $randomUploadName ?>UploadedCount = 0;
     function <?= $randomUploadName ?>Run() {
         var fileCount = document.getElementById('<?= $randomUploadName ?>').files.length;
         uploadWithFileDom(document.getElementById('<?= $randomUploadName ?>'), function (fileIndex, percent) {
             document.getElementById("<?= $randomUploadName?>info").innerHTML = '第' + fileIndex + '个文件正在上传，完成' + percent + '%';
         }, function (fileIndex, res) {
             if (++<?= $randomUploadName ?>UploadedCount == fileCount) {
                 document.getElementById("<?= $randomUploadName?>info").innerHTML = '全部上传完毕';
                 document.getElementById("<?= $randomUploadName?>").value = ''; //清空值，以支持同一文件再次上传的情况
             }

             var is_img = false;
             var is_video = false;

             if (res.key.endWith('jpg') || res.key.endWith('jpeg') || res.key.endWith('png') || res.key.endWith('gif')) {
                 is_img = true;
             }
             if (res.key.endWith('mp4')) {
                 is_video = true;
             }

             var input = '<div   style="cursor: move;display: inline-block;"  class="panel panel-default"  ondrop="drop(event,this)" ondragover="allowDrop(event)" draggable="true" ondragstart="drag(event, this)" >';
             input += '<div class="panel-heading">可拖动交换位置</div>';
             input += '<div class="panel-body" style="text-align: center;">';

             var src = '<?= \app\service\QiniuService::$domain ?>' + res.key;

             input += '<a  title="点我看源文件" target="_blank" href="' + src + '"> ';
             input += src;
             input += '</a>'


             input += ' <input type="hidden" name="<?= $filedName ?>"  value="' + src + '" />  ';
             input += '</div>';
             input += '<div class="panel-footer" style="text-align: center;"><a onclick="$(this).parent().parent().remove()">删除</a></div>';
             input += '</div>';
             document.getElementById("<?= $randomUploadName?>data").innerHTML += input;
         })
     }
</script>

<br>

<div class="row">
    <div class="col-sm-12">


            <div id="<?= $randomUploadName ?>wrap-for-upload" class="form-group field-zb_new_head_decoration_goods-online">
                <label class=" col-md-2 control-label " ><?= $label?>：</label>
                <div class="col-md-10">
                    <input class="col-md-offset-1  col-sm-3" type="file" <?= is_array($value) === false ? "" : "multiple"  ?> id="<?= $randomUploadName ?>" onchange="<?= $randomUploadName ?>Run()" />
                    <div id="<?= $randomUploadName ?>data" class="col-sm-12" >
                        <?php
                        if($value == false){
                            $value = [];
                        }else {
                            if (is_string($value)) {
                                $value = [$value];
                            }
                        }
                        foreach ($value as $src){
                            $srcString = strtolower($src);
                            ?>
                            <div>
                                <input type="hidden" name="<?= $filedName ?>"  value="<?= $src ?>" />
                                <a   target="_blank" href="<?= $src ?>">   <?= $src ?></a>
                                <a onclick="$(this).parent().remove()">删除</a>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                    <div id="<?= $randomUploadName?>info"> </div>
                    <div class="help-block"></div>
                </div>
            </div>


    </div>

</div>

<br>