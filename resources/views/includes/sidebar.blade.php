<ul id="sidebar" class="side-nav fixed custom-scrollbar">


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
                        <i class="fas fa-list mr-2"></i>
                        Levels
                        <i class="fas fa-angle-down rotate-icon"></i>
                    </a>
                    <div class="collapsible-body">
                        <ul>
                            <li>
                                <a href="/admin/levels" class="waves-effect">
                                    <i class="fas fa-list-alt mr-2"></i> All Levels 
                                </a>

                                <a href="/admin/levels/create" class="waves-effect">
                                    <i class="fas fa-plus mr-2"></i> Add Level 
                                </a>
                            </li>
                        </ul>
                    </div>

                </li>

                <li>
                    <a class="collapsible-header waves-effect arrow-r">
                        <i class="fas fa-graduation-cap mr-2"></i> 
                        Courses
                        <i class="fas fa-angle-down rotate-icon"></i>
                    </a>
    
                    <div class="collapsible-body">
                        <ul>
                            <li>
                                <a href="/admin/courses" class="waves-effect">
                                    <i class="fas fa-list-alt mr-2"></i> All Course 
                                </a>
    
                                <a href="/admin/courses/create" class="waves-effect">
                                    <i class="fas fa-plus mr-2"></i> Add Course 
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

            </li>
        </ul>
    </li>
</ul>
