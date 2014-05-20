
<!--header start-->
<header class="header white-bg">
    <div class="sidebar-toggle-box">
        <div data-original-title="Toggle Navigation" data-placement="right" class="icon-reorder tooltips"></div>
    </div>
    <!--logo start-->
    <a href="index.html" class="logo">Flat<span>lab</span></a>

    <div class="top-nav ">
        <!--search & user info start-->
        <ul class="nav pull-right top-menu">
            <li>
                <input type="text" class="form-control search" placeholder="Search">
            </li>
            <!-- user login dropdown start-->
            <li class="dropdown">
                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                    <img alt="" src="img/avatar1_small.jpg">
                    <span class="username">Jhon Doue</span>
                    <b class="caret"></b>
                </a>
                <ul class="dropdown-menu extended logout">
                    <div class="log-arrow-up"></div>
                    <li><a href="#"><i class=" icon-suitcase"></i> <?= __('Perfil'); ?></a></li>
                    <li><a href="#"><i class="icon-cog"></i> <?= __('Configurações'); ?></a></li>
                    <li><a href="#"><i class="icon-bell-alt"></i> <?= __('Notificações'); ?></a></li>
                    <li><?= $this->Html->link('<i class="icon-key"></i>' . __('Sair'),array(
                                        'controller' => 'users',
                                        'action' =>'logout'),
                                        array('escape'=>false))?></li>
                        
                </ul>
            </li>
            <!-- user login dropdown end -->
        </ul>
        <!--search & user info end-->
    </div>
</header>
<!--header end-->