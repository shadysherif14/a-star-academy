<div class="modal fade">
    <div class="modal-dialog  modal-lg">
    
        <div class="modal-content">
    
            <div class="modal-body">
    
                <div class="image">
                </div>
                <form action="{{ action('User\VideoController@subscribe', $video) }}" method="POST">
    
                    @csrf
    
                    <div class="content">
    
                        <div>
                            <label for="name"> Card Holdername </label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                        <img src="{{ asset_path('images/payment/user.png') }}" alt="">
                                    </span>
                                <input type="text" id="card-name" class="form-control" name="name" placeholder="Card Holdername" />
                            </div>
                        </div>
    
                        <div>
                            <label for="number"> Card Number </label>
                            <input type="hidden" name="number" id="hidden-number">
                            <div class="input-group">
                                <span class="input-group-addon" id="card-image">
                                        <img src="{{ asset_path('images/payment/credit-card.png') }}" alt="">
                                    </span>
                                <input type="text" id="card-number" class="form-control" placeholder="Card Number" />
                            </div>
                        </div>
    
                        <div class="grid">
    
                            <div>
                                <input type="hidden" name="month" id="card-month" />
                                <input type="hidden" name="year" id="card-year" />
    
                                <label for="date"> Card Expiry </label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                            <img src="{{ asset_path('images/payment/calendar.png') }}" alt="">
                                        </span>
                                    <input type="text" id="card-date" name="date" class="form-control" placeholder="MM/YY" />
                                </div>
                            </div>
    
                            <div>
                                <label for="number"> CVV/CVC </label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                            <img src="{{ asset_path('images/payment/lock.png') }}" alt="">
                                        </span>
                                    <input type="text" maxlength="4" id="card-cv" class="form-control" name="cv" placeholder="Card Validation Value/Code" />
                                </div>
                            </div>
    
                        </div>
    
                        <div class="type">
    
                            <label for=""> Subscription Type </label>
                            <div class="pretty p-icon p-pulse">
                                <input type="radio" name="type" value="unlimited" price="{{ $video->max_price }}" />
                                <div class="state">
                                    <i class="icon fas fa-infinity"></i>
                                    <label> {{ $video->max_times }} Times Access </label>
                                </div>
                            </div>
    
                            <div class="pretty p-icon p-pulse p-fill">
                                <input type="radio" name="type" value="one" price="{{ $video->one_price }}" />
                                <div class="state">
                                    <i class="icon zmdi zmdi-collection-item-1"></i>
                                    <label> One Time Access </label>
                                </div>
                            </div>
    
                            <div id="price-wrapper">
                                <i class="fas fa-money-bill-wave animated wow swing" aria-hidden="true"></i>
                                <span> Price </span>
                                <span class="font-weight-bold" id="video-price"> 0 EGP </span>
                            </div>
    
                        </div>
    
                        <div>
                            <label for="password"> Enter Your Password </label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                        <img src="{{ asset_path('images/payment/key.png') }}" alt="">
                                    </span>
                                <input type="password" id="password" class="form-control" name="password" placeholder="Password" />
                            </div>
                        </div>
    
                    </div>
    
                    <button class="btn"> Subscribe </button>
                </form>
    
            </div>
    
        </div>
    
    </div>
</div>