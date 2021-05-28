<?php

/**
 * 省市区三级联动
 * $this->render('/components/area',[
 *   'v1'=>'13',
 *   'v2'=>'1300',
 *   'v3'=>'130001',
 * ])
 */


$provinceID = str_shuffle('abcdefgihkdfsuieoqwix');
$cityID =  str_shuffle('DEabcdefgikflad');
$areaID =  str_shuffle('ABCDEabcdfdjkasljfdsauieqw');
$v1 = isset($v1) ? $v1 : '';
$v2 = isset($v2) ? $v2 : '';
$v3 = isset($v3) ? $v3 : '';
?>


<script>
    var <?=  $provinceID ?>change = function (is_init) {
        $.getJSON('/city/area?parentCode='+$('#<?=  $provinceID ?>').val(), function (result) {
            console.log(result);
            document.getElementById('<?=  $cityID ?>').options.length = 0;
            for(var i=0;i < result.data.length; i++){
                document.getElementById('<?=  $cityID ?>').options[document.getElementById('<?=  $cityID ?>').options.length]
                    = new Option(result.data[i].name,result.data[i].code);
            }
            if(is_init){
                $('#<?=  $cityID ?>').val("<?= $v2 ?>");
                <?=  $cityID ?>change(true);
            }else{
                <?=  $cityID ?>change();
            }
        });
    }

    var <?=  $cityID ?>change = function (is_init) {
        $.getJSON('/city/area?parentCode='+$('#<?=  $cityID ?>').val(), function (result) {
            console.log(result);
            document.getElementById('<?=  $areaID ?>').options.length = 0;
            for(var i=0;i < result.data.length; i++){
                document.getElementById('<?=  $areaID ?>').options[document.getElementById('<?=  $areaID ?>').options.length]
                    = new Option(result.data[i].name,result.data[i].code);
                if(is_init){
                    $('#<?=  $areaID ?>').val("<?= $v3 ?>");
                }
            }
        });
    }

    $(document).ready(function () {
        <?=  $provinceID ?>change(<?= $v1 ? 'true' : '' ?>);
    })
</script>

<select onchange="<?=  $provinceID ?>change()" id="<?=  $provinceID ?>" class="form-control" style="display: inline-block;width:200px;">
    <?php
    $allRegion = \common\models\Region::find()->where([
        'type' => 1
    ])->all();
    foreach ($allRegion as $one):
        ?>
        <option value="<?= $one->code ?>"    <?= $v1 == $one->code ? 'selected' : '' ?> ><?= $one->name ?></option>
        <?php
    endforeach;
    ?>
</select>

<select onchange="<?=  $cityID ?>change()"  name="citycode" id="<?=  $cityID ?>" class="form-control" style="display: inline-block;width:200px;">
</select>

<select name="area"  id="<?=  $areaID ?>" class="form-control" style="display: inline-block;width:200px;display: none">  </select>

