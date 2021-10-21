<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p><?= Yii::$app->getUser()->getIdentity()?Yii::$app->getUser()->getIdentity()->username:'游客' ?></p>

<!--                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>-->
            </div>
        </div>

        <!-- search form -->
<!--        <form action="#" method="get" class="sidebar-form">-->
<!--            <div class="input-group">-->
<!--                <input type="text" name="q" class="form-control" placeholder="Search..."/>-->
<!--              <span class="input-group-btn">-->
<!--                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>-->
<!--                </button>-->
<!--              </span>-->
<!--            </div>-->
<!--        </form>-->
        <!-- /.search form -->

        <ul class="sidebar-menu" data-widget="tree" >
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-gears"></i> <span>静态MENU</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="treeview">
                        <a href="###">系统初始化权限配置后可去掉这个静态MENU</a>
                        <ul class="treeview-menu">
                            <li class="treeview">
                                <a href="/admin/role">
                                    <i class="fa fa-circle-o"></i> 权限 <i class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="/admin/route"><i class="fa fa-circle-o"></i> 路由</a></li>
                                    <li><a href="/admin/permission"><i class="fa fa-circle-o"></i> 权限</a></li>
                                    <li><a href="/admin/role"><i class="fa fa-circle-o"></i> 角色</a></li>
                                    <li><a href="/admin/assignment"><i class="fa fa-circle-o"></i> 分配</a></li>
                                    <li><a href="/admin/menu"><i class="fa fa-circle-o"></i> 菜单</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
        </ul>

        <?php
        //可选的自定义回掉
        $callback = function($menu){
            $data = json_decode($menu['data'], true);
            $items = $menu['children'];
            $return = [
                'label' => $menu['name'],
                'url' => [$menu['route']],
            ];
            //后台填入的options JSON格式数据
            if ($data) {
                //visible
                isset($data['visible']) && $return['visible'] = $data['visible'];
                //icon
                isset($data['icon']) && $data['icon'] && $return['icon'] = $data['icon'];
                //other attribute e.g. class...
                $return['options'] = $data;
            }
            //没配置图标的显示默认图标，默认图标大家可以自己随便修改
            (!isset($return['icon']) || !$return['icon']) && $return['icon'] = 'circle-o';
            $items && $return['items'] = $items;

            return $return;
        };

        $items = \mdm\admin\components\MenuHelper::getAssignedMenu(Yii::$app->user->id,null,$callback);
        ?>

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => $items,
            ]
        ) ?>

    </section>

</aside>
