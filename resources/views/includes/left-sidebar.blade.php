<aside id="leftsidebar" class="sidebar">
  
    <div class="stretchRight" id="dashboard">
        <div class="menu">
            <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: calc(100vh - 60px);">
                <ul class="list" style="overflow: hidden; width: auto; height: calc(100vh - 60px);">

                    <li>
                        <div class="user-info">
                            <div class="image">
                                <a href="./profile.html" class=" waves-effect waves-block">
                                    <img src="/{{ auth()->user()->avatar }}" alt="User" />
                                </a>
                            </div>
                            <div class="detail">
                                <h4> {{ auth()->user()->name }} </h4>
                            </div>
                        </div>
                    </li>

                    <li class="active">
                        <a href="{{ adminRoute('home') }}" class="toggled waves-effect waves-block">
                            <i class="zmdi zmdi-home"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    <li>
                        <a href="javascript:void(0);" class="menu-toggle waves-effect waves-block">
                            <i class="zmdi zmdi-accounts-outline"></i>
                            <span>Students</span> 
                        </a>

                        <ul class="ml-menu">
                            <li>
                                <a href="{{ adminStaticRoute('User') }}" class=" waves-effect waves-block">All Students</a>
                            </li>
                        </ul>

                    </li>

                    <li>
                        <a href="javascript:void(0);" class="menu-toggle waves-effect waves-block">
                            <i class="zmdi zmdi-accounts-alt"></i>
                            <span>Instructors</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="{{ adminStaticRoute('Instructor') }}" class=" waves-effect waves-block">
                                    All Instructors
                                </a>
                            </li>
                            <li>
                                <a href="{{ adminStaticRoute('Instructor', 'create') }}" class=" waves-effect waves-block">
                                    Add Instructors
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript:void(0);" class="menu-toggle waves-effect waves-block">
                            <i class="zmdi zmdi-graduation-cap"></i>
                            <span>Courses</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="{{ adminStaticRoute('Course') }}" class=" waves-effect waves-block">
                                    All Courses
                                </a>
                            </li>
                            <li>
                                <a href="{{ adminStaticRoute('Course', 'create') }}" class=" waves-effect waves-block">
                                    Add Courses
                                </a>
                            </li>
                        </ul>
                    </li>

                </ul>

            </div>
        </div>
    </div>
        
</aside>