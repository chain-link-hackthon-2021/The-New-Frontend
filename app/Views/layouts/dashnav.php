<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <a href="/" class="brand-link">
        <img src="/images/cube.png" alt="AnyBuy Logo" class="brand-image img-circle elevation-3" style="opacity: .8 ">
        <span class="brand-text font-weight-light">AnyBuy</span>
    </a>


    <div class="sidebar">

        <?php
        $uri = pathinfo(basename($_SERVER['PHP_SELF']), PATHINFO_FILENAME);
        ?>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-link">SHOP NAVIGATION</li>
                <li class="nav-item">
                    <a href="/Shop/<?= $name; ?>/Dashboard" class="nav-link <?php if ($uri == 'Dashboard') {
                                                                                echo "active";
                                                                            } ?>">
                        <i class="fas fa-tachometer-alt nav-icon"></i>
                        <p>Dashboard</p>
                        <span class="pull-right-container">
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/Shop/<?= $name; ?>/Orders" class="nav-link <?php if ($uri == 'Orders') {
                                                                                echo "active";
                                                                            } ?> ">
                        <i class="fas fa-tags nav-icon"></i>
                        <p>Orders</p>
                        <span class="pull-right-container">
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/Shop/<?= $name; ?>/Products" class="nav-link ">
                        <i class="fas fa-shopping-basket nav-icon"></i>
                        <p>Products</p>
                        <span class="pull-right-container">
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/Licensing/<?= $name; ?>/Projects" class="nav-link ">
                        <i class="fas fa-key nav-icon"></i>
                        <p>Licensing</p>
                        <span class="pull-right-container">
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/Shop/<?= $name; ?>/Coupons" class="nav-link ">
                        <i class="fas fa-cut nav-icon"></i>
                        <p>Coupons</p>
                        <span class="pull-right-container">
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/Shop/<?= $name; ?>/Feedback" class="nav-link ">
                        <i class="far fa-comment-alt nav-icon"></i>
                        <p>Feedback</p>
                        <span class="pull-right-container">
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/Shop/<?= $name; ?>/Tickets" class="nav-link ">
                        <i class="fas fa-ambulance nav-icon"></i>
                        <p>Tickets</p>
                        <span class="pull-right-container">
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/Shop/<?= $name; ?>/BlackList" class="nav-link ">
                        <i class="fas fa-ban nav-icon"></i>
                        <p>BlackList</p>
                        <span class="pull-right-container">
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/Shop/<?= $name; ?>/Members" class="nav-link ">
                        <i class="fas fa-users nav-icon"></i>
                        <p>Members</p>
                        <span class="pull-right-container">
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/Shop/@<?= $name; ?>" class="nav-link ">
                        <i class="fas fa-street-view nav-icon"></i>
                        <p>Store Front</p>
                        <span class="pull-right-container">
                        </span>
                    </a>
                </li>
                <li class="nav-item has-treeview  ">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon fas fa-tools"></i>
                        <p>Settings <i class="right fa fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"><a href="/Shop/<?= $name; ?>/Settings" class="nav-link ">General</a></li>
                        <li class="nav-item"><a href="/Shop/<?= $name; ?>/CryptoCurrencySettings" class="nav-link ">Cryptocurrency</a></li>
                        <li class="nav-item"><a href="/Shop/<?= $name; ?>/Design" class="nav-link ">Design</a></li>
                    </ul>
                </li>
                <li class="nav-item has-treeview  ">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon fas fa-code"></i>
                        <p>Developer <i class="right fa fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"><a href="/Shop/<?= $name; ?>/Webhooks" class="nav-link ">Webhooks</a></li>
                        <li class="nav-item"><a href="/Developers/Integrations" class="nav-link ">Integrations</a></li>
                        <li class="nav-item"><a href="https://documenter.getpostman.com/view/5150816/SVtYS6dX?version=latest" class="nav-link ">Api Docs</a></li>
                    </ul>
                </li>
            </ul>

        </nav>
    </div>

</aside>