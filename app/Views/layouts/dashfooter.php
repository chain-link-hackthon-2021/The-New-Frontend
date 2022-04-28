<footer class="main-footer">
                <div class="row">
                    <div class="col-lg-4 col-md-12">
                        <div class="d-none d-lg-block">
                            <a href="/Terms">Terms</a> |
                            <a href="/Privacy">Privacy</a> |
                            <a href="/Cookies">Cookies</a> |
                            <a href="/Aup">Acceptable Use</a>
                        </div>
                        <div class="d-lg-none d-md-block text-center">
                            <a href="/Terms">Terms</a> |
                            <a href="/Privacy">Privacy</a> |
                            <a href="/Cookies">Cookies</a> |
                            <a href="/Aup">Acceptable Use</a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 text-center">
                        <strong>Copyright © 2020 <a href="https://AnyBuy.io">AnyBuy.IO</a>.</strong> All rights reserved.
                    </div>
                    <div class="col-lg-4 col-md-12 text-right">
                        <div class="d-none d-lg-block">AnyBuy.IO</div>
                    </div>
                </div>
            </footer>

            <aside class="control-sidebar control-sidebar">
                <div class="tabbable full-width-tabs">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <div class="sidebar">
                                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                                    <div class="image">
                                        <img src="<?= $user[0]['display_picture']; ?>" class="img-circle elevation-2" alt="User Image">
                                    </div>
                                    <div class="info">
                                        <a href="#" class="d-block"><?= ucfirst($user[0]['username']); ?></a>
                                    </div>
                                </div>
                                <nav class="mt-2">
                                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                                        <li class="nav-item">
                                            <a class="nav-link " id="sidebarlink" href="/Shop">
                                                <i class="fa fa-store-alt nav-icon"></i>
                                                <p>Manage Shops</p>
                                                <span class="pull-right-container"></span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link " id="sidebarlink" href="/Manage">
                                                <i class="fa fa-user-cog nav-icon"></i>
                                                <p>Profile Settings</p>
                                                <span class="pull-right-container"></span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link " id="sidebarlink" href="/Account/Logout">
                                                <i class="fa fa-sign-out-alt nav-icon"></i>
                                                <p>Sign Out</p>
                                                <span class="pull-right-container"></span>
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </aside>

            <div class="control-sidebar-bg"></div>
        </div>

        <script>
            $(document).ready(function () {
                $("#btn-sign-out").click(function () {
                    $("#form-sign-out").submit();
                });
            });
            //useSubmitClass();
            useDeleteConfirmation();
            $(document).ready(function () {
                var isTopNavLayout = $('body').hasClass('layout-top-nav');
                if (!isTopNavLayout) {
                    $('#sidebar-nav-bars').show();
                } else {
                    $('#header-logo').show();
                }
            });
        </script>
    </body>
</html>