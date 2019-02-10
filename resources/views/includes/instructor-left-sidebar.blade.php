<aside id="leftsidebar" class="sidebar">
  
    <div class="stretchRight" id="dashboard">
        <div class="menu">
            <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: calc(100vh - 60px);">
                <ul class="list" style="overflow: hidden; width: auto; height: calc(100vh - 60px);">

                    <li>
                        <div class="user-info">
                            <div class="image my-2">
                                <img src="{{ auth()->user()->avatar }}" alt="User" />
                            </div>
                            <div class="detail">
                                <h4> {{ auth()->user()->name }} </h4>
                            </div>
                        </div>
                    </li>

                    <li class="active">
                        <a href="{{ url('/') }}" class="toggled waves-effect waves-block">
                            <i class="zmdi zmdi-home"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ url('courses') }}" class="toggled waves-effect waves-block">
                            <i class="zmdi zmdi-graduation-cap"></i>
                            <span>Courses</span>
                        </a>
                    </li>


                    <li>
                        <a href="{{ url('/profile') }}" class="toggled waves-effect waves-block">
                            <i class="fa fa-user"></i>
                            <span> Profile </span>
                        </a>
                    </li>

                </ul>

            </div>
        </div>
    </div>
        
</aside>