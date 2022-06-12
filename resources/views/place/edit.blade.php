
@extends('layouts.app')

@section('content')
<div id="booking" class="section about">
    <div class="slide_photo">
        <div class="container about">
            @foreach($images as $image)
            <!-- Full-width images with number text -->
            <div class="mySlides">
                <div class="numbertext">1 / 6</div>
                <img src="{{$image->image}}" style="width:100%">
            </div>
            @endforeach


            <!-- Next and previous buttons -->
            <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
            <a class="next" onclick="plusSlides(1)">&#10095;</a>



            <!-- Thumbnail images -->
            <div class="row">
                @foreach($images as $image)
                <div class="column">
                    <img class="demo cursor" src="git {{$image->image}}" style="width:100%" onclick="currentSlide(1)">
                </div>
                @endforeach

            </div>
        </div>
    </div>
    <div class="info">

            <div class="row justify-content-center">
                    <div class="card edit">
                        <div class="card-header">{{ __('Įkelti skelbimą') }}</div>
                        <div class="card-body">
                            <form method="POST" action="{{route('place.update', $places->id)}}">
                                @csrf
                                @method('PUT')
                                <div class="row mb-3">
                                    <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Sodybos pavadinimas') }}</label>
                                    <div class="col-md-6">
                                        <input type="text" name="name" value="{{$places->name}}" class="form-control" placeholder="Sodyba">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="adress" class="col-md-4 col-form-label text-md-end">{{ __('Adresas') }}</label>
                                    <div class="col-md-6">
                                        <input type="text" value="{{$places->adress}}" name="adress" class="form-control" placeholder="Adresas">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="city" class="col-md-4 col-form-label text-md-end">{{ __('Miestas') }}</label>
                                    <div class="col-md-6">
                                        <select name="city"  class="form-control">
                                            @foreach($cities as $city)
                                                @if($city->id == $places->city_id)
                                                <option selected value="{{$city->id}}">{{$city->name}}</option>
                                                @else
                                                <option value="{{$city->id}}">{{$city->name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="price" class="col-md-4 col-form-label text-md-end">{{ __('Kaina') }}</label>
                                    <div class="col-md-6">
                                        <input type="number" value="{{$places->price}}" name="price" class="form-control" placeholder="Kaina asm">
                                    </div>
                                </div>
                                <div class="d-flex flex-column">
                                    <div>
                                        @foreach($atributes as $atribute)
                                            @if(in_array($atribute->id, $checks))
                                                <div>
                                                    <input type="checkbox" name="atributes[]" class="pool"  value="{{$atribute->id}}" checked>
                                                    <label for="{{$atribute->name}}">{{$atribute->label}}</label>
                                                </div>
                                            @else
                                                <div>
                                                    <input type="checkbox" name="atributes[]" class="pool"  value="{{$atribute->id}}">
                                                    <label for="{{$atribute->name}}">{{$atribute->label}}</label>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="max_number_of_people" class="col-md-4 col-form-label text-md-end">{{ __('Maksimalus žmonių skaičius') }}</label>
                                    <div class="col-md-6">
                                        <input id="max_number_of_people" type="number" class="form-control" name="max_number_of_people" value="{{$places->max_number_of_people}}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="description" class="col-md-4 col-form-label text-md-end">{{ __('Aprašymas') }}</label>
                                    <div class="col-md-6">
                                <textarea name="description" class="form-control" >
                                    {{$places->description}}
                                </textarea>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    @foreach($images as $image)
                                    <label for="image" class="col-md-4 col-form-label text-md-end">{{ __('Nuotrauka') }}</label>
                                    <div class="col-md-6">
                                        <input type="text" name="images[]" class="form-control" placeholder="Nuotrauka" value="{{$image->image}}">
                                    </div>
                                    @endforeach

                                </div>
                                <div class="row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Įkelti') }}                                    </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
            </div>
    </div>
</div>
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
@endsection
