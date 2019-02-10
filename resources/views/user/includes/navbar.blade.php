<nav class="user-navbar navbar">
    <ul class="nav navbar-nav navbar-left">

        <li>
            <a class="brand" href="{{ url('/') }}">
                <img src="/assets/images/logo.png" width="75" alt="{{ config('app.name') }}">
                <span class="m-l-10"> {{ config('app.name') }} </span>
            </a>
        </li>
        <li class="float-right toggler-parent">
            @auth
            <a href="javascript:void(0);" class="logout-btn">
                    <i class="zmdi zmdi-power-off"></i>
                </a> @endauth
            <a href="javascript:void(0);" class="toggler">
                <i class="fas fa-bars"></i>
            </a>
        </li>

        <li class="float-right links">
            <a href="{{ route('home') }}" class="">
                <span class=""> Home </span>                
            </a>
            <a href="{{ route('courses.index') }}" class="">
                <span class=""> Courses </span>                
            </a>
            <a href="{{ route('instructors.index') }}" class="">
                <span class=""> Instructors </span>                
            </a> @auth
            <a href="{{ route('profiles.show') }}" class="grid">
                <img src="{{ Auth::user()->cropped_avatar }}" alt="">
                <span> {{ Auth::user()->name }} </span>
            </a>
            <a href="javascript:void(0);" class="logout-btn">
                <i class="zmdi zmdi-power-off"></i>
            </a>
            <form action="{{ url('logout') }}" id="logout-form" method="post">@csrf</form>
            @else
            <a href="{{ route('login') }}" class="">
                <span class=""> Log In </span>                
            </a>
            <a href="{{ route('register') }}" class="">
                <span class=""> Join Us </span>                
            </a> @endauth

        </li>

    </ul>

</nav>