
            <!-- ========== App Menu ========== -->
            <div class="app-menu navbar-menu">
                <!-- LOGO -->
                <div class="navbar-brand-box">
                    <!-- Dark Logo-->
                    <a href="<?php echo base_url('profile'); ?>" class="logo logo-dark">
                        <span class="logo-sm">
                            <img src="<?php echo base_url('assets/admin/images/logo.png'); ?>" alt="" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="<?php echo base_url('assets/admin/images/logo.png'); ?>" alt="" height="17">
                        </span>
                    </a>
                    <!-- Light Logo-->
                    <a href="<?php echo base_url('profile'); ?>" class="logo logo-light">
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
                                <a class="nav-link menu-link <?php echo strpos(current_url(),'designation') !== false ? 'active' : ''; ?>" href="<?php echo base_url('designation/list'); ?>">
                                    <i class="ri-file-user-fill"></i> <span data-key="t-widgets">Designation</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link menu-link <?php echo strpos(current_url(),'department') !== false ? 'active' : ''; ?>" href="<?php echo base_url('department/list'); ?>">
                                    <i class="ri-building-2-fill"></i> <span data-key="t-widgets">Department</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link menu-link <?php echo strpos(current_url(),'keyword') !== false ? 'active' : ''; ?>" href="<?php echo base_url('keyword/list'); ?>">
                                    <i class="ri-file-word-fill"></i> <span data-key="t-widgets">Keyword</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link menu-link <?php echo strpos(current_url(),'publisher') !== false ? 'active' : ''; ?>" href="<?php echo base_url('publisher/list'); ?>">
                                    <i class="ri-article-fill"></i> <span data-key="t-widgets">Publisher</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link menu-link <?php echo strpos(current_url(),'teacher') !== false ? 'active' : ''; ?>" href="<?php echo base_url('teacher/list'); ?>">
                                    <i class="ri-user-star-fill"></i> <span data-key="t-widgets">Teacher</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link menu-link <?php echo strpos(current_url(),'journal-article') !== false ? 'active' : ''; ?>" href="<?php echo base_url('journal-article/list'); ?>">
                                    <i class="ri-book-mark-line"></i> <span data-key="t-widgets">Journal / Article</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link menu-link <?php echo strpos(current_url(),'book') !== false ? 'active' : ''; ?>" href="<?php echo base_url('book/list'); ?>">
                                    <i class="ri-book-mark-line"></i> <span data-key="t-widgets">Book</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link menu-link <?php echo strpos(current_url(),'book-article') !== false ? 'active' : ''; ?>" href="<?php echo base_url('book-article/list'); ?>">
                                    <i class="ri-book-mark-line"></i> <span data-key="t-widgets">Book / Article</span>
                                </a>
                            </li>
                            <!-- <li class="nav-item">
                                <a class="nav-link menu-link {{strpos(url()->current(),'admin/image') !== false || strpos(url()->current(),'admin/audio') !== false || strpos(url()->current(),'admin/video') !== false || strpos(url()->current(),'admin/document') !== false ? 'active' : ''}}" href="#sidebarDashboards6" data-bs-toggle="collapse" role="button"
                                    aria-expanded="{{strpos(url()->current(),'admin/image') !== false || strpos(url()->current(),'admin/audio') !== false || strpos(url()->current(),'admin/video') !== false || strpos(url()->current(),'admin/document') !== false ? 'true' : 'false'}}" aria-controls="sidebarDashboards6">
                                    <i class="ri-image-fill"></i> <span data-key="t-dashboards">Media Content</span>
                                </a>
                                <div class="collapse menu-dropdown {{strpos(url()->current(),'admin/image') !== false || strpos(url()->current(),'admin/audio') !== false || strpos(url()->current(),'admin/video') !== false || strpos(url()->current(),'admin/document') !== false ? 'show' : ''}}" id="sidebarDashboards6">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="{{route('image_view')}}" class="nav-link {{strpos(url()->current(),'admin/image') !== false ? 'active' : ''}}" data-key="t-analytics"> Image </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{route('audio_view')}}" class="nav-link {{strpos(url()->current(),'admin/audio') !== false ? 'active' : ''}}" data-key="t-analytics"> Audio </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{route('video_view')}}" class="nav-link {{strpos(url()->current(),'admin/video') !== false ? 'active' : ''}}" data-key="t-analytics"> Video </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{route('document_view')}}" class="nav-link {{strpos(url()->current(),'admin/document') !== false ? 'active' : ''}}" data-key="t-analytics"> Document </a>
                                        </li>
                                    </ul>
                                </div>
                            </li> -->
                        </ul>
                    </div>
                    <!-- Sidebar -->
                </div>
            </div>
            <!-- Left Sidebar End -->
            <!-- Vertical Overlay-->
            <div class="vertical-overlay"></div>
