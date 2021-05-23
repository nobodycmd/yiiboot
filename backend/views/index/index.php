<?php
/**
[
'操作系统'=>PHP_OS,
'运行环境'=>$_SERVER["SERVER_SOFTWARE"],
'PHP运行方式'=>php_sapi_name(),
'PHP版本'=> PHP_VERSION,
'MYSQL版本'=>$mysql,
'上传附件限制'=>ini_get('upload_max_filesize'),
'执行时间限制'=>ini_get('max_execution_time').' s',
'剩余空间'=>round((@disk_free_space(".") / (1024 * 1024)), 2).' M',
]
 *
 *
 */

?>

<table class="table">
    <?php
    foreach ($aryInfo as $k => $v):
    ?>
    <tr>
        <td><?= $k ?></td>
        <td><?= $v ?></td>
    </tr>
    <?php
    endforeach;
    ?>
</table>
