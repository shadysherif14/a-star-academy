@extends('layouts.admin')

@section('content')
    <div class="row clearfix">
        <div class="col-lg-4 col-md-6">
            <div class="card top_counter">
                <div class="body">
                    <div class="icon xl-slategray"><i class="zmdi zmdi-account-o"></i> </div>
                    <div class="content">
                        <div class="text">Student</div>
                        <h5 class="number count-to" data-from="0" data-to="2049" data-speed="2500" data-fresh-interval="700">2049</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="card top_counter">
                <div class="body">
                    <div class="icon xl-slategray"><i class="zmdi zmdi-account-circle"></i> </div>
                    <div class="content">
                        <div class="text">Teacher</div>
                        <h5 class="number count-to" data-from="0" data-to="39" data-speed="4000" data-fresh-interval="700">39</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="card top_counter">
                <div class="body">
                    <div class="icon xl-slategray"><i class="zmdi zmdi-label"></i> </div>
                    <div class="content">
                        <div class="text">Attendance</div>
                        <h5 class="number count-to" data-from="0" data-to="798" data-speed="3000" data-fresh-interval="700">798</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="card top_counter">
                <div class="body">
                    <div class="icon xl-slategray"><i class="zmdi zmdi-graduation-cap"></i> </div>
                    <div class="content">
                        <div class="text">Courses</div>
                        <h5 class="number count-to" data-from="0" data-to="43" data-speed="2500" data-fresh-interval="700">43</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="card top_counter">
                <div class="body">
                    <div class="icon xl-slategray"><i class="zmdi zmdi-balance-wallet"></i> </div>
                    <div class="content">
                        <div class="text">Expense</div>
                        <h5 class="m-b-0">$<span class="number count-to" data-from="0" data-to="2154" data-speed="2500" data-fresh-interval="700">2154</span></h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="card top_counter">
                <div class="body">
                    <div class="icon xl-slategray"><i class="zmdi zmdi-balance"></i> </div>
                    <div class="content">
                        <div class="text">Income</div>
                        <h5 class="m-b-0">$<span class="number count-to" data-from="0" data-to="5478" data-speed="2500" data-fresh-interval="700">5478</span></h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop


