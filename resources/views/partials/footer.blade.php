<footer id="footer" class="wow fadeIn" data-wow-duration="2s">
    {{--
    <div class="about">
        <h3> {{ config('app.name') }} </h3>
        <p> Lorem ipsum dolor sit amet consectetur adipisicing elit. Est asperiores illo, quisquam quibusdam totam aliquid a.
            Eos minima quod voluptate odit amet. Recusandae expedita sed, inventore incidunt non fugiat pariatur ab repellendus?
            Ratione mollitia, aliquid atque accusantium amet voluptatibus doloremque illo harum est voluptatum nemo laborum
            quaerat ut! Commodi, doloremque. </p>
    </div> --}}

    <div class="social">
        <h3> Keep Connected </h3>
        <div>
            <img src="{{ imageIcon('facebook') }}" alt="" class="icon">
            <a href="#"> Like us on Facebook </a>
        </div>
        <div>
            <img src="{{ imageIcon('twitter') }}" alt="" class="icon">
            <a href="#"> Follow us on Twitter </a>
        </div>
        <div>
            <img src="{{ imageIcon('google-plus') }}" alt="" class="icon">
            <a href="#"> Add us on Google Plus </a>
        </div>
        <div class="my-3">
            <a class="my-1 d-block" href="/terms">Terms and Conditions</a>
            <a class="my-1 d-block" href="/cookies">Cookies Policy</a>
            <a class="my-1 d-block" href="/faq">FAQ</a>

        </div>
    </div>

    <div class="contact">
        <h3> Contact Us </h3>

        <form action="{{ route('contact.send') }}" method="POST" id="contact-us-form">

            @csrf

            <div class="input-group mb-0 mt-3">
                <span class="input-group-addon">
                    <img src="{{ imageIcon('user') }}" alt="">
                </span>
                <input type="text" class="form-control" placeholder="User Name" name="username" @auth value="{{ Auth::user()->name }}" @endauth
                />
            </div>

            <div class="input-group mb-0 mt-3">
                <span class="input-group-addon">
                    <img src="{{ imageIcon('email') }}">
                </span>
                <input type="text" class="form-control" placeholder="Email" name="email" @auth value="{{ Auth::user()->email }}" @endauth
                />
            </div>

            <div class="input-group mb-0 mt-3">
                <span class="input-group-addon">
                    <img src="{{ imageIcon('message') }}">
                </span>
                <textarea class="form-control" placeholder="Message" name="message"></textarea>
            </div>

            <button class="btn btn-block hvr-bounce-to-top mb-0 mt-3"> <i class="typcn typcn-messages"></i> Send </button>

        </form>
    </div>
</footer>
