<ul id="sidenav">


    <li>
        <div class="logo-wrapper waves-light">
            <a href="#">
                <img src="{{ asset('images/logo.png') }}" class="img-fluid flex-center py-2">
            </a>
        </div>
    </li>

    <li>
        <ul class="collapsible collapsible-accordion">

            <li>

                <li>
                    <a class="collapsible-header waves-effect arrow-r">
                        <i class="fas fa-list"></i>
                        Levels
                        <i class="fas fa-angle-down rotate-icon"></i>
                    </a>
                    <div class="collapsible-body">
                        <ul>
                            <li>
                                <a href="/levels" class="waves-effect">
                                    <i class="fas fa-list-alt"></i> All Levels 
                                </a>

                                <a href="/levels/create" class="waves-effect">
                                    <i class="fas fa-plus"></i> Add Level 
                                </a>
                            </li>
                        </ul>
                    </div>

                </li>

                <li>
                    <a class="collapsible-header waves-effect arrow-r">
                        <i class="fas fa-graduation-cap"></i> 
                        Courses
                        <i class="fas fa-angle-down rotate-icon"></i>
                    </a>

                    <div class="collapsible-body">
                        <ul>
                            <li>
                                <a href="/courses" class="waves-effect">
                                    <i class="fas fa-list-alt"></i> All Course 
                                </a>

                                <a href="/courses/create" class="waves-effect">
                                    <i class="fas fa-plus"></i> Add Course 
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

            </li>
        </ul>
    </li>
</ul>