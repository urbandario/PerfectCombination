@extends('layouts.app')
@section('styles')
<style>
    @media (min-width: 576px) {
  .img {
    height: 300px;
  }
}

@media (min-width: 768px) {
  .img {
    height: 450px;
  }
}

@media (min-width: 992px) {
  .img {
    height: 500px;
  }
}

@media (min-width: 1200px) {
  .img{
    height: 600px;
  }
}

.custom-text{
    -webkit-text-stroke: 2px black; /* width and color */
    border: black;
    font-style: italic;
    text-shadow: 8px 4px 11px rgba(0, 0, 0, 1);
}
.neon {
    position: relative;
    display: inline-block;
    padding: 15px 30px;
    color: #21f333;
    text-transform: uppercase;
    letter-spacing: 4px;
    text-decoration: none;
    font-size: 24px;
    overflow: hidden;
    transition: 0.2s;
}



.neon:hover {
    color: #388425;
    background: #21f321;
    box-shadow: 0 0 10px #21f33d, 0 0 40px #21f33d, 0 0 80px #21f33d;
    transition-delay: 1s;
}


.neon span {
    position: absolute;
    display: block;
}




.neon span:nth-child(1) {
    top: 0;
    left: -100%;
    width: 100%;
    height: 2px;
    background: linear-gradient(90deg, transparent, #21f33d);
}



.neon:hover span:nth-child(1) {
    left: 100%;
    transition: 1s;
}


.neon span:nth-child(3) {
    bottom: 0;
    right: -100%;
    width: 100%;
    height: 2px;
    background: linear-gradient(270deg, transparent, #21f33d);
}

.neon:hover span:nth-child(3) {
    right: 100%;
    transition: 1s;
    transition-delay: 0.5s;
}



.neon span:nth-child(2) {
    top: -100%;
    right: 0;
    width: 2px;
    height: 100%;
    background: linear-gradient(180deg, transparent, #21f33d);
}

.neon:hover span:nth-child(2) {
    top: 100%;
    transition: 1s;
    transition-delay: 0.25s;
}



.neon span:nth-child(4) {
    bottom: -100%;
    left: 0;
    width: 2px;
    height: 100%;
    background: linear-gradient(360deg, transparent, #21f33d);
}

.neon:hover span:nth-child(4) {
    bottom: 100%;
    transition: 1s;
    transition-delay: 0.75s;
}

</style>
@endsection
@section('content')
<div class="justify-content-center" style="margin-top: -24px;  box-shadow: 0 8px 20px 10px black;">
    <div class="d-lg-flex d-xl-flex">
        <div style="width: 100%;">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                  <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                  <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                  <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <img class="d-block w-100 img" src="https://wallpaperaccess.com/full/1350198.jpg" alt="First slide">
                </div>
                  <div class="carousel-item">
                    <img class="d-block w-100 img" src="https://wallpaperaccess.com/full/1350197.jpg" alt="Second slide">
                </div>
                  <div class="carousel-item">
                    <img class="d-block w-100 img" src="https://4kwallpaper.wiki/wp-content/uploads/2019/07/32733.jpg" alt="Third slide">
                </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="sr-only">Next</span>
                </a>
              </div>
        </div>
    </div>
</div>
<div class="container main mt-4 mb-5">
    <div class="row text-center">
        <div class="col-12">
            <hr style="border:1px solid black">
            <h2 class="text-center custom-text ">‘The last three or four reps is what makes the muscle grow. This area of pain divides a champion from someone who is not a champion.’<br> — Arnold Schwarzenegger, seven-time Mr. Olympia</h2>
            <hr style="border:1px solid black">
        </div>
        <div class="col-12">
            <div style="background-color: white;border: 2px solid white;border-radius:25px">
                <h3 class="custom-text p-5">Check out available trainings! And you will find your way out</h3>
                <div class="row">
                    @foreach ($trainings as $training)
                    <div class="col-4 p-5">
                        <h4>{{ $training->name }}</h4>
                        <h5>{{ $training->description }}</h5>
                        <p>Trainer: {{ $training->user->name }}</p>
                    </div>
                    @endforeach
                    
                </div>
                <a class="neon" href="{{ route('trainings') }}">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    Check it!
                  </a>
            </div>
        </div>
    </div>
</div>
@endsection
