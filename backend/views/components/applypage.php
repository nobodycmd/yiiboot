
<div class="fixed-bottom-page">

    <?php
    /* @var $thePagination yii\data\Pagination */

    $thePagination = isset($pages) ? $pages : $this->context->pagination;
    if($thePagination){
        echo \yii\widgets\LinkPager::widget([
            'pagination' => $thePagination,
            'firstPageLabel'=>true,
            'lastPageLabel'=>true,
            'maxButtonCount'=>10
        ]);
    }

    ?>

    <!--
    <script>
        var gotopage = function () {
            var r1 = $('.pagination .prev').next().find('a').attr('href');
            var r2 = Number($('.pagination .prev').next().find('a').attr('data-page')) + 1;
            location.href = r1.replace('page='+r2,'page='+$('#gopage').val());
        }
    </script>


    <?php
    if($thePagination):
    ?>
    <div class="jump-page">
        跳转到<input type="text" id="gopage"/>页 <a class="btn btn-success" onclick="gotopage()">跳转</a>
        <span>共<?= $thePagination->totalCount ?>条数据</span>
    </div>
    <?php
    endif;
    ?>
    -->

</div>
</div>