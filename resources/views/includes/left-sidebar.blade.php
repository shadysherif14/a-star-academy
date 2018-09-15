<aside id="leftsidebar" class="sidebar">
    <ul class="nav nav-tabs">
        <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#dashboard"><i class="zmdi zmdi-home"></i></a></li>
        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#user">Professors</a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane stretchRight active" id="dashboard">
            <div class="menu">
                <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: calc(100vh - 60px);">
                    <ul class="list" style="overflow: hidden; width: auto; height: calc(100vh - 60px);">
                        <li>
                            <div class="user-info">
                                <div class="image"><a href="./profile.html" class=" waves-effect waves-block">
                                    <img src="{{ asset('images/defaults/avatar.png') }}" alt="User"></a></div>
                                <div class="detail">
                                    <h4>Pro. Charlotte</h4>
                                    <small>UI UX Designer</small>
                                </div>
                            </div>
                        </li>
                        <li class="header">MAIN</li>
                        <li class="active open"><a href="./index.html" class="toggled waves-effect waves-block"><i class="zmdi zmdi-home"></i><span>Dashboard</span></a></li>
                        <li><a href="javascript:void(0);" class="menu-toggle waves-effect waves-block"><i class="zmdi zmdi-accounts-outline"></i><span>Students</span> </a>
                            <ul class="ml-menu">
                                <li><a href="./students.html" class=" waves-effect waves-block">All Students</a></li>
                                <li><a href="./add-students.html" class=" waves-effect waves-block">Add Students</a></li>
                                <li><a href="./students-profile.html" class=" waves-effect waves-block">Students Profile</a></li>
                                <li><a href="./students-invoice.html" class=" waves-effect waves-block">Students Invoice</a></li>
                            </ul>
                        </li>
                        <li><a href="javascript:void(0);" class="menu-toggle waves-effect waves-block"><i class="zmdi zmdi-accounts-alt"></i><span>Professors</span> </a>
                            <ul class="ml-menu">
                                <li><a href="./professors.html" class=" waves-effect waves-block">All Professors</a></li>
                                <li><a href="./add-professors.html" class=" waves-effect waves-block">Add Professors</a></li>
                                <li><a href="./profile.html" class=" waves-effect waves-block">Profile</a></li>
                            </ul>
                        </li>
                        <li><a href="./parents.html" class=" waves-effect waves-block"><i class="zmdi zmdi-account"></i><span>Parents</span> </a></li>
                        <li> <a href="javascript:void(0);" class="menu-toggle waves-effect waves-block"><i class="zmdi zmdi-lock"></i><span>Authentication</span> </a>
                            <ul class="ml-menu">
                                <li><a href="./sign-in.html" class=" waves-effect waves-block">Sign In</a> </li>
                                <li><a href="./sign-up.html" class=" waves-effect waves-block">Sign Up</a> </li>
                                <li><a href="./forgot-password.html" class=" waves-effect waves-block">Forgot Password</a> </li>
                                <li><a href="./404.html" class=" waves-effect waves-block">Page 404</a> </li>
                                <li><a href="./500.html" class=" waves-effect waves-block">Page 500</a> </li>
                                <li><a href="./page-offline.html" class=" waves-effect waves-block">Page Offline</a> </li>
                                <li><a href="./locked.html" class=" waves-effect waves-block">Locked Screen</a> </li>
                            </ul>
                        </li>
                        <li class="header">UNIVERSITY</li>
                        <li><a href="./events.html" class=" waves-effect waves-block"><i class="zmdi zmdi-calendar-check"></i><span>Events</span> </a></li>
                        <li><a href="javascript:void(0);" class="menu-toggle waves-effect waves-block"><i class="zmdi zmdi-city-alt"></i><span>Departments</span> </a>
                            <ul class="ml-menu">
                                <li><a href="./departments.html" class=" waves-effect waves-block">All Departments</a></li>
                                <li><a href="./add-departments.html" class=" waves-effect waves-block">Add Departments</a></li>
                            </ul>
                        </li>
                        <li><a href="javascript:void(0);" class="menu-toggle waves-effect waves-block"><i class="zmdi zmdi-graduation-cap"></i><span>Courses</span> </a>
                            <ul class="ml-menu">
                                <li><a href="./courses.html" class=" waves-effect waves-block">All Courses</a></li>
                                <li><a href="./add-courses.html" class=" waves-effect waves-block">Add Courses</a></li>
                                <li><a href="./courses-info.html" class=" waves-effect waves-block">Courses Info</a></li>
                            </ul>
                        </li>
                        <li><a href="./library.html" class=" waves-effect waves-block"><i class="zmdi zmdi-book"></i><span>Library</span> </a></li>
                        <li><a href="./classroom.html" class=" waves-effect waves-block"><i class="zmdi zmdi-device-hub"></i><span>Class</span> </a></li>
                        <li><a href="./noticeboard.html" class=" waves-effect waves-block"><i class="zmdi zmdi-alert-circle"></i><span>Noticeboard</span> </a></li>
                        <li><a href="./centres.html" class=" waves-effect waves-block"><i class="zmdi zmdi-pin"></i><span>University Centres</span></a></li>
                        <li class="header">EXTRA COMPONENTS</li>
                        <li><a href="javascript:void(0);" class="menu-toggle waves-effect waves-block"><i class="zmdi zmdi-blogger"></i><span>Blog</span></a>
                            <ul class="ml-menu">
                                <li><a href="./blog-dashboard.html" class=" waves-effect waves-block">Blog Dashboard</a></li>
                                <li><a href="./blog-post.html" class=" waves-effect waves-block">New Post</a></li>
                                <li><a href="./blog-list.html" class=" waves-effect waves-block">Blog List</a></li>
                                <li><a href="./blog-grid.html" class=" waves-effect waves-block">Blog Grid</a></li>
                                <li><a href="./blog-details.html" class=" waves-effect waves-block">Blog Single</a></li>
                            </ul>
                        </li>
                        <li><a href="javascript:void(0);" class="menu-toggle waves-effect waves-block"><i class="zmdi zmdi-folder"></i><span>File Manager</span> </a>
                            <ul class="ml-menu">
                                <li><a href="./file-dashboard.html" class=" waves-effect waves-block">All File</a></li>
                                <li><a href="./file-documents.html" class=" waves-effect waves-block">Documents</a></li>
                                <li><a href="./file-media.html" class=" waves-effect waves-block">Media</a></li>
                                <li><a href="./file-images.html" class=" waves-effect waves-block">Images</a></li>
                            </ul>
                        </li>
                        <li> <a href="javascript:void(0);" class="menu-toggle waves-effect waves-block"><i class="zmdi zmdi-apps"></i><span>App</span> </a>
                            <ul class="ml-menu">
                                <li><a href="./mail-inbox.html" class=" waves-effect waves-block">Inbox</a></li>
                                <li><a href="./chat.html" class=" waves-effect waves-block">Chat</a></li>
                                <li><a href="./contact.html" class=" waves-effect waves-block">Contact list</a></li>
                            </ul>
                        </li>
                        <li> <a href="javascript:void(0);" class="menu-toggle waves-effect waves-block"><i class="zmdi zmdi-delicious"></i><span>Widgets</span> </a>
                            <ul class="ml-menu">
                                <li><a href="./widgets-app.html" class=" waves-effect waves-block">Apps Widgetse</a></li>
                                <li><a href="./widgets-data.html" class=" waves-effect waves-block">Data Widgetse</a></li>
                            </ul>
                        </li>
                        <li> <a href="javascript:void(0);" class="menu-toggle waves-effect waves-block"><i class="zmdi zmdi-copy"></i><span>Sample Pages</span> </a>
                            <ul class="ml-menu">
                                <li><a href="./blank.html" class=" waves-effect waves-block">Blank Page</a> </li>
                                <li><a href="./dashboard-rtl.html" class=" waves-effect waves-block">RTL Support</a> </li>
                                <li><a href="./index2.html" class=" waves-effect waves-block">Horizontal Menu</a> </li>
                                <li><a href="./image-gallery.html" class=" waves-effect waves-block">Image Gallery</a> </li>
                                <li><a href="./profile.html" class=" waves-effect waves-block">Profile</a></li>
                                <li><a href="./timeline.html" class=" waves-effect waves-block">Timeline</a></li>
                                <li><a href="./invoice.html" class=" waves-effect waves-block">Invoices</a></li>
                                <li><a href="./search-results.html" class=" waves-effect waves-block">Search Results</a></li>
                            </ul>
                        </li>
                        <li> <a href="javascript:void(0);" class="menu-toggle waves-effect waves-block"><i class="zmdi zmdi-swap-alt"></i><span>User Interface (UI)</span> </a>
                            <ul class="ml-menu">
                                <li><a href="./ui_kit.html" class=" waves-effect waves-block">UI KIT</a></li>
                                <li><a href="./alerts.html" class=" waves-effect waves-block">Alerts</a></li>
                                <li><a href="./collapse.html" class=" waves-effect waves-block">Collapse</a></li>
                                <li><a href="./colors.html" class=" waves-effect waves-block">Colors</a></li>
                                <li><a href="./dialogs.html" class=" waves-effect waves-block">Dialogs</a></li>
                                <li><a href="./icons.html" class=" waves-effect waves-block">Icons</a></li>
                                <li><a href="./list-group.html" class=" waves-effect waves-block">List Group</a></li>
                                <li><a href="./media-object.html" class=" waves-effect waves-block">Media Object</a></li>
                                <li><a href="./modals.html" class=" waves-effect waves-block">Modals</a></li>
                                <li><a href="./notifications.html" class=" waves-effect waves-block">Notifications</a></li>
                                <li><a href="./progressbars.html" class=" waves-effect waves-block">Progress Bars</a></li>
                                <li><a href="./range-sliders.html" class=" waves-effect waves-block">Range Sliders</a></li>
                                <li><a href="./sortable-nestable.html" class=" waves-effect waves-block">Sortable &amp; Nestable</a></li>
                                <li><a href="./tabs.html" class=" waves-effect waves-block">Tabs</a></li>
                                <li><a href="./waves.html" class=" waves-effect waves-block">Waves</a></li>
                            </ul>
                        </li>
                        <li class="header">Extra</li>
                        <li>
                            <div class="progress-container progress-primary m-t-10">
                                <span class="progress-badge">Traffic this Month</span>
                                <div class="progress">
                                    <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="67" aria-valuemin="0" aria-valuemax="100"
                                        style="width: 67%;">
                                        <span class="progress-value">67%</span>
                                    </div>
                                </div>
                            </div>
                            <div class="progress-container progress-info">
                                <span class="progress-badge">Server Load</span>
                                <div class="progress">
                                    <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="86" aria-valuemin="0" aria-valuemax="100"
                                        style="width: 86%;">
                                        <span class="progress-value">86%</span>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <div class="slimScrollBar" style="background: rgba(0, 0, 0, 0.2); width: 2px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 3px; z-index: 99; left: 1px; height: 250.965px;"></div>
                    <div class="slimScrollRail" style="width: 2px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 0px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; left: 1px;"></div>
                </div>
            </div>
        </div>
        <div class="tab-pane stretchLeft" id="user">
            <div class="menu">
                <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: calc(100vh - 60px);">
                    <ul class="list" style="overflow: hidden; width: auto; height: calc(100vh - 60px);">
                        <li>
                            <div class="user-info m-b-20 p-b-15">
                                <div class="image"><a href="./profile.html" class=" waves-effect waves-block"><img src="../../../../../via.placeholder.com/80x80" alt="User"></a></div>
                                <div class="detail">
                                    <h4>Pro. Charlotte</h4>
                                    <small>UI UX Designer</small>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <a title="facebook" href="javascript:void(0);" class=" waves-effect waves-block"><i class="zmdi zmdi-facebook"></i></a>
                                        <a title="twitter" href="javascript:void(0);" class=" waves-effect waves-block"><i class="zmdi zmdi-twitter"></i></a>
                                        <a title="instagram" href="javascript:void(0);" class=" waves-effect waves-block"><i class="zmdi zmdi-instagram"></i></a>
                                    </div>
                                    <div class="col-4 p-r-0">
                                        <h5 class="m-b-5">13</h5>
                                        <small>Exp</small>
                                    </div>
                                    <div class="col-4">
                                        <h5 class="m-b-5">33</h5>
                                        <small>Awards</small>
                                    </div>
                                    <div class="col-4 p-l-0">
                                        <h5 class="m-b-5">237</h5>
                                        <small>Class</small>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <small class="text-muted">Location: </small>
                            <p>795 Folsom Ave, Suite 600 San Francisco, CADGE 94107</p>
                            <hr>
                            <small class="text-muted">Email address: </small>
                            <p>Charlotte@example.com</p>
                            <hr>
                            <small class="text-muted">Phone: </small>
                            <p>+ 202-555-0191</p>
                            <hr>
                            <ul class="list-unstyled">
                                <li>
                                    <div>Photoshop</div>
                                    <div class="progress m-b-20">
                                        <div class="progress-bar l-blue " role="progressbar" aria-valuenow="89" aria-valuemin="0" aria-valuemax="100" style="width: 89%">
                                        <span class="sr-only">89% Complete</span> </div>
                                    </div>
                                </li>
                                <li>
                                    <div>Illustrator</div>
                                    <div class="progress m-b-20">
                                        <div class="progress-bar l-amber" role="progressbar" aria-valuenow="56" aria-valuemin="0" aria-valuemax="100" style="width: 56%">
                                        <span class="sr-only">56% Complete</span> </div>
                                    </div>
                                </li>
                                <li>
                                    <div>Art &amp; Design</div>
                                    <div class="progress m-b-20">
                                        <div class="progress-bar l-green" role="progressbar" aria-valuenow="78" aria-valuemin="0" aria-valuemax="100" style="width: 78%">
                                        <span class="sr-only">78% Complete</span> </div>
                                    </div>
                                </li>
                                <li>
                                    <div>HTML</div>
                                    <div class="progress m-b-20">
                                        <div class="progress-bar l-blush" role="progressbar" aria-valuenow="43" aria-valuemin="0" aria-valuemax="100" style="width: 56%">
                                        <span class="sr-only">56% Complete</span> </div>
                                    </div>
                                </li>
                                <li>
                                    <div>CSS</div>
                                    <div class="progress m-b-20">
                                        <div class="progress-bar l-parpl" role="progressbar" aria-valuenow="43" aria-valuemin="0" aria-valuemax="100" style="width: 50%">
                                        <span class="sr-only">50% Complete</span> </div>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <div class="slimScrollBar" style="background: rgba(0, 0, 0, 0.2); width: 2px; position: absolute; top: 0px; opacity: 0.4; display: block; border-radius: 3px; z-index: 99; left: 1px;"></div>
                    <div class="slimScrollRail" style="width: 2px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 0px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; left: 1px;"></div>
                </div>
            </div>
        </div>
    </div>
</aside>