<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center mx-auto" style="max-width: 500px">
            <h1 class="display-6 mb-5">Goods</h1>
        </div>
        <div class="row g-5">
            <div class="col-lg-3 d-none d-lg-block">
                <div class="testimonial-left h-100">
                    <img class="img-fluid animated pulse infinite" src="img/4.png" alt="" />
                    <img class="img-fluid animated pulse infinite" src="img/5.png" alt="" />
                    <img class="img-fluid animated pulse infinite" src="img/6.png" alt="" />
                </div>
            </div>

            
                
           
            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                <div class="owl-carousel testimonial-carousel">
                    @foreach ($goods as $good)
                    <div class="testimonial-item text-center">
                        <img class="img-fluid rounded mx-auto mb-4" src="img/book1.jpg" alt="" />
                        <h6 class="">{{ $good->university_name }}</h6>
                        <h2>{{ $good->item_name }}</h2>
                        <p class="">Poster Name: {{ $good->poster_name }}</p>
                        <p class="">Poster E-mail: {{ $good->poster_email }}</p>
                        <p class="">Poster Phone: {{ $good->poster_phone }}</p>
                        <p class="">Price: {{ $good->price }}</p>
                        <div class="d-flex justify-content-center">
                            <a class="btn btn-square btn-dark m-1" href=""><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-square btn-dark m-1" href=""><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-square btn-dark m-1" href=""><i class="fab fa-youtube"></i></a>
                            <a class="btn btn-square btn-dark m-1" href=""><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            

            <div class="col-lg-3 d-none d-lg-block">
                <div class="testimonial-right h-100">
                    <img class="img-fluid animated pulse infinite" src="img/1.png" alt="" />
                    <img class="img-fluid animated pulse infinite" src="img/2.png" alt="" />
                    <img class="img-fluid animated pulse infinite" src="img/3.png" alt="" />
                </div>
            </div>
        </div>
        <div class="text-center my-5">
            <a href="/allgoods" class="btn btn-primary">All Goods</a>
        </div>
    </div>
</div>
