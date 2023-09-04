@extends('layouts.master')

@section('content')
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto" style="max-width: 500px">
                <h1 class="display-6 mb-5">All Items Posted</h1>
            </div>
            <div class="row g-4">
                @foreach ($goods as $good)
                    <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">

                        <div class="team-item rounded">
                            <img class="img-fluid" src="img/book1.jpg" alt="" />
                            <div class="text-center p-4">
                                <p>Poster: {{ $good->poster_name }}</p>
                                <h5>{{ $good->item_name }}</h5>
                                <span>{{ $good->price }}</span>
                            </div>
                            <div class="team-text text-center bg-white p-4">

                                <p class="">{{ $good->poster_phone }}</p>
                                <p class="">{{ $good->poster_email }}</p>

                                <div class="d-flex justify-content-center">
                                    <a class="btn btn-square btn-light m-1" href=""><i
                                            class="fab fa-twitter"></i></a>
                                    <a class="btn btn-square btn-light m-1" href=""><i
                                            class="fab fa-facebook-f"></i></a>
                                    <a class="btn btn-square btn-light m-1" href=""><i
                                            class="fab fa-youtube"></i></a>
                                    <a class="btn btn-square btn-light m-1" href=""><i
                                            class="fab fa-linkedin-in"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
