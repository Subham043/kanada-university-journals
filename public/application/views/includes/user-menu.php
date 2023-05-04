
            <!-- ========== App Menu ========== -->
            <div class="app-menu navbar-menu">
                <!-- LOGO -->
                <div class="navbar-brand-box">
                    <!-- Dark Logo-->
                    <a href="<?php echo base_url(); ?>" class="logo logo-dark">
                        <span class="logo-sm">
                            <img src="<?php echo base_url('assets/admin/images/logo.png'); ?>" alt="" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="<?php echo base_url('assets/admin/images/logo.png'); ?>" alt="" height="17">
                        </span>
                    </a>
                    <!-- Light Logo-->
                    <a href="<?php echo base_url(); ?>" class="logo logo-light">
                        <span class="logo-sm">
                            <img src="<?php echo base_url('assets/admin/images/logo.png'); ?>" alt="" height="30">
                        </span>
                        <span class="logo-lg">
                            <img src="<?php echo base_url('assets/admin/images/logo.png') ; ?>" alt="" height="60">
                        </span>
                    </a>
                    <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
                        <i class="ri-record-circle-line"></i>
                    </button>
                </div>

                <div id="scrollbar">
                    <div class="container-fluid">

                        <div id="two-column-menu">
                        </div>
                        <ul class="navbar-nav" id="navbar-nav">
                            <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                            <li class="nav-item">
                                <a class="nav-link menu-link <?php echo strpos(current_url(),'teacher') !== false ? 'active' : ''; ?>" href="<?php echo base_url('teacher'); ?>">
                                    <i class="ri-file-user-fill"></i> <span data-key="t-widgets">Teachers</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link menu-link <?php echo strpos(current_url(),'book') !== false ? 'active' : ''; ?>" href="<?php echo base_url('book'); ?>">
                                    <i class="ri-contacts-book-2-line"></i> <span data-key="t-widgets">Books</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link menu-link <?php echo strpos(current_url(),'book-article') !== false ? 'active' : ''; ?>" href="<?php echo base_url('book-article'); ?>">
                                    <i class="ri-article-fill"></i> <span data-key="t-widgets">Book Articles</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link menu-link <?php echo strpos(current_url(),'journal') !== false ? 'active' : ''; ?>" href="<?php echo base_url('journal'); ?>">
                                    <i class="ri-newspaper-line"></i> <span data-key="t-widgets">Journal</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link menu-link <?php echo strpos(current_url(),'journal-article') !== false ? 'active' : ''; ?>" href="<?php echo base_url('journal-article'); ?>">
                                    <i class="ri-article-fill"></i> <span data-key="t-widgets">Journal Articles</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link menu-link <?php echo strpos(current_url(),'conference-proceedings') !== false ? 'active' : ''; ?>" href="<?php echo base_url('conference-proceedings'); ?>">
                                    <i class="ri-account-pin-box-fill"></i> <span data-key="t-widgets">Conference Proceedings</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- Sidebar -->
                </div>
            </div>
            <!-- Left Sidebar End -->
            <!-- Vertical Overlay-->
            <div class="vertical-overlay"></div>
