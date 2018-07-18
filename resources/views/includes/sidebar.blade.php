<!-- SideNav Menu -->
<ul id="slide-out" class="side-nav fixed custom-scrollbar">
    <!-- Logo -->
    <li>
        <div class="logo-wrapper waves-light">
            <a href="#">
                <img src="{{ asset('images/logo.png') }}" class="img-fluid flex-center py-2">
            </a>
        </div>
    </li>
    <!--/. Logo -->
    <!--Social-->

    <!-- Side navigation links -->
    <li>
        <ul class="collapsible collapsible-accordion">
            <li>

                <li>
                    <a class="collapsible-header waves-effect arrow-r">
                        <i class="fas fa-chevron-right mr-2"></i>
                        Levels
                        <i class="fas fa-angle-down rotate-icon"></i>
                    </a>
                    <div class="collapsible-body">
                        <ul>
                            <li>
                                <a href="levels/create" class="waves-effect">
                                    <i class="fas fa-plus mr-2"></i> Add Level 
                                </a>
                            </li>
                            
                        </ul>
                    </div>
                </li>

                <a class="collapsible-header waves-effect arrow-r" href="/admin/courses">
                    <i class="fas fa-chevron-right mr-2"></i> Courses
                </a>

            </li>
        </ul>
    </li>
    <!--/. Side navigation links -->
</ul>
<!--/. Sidebar navigation -->

{{--
<li>
    <a class="collapsible-header waves-effect arrow-r">
        <i class="fas fa-chevron-right mr-2"></i>
        Levels
        <i class="fas fa-angle-down rotate-icon"></i>
    </a>
    <div class="collapsible-body">
        <ul>
            <li>
                <a href="#" class="waves-effect">
                                <i class="fas fa-plus mr-2"></i> Add Level 
                            </a>
            </li>
            <li>
                <a href="#" class="waves-effect">
                                <i class="fas fa-pen mr-2"></i> Edit Level
                            </a>
            </li>
        </ul>
    </div>
</li>
--}}