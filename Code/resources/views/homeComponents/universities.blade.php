<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-12 wow fadeInUp" data-wow-delay="0.1s">
                <h1 class="display-6 mb-5">Universities</h1>
                <p class="mb-5">
                   We're Currently Working in These Universities
                </p>
                <div class="row g-4">
                    @foreach ($universities as $uni)
                        <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                            <div class="card text-center team-item rounded p-2">
                                @if ($uni->avatar)
                                    <img class="img-fluid" src="{{ asset('storage/images/'.$uni->avatar) }}"
                                    
                                    style="height: 250px; width: 100%;">
                                @else
                                    <span>No image found!</span>
                                @endif
                                <div class="p-4">
                                    <h6>{{ $uni->name }}</h6>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
