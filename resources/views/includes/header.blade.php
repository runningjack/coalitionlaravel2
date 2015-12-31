<?php
/**
 * Created by PhpStorm.
 * User: Amedora
 * Date: 10/12/15
 * Time: 10:04 AM
 */?>


<header class="main-header">
    <!-- Logo -->
    <a href="../../index2.html" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>A</b>LT</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Coalition </b>App</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- Messages: style can be found in dropdown.less-->
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <!--<img src="" class="user-image" alt="User Image">-->
                        <i class="fa fa-user"></i>
                        <span class="hidden-xs"><?php
                            $user = \App\User::find(\Illuminate\Support\Facades\Auth::user()->id);
                            echo $user->firstname;
                            ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header" style="background-color: #3c8dbc;">
                           <!-- <img src="" class="img-circle" alt="User Image">-->
                            <i class="fa fa-user fa-4x"></i>
                            <p>
                                <?php
                                    //$user = \Toddish\Verify\Models\User::find(\Illuminate\Support\Facades\Auth::user()->id);
                                echo $user->firstname ." ". $user->lastname;
                                ?>

                                <small>Member since  {{date("M. Y")}}</small>
                            </p>
                        </li>
                        <!-- Menu Body -->

                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="#" class="btn btn-default btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                                <a href="{{url()}}/auth/logout" class="btn btn-default btn-flat">Sign out</a>
                            </div>
                        </li>
                    </ul>
                </li>
                <!-- Control Sidebar Toggle Button -->
                <li>
                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                </li>
            </ul>
        </div>
    </nav>
</header>
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li><a href="{{url()}}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>


            <li class="treeview">
                <a href="#">
                    <i class="fa fa-building"></i> <span>Companies</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{url()}}/company/index"><i class="fa fa-circle-o"></i>Listing</a></li>
                    <!--<li><a href="{{url()}}/company/branches"><i class="fa fa-circle-o"></i>Branches</a></li>-->
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-cog"></i> <span>Setting</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{url()}}/settings/paper"><i class="fa fa-paperclip"></i>Print Papers</a></li>
                    <li><a href="{{url()}}/settings/jobs"><i class="fa fa-print"></i>Jobs</a></li>
                    <li><a href="{{url()}}/settings/price"><i class="fa fa-money"></i>Job Prices</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-cog"></i> <span>Administrator</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{url()}}/administrators/index"><i class="fa fa-group"></i>Users</a></li>
                    <li><a href="{{url()}}/privileges/index"><i class="fa fa-lock"></i>Roles and Privileges</a></li>
                </ul>
            </li>

        </ul>
    </section>
    <!-- /.sidebar -->
</aside>