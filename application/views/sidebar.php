<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
        <div class="pull-left image">
            <img src="<?= base_url('assets/img/user2-160x160.jpg') ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
            <p><?= sprintf("%s %s", user('firstname'), user('lastname')) ?></p>
            <!-- Status -->
            <a href="#"><i class="fa fa-user"></i> <?= user('login_username')?></a>
        </div>
        </div>
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <?php $visited = $this->uri->segment(1); ?>
            <li class="header">NAVIGATION</li>
            <li class="<?= set_active_nav('home') ?>">
                <a href="<?= base_url()?>"><i class="fa fa-home"></i> <span>Home</span></a>
            </li>
            

            <?php $creditorsVisited = in_array($visited, ['creditors', 'creditor-types'])?>
            <li class="treeview <?= $creditorsVisited ? 'active' : '' ?>">
              <a href="#">
                <i class="fa fa-info-circle"></i> <span>Creditors</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class="<?= set_active_nav('creditors')?>">
                    <a href="<?= base_url('creditors')?>"><i class="fa fa-circle-o"></i> Manage</a>
                </li>
                <li class="<?= set_active_nav('creditor-types') ?>">
                    <a href="<?= base_url('creditor-types')?>"><i class="fa fa-circle-o"></i> Types</a>
                </li>
              </ul>
            </li>

            <?php $pumpsVisited = in_array($visited, ['pumps', 'fuel-types'])?>
            <li class="treeview <?= $pumpsVisited ? 'active' : '' ?>">
              <a href="#">
                <i class="fa fa-sitemap"></i> <span>Pumps</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class="<?= set_active_nav('pumps')?>">
                    <a href="<?= base_url('pumps')?>"><i class="fa fa-circle-o"></i> Manage</a>
                </li>
                <li class="<?= set_active_nav('fuel-types') ?>">
                    <a href="<?= base_url('fuel-types')?>"><i class="fa fa-circle-o"></i> Fuel Types</a>
                </li>
              </ul>
            </li>

            <li class="<?= set_active_nav('users') ?>">
                <a href="<?= base_url('users')?>"><i class="fa fa-users"></i> <span>Users</span></a>
            </li>
            

            
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>