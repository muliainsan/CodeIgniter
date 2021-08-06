    <!-- Sidebar -->
    <div class="sidebar">


        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul id="menu" class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item  <?php if ($title == "User" || $title == "Dashboard") {
                                            echo 'menu-open';
                                        } ?>">
                    <a href="#" class="nav-link <?php if ($title == "User" || $title == "Dashboard") {
                                                    echo 'active';
                                                } ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Admin Menu
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo base_url('home/Menu') ?>" class="nav-link <?php if ($title == "Dashboard") {
                                                                                                echo 'active';
                                                                                            } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo base_url('User') ?>" class="nav-link <?php if ($title == "User") {
                                                                                            echo 'active';
                                                                                        } ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>User</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="<?php echo base_url('Category') ?>" class="nav-link <?php if ($title == "Categories") {
                                                                                        echo 'active';
                                                                                    } ?>">
                        <i class="nav-icon fa fa-list-ol"></i>
                        <p>
                            Category
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo base_url('Menu') ?>" class="nav-link  <?php if ($title == "Menu") {
                                                                                    echo 'active';
                                                                                } ?>">
                        <i class="nav-icon fa fa-list" aria-hidden="true"></i>
                        <p>
                            Menu
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo base_url('order') ?>" class="nav-link <?php if ($title == "Orders") {
                                                                                    echo 'active';
                                                                                } ?>">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Order
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
    </aside>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0"><?php echo $title; ?></h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Menu</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">