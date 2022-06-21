
@extends('layouts.app')

@section('content')
{{--<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.css">--}}
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="//resources/demos/style.css">

<div id="booking" class="section about">
    <div class="slide_photo">
        <div class="container about">
        @foreach($images as $image)
            <!-- Full-width images with number text -->
                <div class="mySlides">
                    <img src="{{$image->image}}" style="width:100%">
                </div>
        @endforeach
            <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
            <a class="next" onclick="plusSlides(1)">&#10095;</a>
            <div class="row">
                @foreach($images as $image)
                    <div class="column">
                        <img class="demo cursor" src="{{$image->image}}" style="width:100%" onclick="currentSlide(1)">
                    </div>
                @endforeach
            </div>
        </div>
        <div class="col-md-6 fullstory-content-right">
            <div class="col-md-12">
                <div class="row offer">
                    <div class="offer-container">
                        <div class="clearfix">
                            <div class="col-md-12 text-center">
                                <p>{{$places->name}}</p>
                                <div class="subhead">informacija apie sodyba</div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="info">
                                    <p>Adresas: {{$places->adress}}</p>
                                </div>
                                <div class="info">
                                    <p>Kontaktai: {{$places->phonenumber}}</p>
                                </div>
                                <div class="info">
                                    <p>Kaina žmogui: {{$places->price}}</p>
                                </div>
                                <div class="info">
                                    <p>Maksimalus žmonių kiekis: {{$places->max_number_of_people}}</p>
                                </div>
                                <div class="info">
                                    <p>Papildomos paslaugos:</p>
                                    <div class="row">
                                        @foreach($checks as $check)
                                        <div>
                                            <p>{{$check->atributes->label}}</p>
                                        </div>
                                        @endforeach

                                    </div>
                                </div>
                                <div class="info">
                                    <div class="info">
                                        <p>Aprašymas: {{$places->description}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="container mt-5" style="max-width: 200px">
                                    <h2 class="mb-4">Užimtumas</h2>
                                    <div class="form-group">
                                        <div class='input-group date' id='datetimepicker'>
                                            <input type="hidden" id="rezervdate" value="{{$dates}}">
                                            <input type="text" id="datepicker" name="date" class="form-control datepicker" autocomplete="off">
                                            <span class="input-group-addon">
                                          <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="rezervasion">
                                        <a href="{{route('booking.rezervation', $places->id)}}">Rezervacija</a>
                                    </div>
                                </div>
                            </div>
                        </div>
{{--                                        <label for="period" class="col-md-4 col-form-label text-md-end">{{ __('Užimtumas') }}</label>--}}
{{--                                        <input type="date" id="start" name="trip-start"--}}
{{--                                               value="2018-07-22"--}}
{{--                                               min="2022-01-01" max="2024-12-31">--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('js/datepicker.js')}}"></script>
<script>
    let slideIndex = 1;
    showSlides(slideIndex);

    function plusSlides(n) {
        showSlides(slideIndex += n);
    }

    function currentSlide(n) {
        showSlides(slideIndex = n);
    }

    function showSlides(n) {
        let i;
        let slides = document.getElementsByClassName("mySlides");
        let dots = document.getElementsByClassName("demo");
        let captionText = document.getElementById("caption");
        if (n > slides.length) {slideIndex = 1}
        if (n < 1) {slideIndex = slides.length}
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" active", "");
        }
        slides[slideIndex-1].style.display = "block";
        dots[slideIndex-1].className += " active";
        captionText.innerHTML = dots[slideIndex-1].alt;
    }
</script>

</div>

@endsection

