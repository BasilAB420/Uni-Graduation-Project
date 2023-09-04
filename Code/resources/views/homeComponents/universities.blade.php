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
                                @if ($uni->image)
                                    <img class="img-fluid" src="{{ 'public/product/' . $uni->image }}"
                                    
                                        style="height: 250px; width:auto;">
                                @else
                                    <span>No image found!</span>
                                @endif
                                <div class="p-4">
                                    <h5>{{ $uni->name }}</h5>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
