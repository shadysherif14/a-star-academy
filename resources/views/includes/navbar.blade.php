<nav class="navbar p-l-5 p-r-5">
    <ul class="nav navbar-nav navbar-left">
        <li>
            <div class="navbar-header">
                <a href="javascript:void(0);" class="bars" style=""></a>
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ asset_path('assets/images/logo.png') }}" width="30" alt="Oreo">
                    <span class="m-l-10"> {{ config('app.name') }} </span>
                </a>
            </div>
        </li>

        <li>
            <a href="javascript:void(0);" class="ls-toggle-btn" data-close="true">
                <i class="zmdi zmdi-swap"></i>
            </a>
        </li>

        @php $notifications = auth()->user()->notifications; 
@endphp

        <li class="dropdown">
            <a href="{{ url('subscriptions') }}">
                <i class="zmdi zmdi-notifications"></i>
                <div class="notify">
                    @if(count($notifications))
                    <span class="heartbit"></span>
                    <span class="point"></span>
                    @endif
                </div>
            </a>
        </li>

        <li class="float-right">

            <a href="javascript:void(0);" class="logout-btn" data-close="true">
                <i class="zmdi zmdi-power"></i>
            </a>

            <form action="{{ url('logout') }}" id="logout-form" method="post">@csrf</form>

        </li>
    </ul>
</nav>