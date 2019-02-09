<<<<<<< HEAD
@extends('layouts.app') 
@section('content')

<div class="row position-relative img-overlay" style="min-height:80vh;">
    <div class="w-100 h-100 position-absolute bg-overlay" style="top:0;left:0;right:0;bottom:0;"> </div>
    <div class="w-100 h-100 p-5 p-sm-2">
        <div class="col-sm-12 row">

            <div class="col-md-12 pt-5 px-sm-0">
                <h2 class="text-gold">Title ggoes here</h2>
            </div>

            <div class="col-md-8 px-3 px-sm-0">
                <p class="text-white">"Laravel From Scratch" has been the go-to video resource for Laravel newcomers since 2013. Considering this,
                    as you can imagine, this truth requires that we repeatedly refresh the series to ensure that it remains
                    as up-to-date as possible. To celebrate the release of Laravel 5.7, we've done it again. Every video
                    has been re-recorded. Every technique has been optimized. Every example has been updated. I hope you
                    enjoy it! And if you're brand new to Laravel, you're in for a treat. Laravel is a joy to work with. If
                    you're willing, I'll teach you everything I know.
                </p>
            </div>

            <div class="col-md-4">
                <div class="text-white">Logo Goes Here</div>
            </div>

        </div>
=======
@extends('layouts.app')


@section('content')

<div class="wrapper h-100">
    <div class="m-auto h-100">
        <div class="h-100">
            <img src="/res/person.png" alt="" class="img-responsive float-right mt-5" style="height:90%;width:33%" data-toggle="tooltip" data-placement="left" title="Welcome to A-star academy. I'm Lisa, I'll be your guide.">
            <div class="row m-auto">
                
                <div class="row flex-column">
                    <img src="/res/logo1.png" alt="" class="img-responsive float-left mt-5 ml-5 col-md-10" id="right-door" onclick="openDoor(this)">
                </div>
                <div class="row flex-column">
                    <img src="/res/logo1.png" alt="" class="img-responsive float-left mt-5 ml-5 col-md-10" id="right-door" onclick="openDoor(this)">
                </div>
            </div>
        </div>
        <audio id="audio-player" src="res/welcome.mp3" autoplay></audio>
        <audio id="audio-2" src="res/2.mp3"></audio>
>>>>>>> 2165c7c157fa99cf173cb2f2808ca7641afc399a
    </div>




<<<<<<< HEAD

</div>


<div class="row mb-5" style="border-bottom:1px solid #191919;line-height:4em;">
    <div class="container">
        <div class="row">

            <div class="px-0 col-sm-8 col-xs-8 text-left">By: Hossam Houssien</div>
            <div class="px-0 col-sm-4 col-xs-4 text-right">
                <span class="mx-2" style="font-size:1.5em;vertical-align: middle;">
                        <i class="fas fa-play-circle"></i>
                </span>
                <span style="vertical-align: middle;"> 6 Sessions</span>
            </div>
        </div>
    </div>
</div>

{{-- <div class="container px-5">
    
    <div class="card-dark row p-4">
        <div class="col-md-3 d-flex flex-column justify-content-center align-items-center">
            <div class="counter">01</div>
        </div>
        <div class="col-md-9 course-list-item">
            <h4 class="text-gold text-center-sm my-1">Session title
                <span class="price-label">free</span>
            </h4>
            <p class="text-white py-3 pr-3">Session describtion</p>
        </div>
    </div>

    <div class="card-dark row p-4">
        <div class="col-md-3 d-flex flex-column justify-content-center align-items-center">
            <div class="counter">02</div>
        </div>
        <div class="col-md-9 course-list-item">
            <h4 class="text-gold text-center-sm my-1">Session title</h4>
            <p class="text-white py-3 pr-3">Session describtion</p>
        </div>
    </div>

    <div class="card-dark row p-4">
        <div class="col-md-3 d-flex flex-column justify-content-center align-items-center">
            <div class="counter">03</div>
        </div>
        <div class="col-md-9 course-list-item">
            <h4 class="text-gold text-center-sm my-1">Session title</h4>
            <p class="text-white py-3 pr-3">Session describtion</p>
        </div>
    </div>

    <div class="card-dark row p-4">
        <div class="col-md-3 d-flex flex-column justify-content-center align-items-center">
            <div class="counter">04</div>
        </div>
        <div class="col-md-9 course-list-item">
            <h4 class="text-gold text-center-sm my-1">Session title</h4>
            <p class="text-white py-3 pr-3">Session describtion</p>
        </div>
    </div> 

    <ul class="timeline">
        
        <li class="row py-2">
            <a class="col-md-8 title text-gold" href="#"> Session title goes here </a>
            <span class="col-md-4 duration text-right px-0"> 2 min </span>

        </li>

        <li class="row py-2">
            <a class="col-md-8 title text-gold" href="#"> Session title goes here </a>
            <span class="col-md-4 duration text-right px-0"> 2 min </span>

        </li>

        <li class="row py-2">
            <a class="col-md-8 title text-gold" href="#"> Session title goes here </a>
            <span class="col-md-4 duration text-right px-0"> 2 min </span>

        </li>

        <li class="row py-2">
            <a class="col-md-8 title text-gold" href="#"> Session title goes here </a>
            <span class="col-md-4 duration text-right px-0"> 2 min </span>

        </li>

    </ul>
</div> --}}



<div class="session-list-wrapper w-100">
    <h1 class="title">Course Sessions</h1>
    <div class="timeline">

      <div class="timeline-nav">
        <div class="timeline-nav__item">1</div>
        <div class="timeline-nav__item">2</div>
        <div class="timeline-nav__item">3</div>
        <div class="timeline-nav__item">4</div>
        <div class="timeline-nav__item">5</div>
        <div class="timeline-nav__item">6</div>
        <div class="timeline-nav__item">7</div>
        <div class="timeline-nav__item">8</div>
        <div class="timeline-nav__item">9</div>
        <div class="timeline-nav__item">10</div>
      </div>

      <div class="timeline-wrapper">
        <div class="timeline-slider">
          <div class="timeline-slide" style="background-image: url(https://unsplash.it/1920/600?image=11;" data-year="1985">      <span class="timeline-year">120 EGP</span>
            <div class="timeline-slide__content">
              <h4 class="timeline-title">Session #1</h4>
              <p class="timeline-text">First project for the leading film actress Jamuna Barua, wife of Pramathesh Barua the legendary actor, director, and screenwriter</p>
              <div>
                  <button class="btn btn-gold">Watch</button>
              </div>
            </div>
          </div>
          {{-- <div class="timeline-slide" style="background-image: url(https://unsplash.it/1920/600?image=12;" data-year="1988">      <span class="timeline-year">1988</span>
            <div class="timeline-slide__content">
              <h4 class="timeline-title">Session #2</h4>
              <p class="timeline-text">First project for the leading film actress Jamuna Barua, wife of Pramathesh Barua the legendary actor, director, and screenwriter</p>
            </div>
          </div>
          <div class="timeline-slide" style="background-image: url(https://unsplash.it/1920/600?image=13;" data-year="1998">      <span class="timeline-year">1998</span>
            <div class="timeline-slide__content">
              <h4 class="timeline-title">Session #3</h4>
              <p class="timeline-text">Lorem ipsum dolor site amet, consectetur adipscing elit, sed do eisumod tempor incididut ut labore et dolore magna aliqua. Ut enim ad mimim venjam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
            </div>
          </div>
          <div class="timeline-slide" style="background-image: url(https://unsplash.it/1920/600?image=13;" data-year="2006">      <span class="timeline-year">2006</span>
            <div class="timeline-slide__content">
              <h4 class="timeline-title">Session #4</h4>
              <p class="timeline-text">Lorem ipsum dolor site amet, consectetur adipscing elit, sed do eisumod tempor incididut ut labore et dolore magna aliqua. Ut enim ad mimim venjam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
            </div>
          </div>
          <div class="timeline-slide" style="background-image: url(https://unsplash.it/1920/600?image=13;" data-year="2008">      <span class="timeline-year">2008</span>
            <div class="timeline-slide__content">
              <h4 class="timeline-title">Session #5</h4>
              <p class="timeline-text">Lorem ipsum dolor site amet, consectetur adipscing elit, sed do eisumod tempor incididut ut labore et dolore magna aliqua. Ut enim ad mimim venjam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
            </div>
          </div>
          <div class="timeline-slide" style="background-image: url(https://unsplash.it/1920/600?image=13;" data-year="2010">      <span class="timeline-year">2010</span>
            <div class="timeline-slide__content">
              <h4 class="timeline-title">Session #6</h4>
              <p class="timeline-text">Lorem ipsum dolor site amet, consectetur adipscing elit, sed do eisumod tempor incididut ut labore et dolore magna aliqua. Ut enim ad mimim venjam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
            </div>
          </div>
          <div class="timeline-slide" style="background-image: url(https://unsplash.it/1920/600?image=13;" data-year="2012">      <span class="timeline-year">2012</span>
            <div class="timeline-slide__content">
              <h4 class="timeline-title">Session #7</h4>
              <p class="timeline-text">Lorem ipsum dolor site amet, consectetur adipscing elit, sed do eisumod tempor incididut ut labore et dolore magna aliqua. Ut enim ad mimim venjam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
            </div>
          </div>
          <div class="timeline-slide" style="background-image: url(https://unsplash.it/1920/600?image=13;" data-year="2013">      <span class="timeline-year">2013</span>
            <div class="timeline-slide__content">
              <h4 class="timeline-title">Session #8</h4>
              <p class="timeline-text">Lorem ipsum dolor site amet, consectetur adipscing elit, sed do eisumod tempor incididut ut labore et dolore magna aliqua. Ut enim ad mimim venjam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
            </div>
          </div>
          <div class="timeline-slide" style="background-image: url(https://unsplash.it/1920/600?image=13;" data-year="2015">      <span class="timeline-year">2015</span>
            <div class="timeline-slide__content">
              <h4 class="timeline-title">Session #9</h4>
              <p class="timeline-text">Lorem ipsum dolor site amet, consectetur adipscing elit, sed do eisumod tempor incididut ut labore et dolore magna aliqua. Ut enim ad mimim venjam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
            </div>
          </div>
          <div class="timeline-slide" style="background-image: url(https://unsplash.it/1920/600?image=13;" data-year="2016">      <span class="timeline-year">2016</span>
            <div class="timeline-slide__content">
              <h4 class="timeline-title">Session #10</h4>
              <p class="timeline-text">Lorem ipsum dolor site amet, consectetur adipscing elit, sed do eisumod tempor incididut ut labore et dolore magna aliqua. Ut enim ad mimim venjam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
            </div>
          </div> --}}
        </div>
      </div>
    </div>
  </div>
@endsection

@push('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.7.1/slick.min.css">
<link rel="stylesheet" href="{{ asset_path('css/sessions/show.css') }}">
<link rel="stylesheet" href="{{ asset_path('css/courses/show.css') }}"> 
@endpush 

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.7.1/slick.min.js"></script>
    <script>
    $(function(){
   $('.timeline-nav').slick({
      slidesToShow: 12,
      slidesToScroll: 1,
      asNavFor: '.timeline-slider',
      centerMode: true,
      focusOnSelect: true,
      mobileFirst: true,
      arrows: false,
      infinite:false,
       responsive: [
           {
          breakpoint: 768,
          settings: {
            slidesToShow: 8,
           }
          },
         {
          breakpoint: 0,
          settings: {
            slidesToShow: 4,
            slidesToScroll: 2,
          }
        }
     ]
  });
  
   $('.timeline-slider').slick({
      slidesToShow: 1,
      slidesToScroll: 1,
      arrows: false,
      asNavFor: '.timeline-nav',     
      centerMode: true,     
      cssEase: 'ease',
       edgeFriction: 0.5,
       mobileFirst: true,
       speed: 500,
       responsive: [
         {
          breakpoint: 0,
          settings: {
              centerMode: false
          }
        },
           {
          breakpoint: 768,
          settings: {
              centerMode: true
          }
        }
     ]
  });
 
});
</script>
@endpush
=======
</div>


@endsection
>>>>>>> 2165c7c157fa99cf173cb2f2808ca7641afc399a
