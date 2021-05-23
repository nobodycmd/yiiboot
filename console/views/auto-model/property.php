<?php
foreach($columns as $oneColumn) {?>
* @property  <?= $oneColumn['DATA_TYPE'] ?>  <?= $oneColumn['COLUMN_NAME'] ?>  <?= $oneColumn['COLUMN_COMMENT'] ?><?php
    echo PHP_EOL;
}?>