
@extends('layouts.app')

@section('content')

@if (\Session::has('success'))
    <div class="alert alert-success">
        <ul>
            <li>{!! \Session::get('success') !!}</li>
        </ul>
    </div>
@endif
@if (\Session::has('error'))
    <div class="alert alert-danger">
        <ul>
            <li>{!! \Session::get('error') !!}</li>
        </ul>
    </div>
@endif

<div id="booking" class="section d-flex flex-column">
    @if($images->count() !== 0)
        <div class="slide_photo d-flex justify-content-center">
            <div class="d-flex flex-column">
                <div class="p-2">
                    <div class="d-flex justify-content-center">
                        <div class="container about" >
                            @foreach($images as $image)
                                <div class="mySlides" >
                                    <img src="{{asset($image->image)}}" style="width:100%">
                                </div>
                            @endforeach
                            <a class="prev">&#10094;</a>
                            <a class="next">&#10095;</a>
                            <div class="row">
                                @foreach($images as $key => $image)
                                    <div class="column">
                                        <img data-slide="{{$key}}" class="demo cursor my-slide" src="{{asset($image->image)}}" style="width:100%" >
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
                                                <hr>
                                                <div class="info">
                                                    <p>Kontaktai: {{$places->phonenumber}}</p>
                                                </div>
                                                <hr>
                                                <div class="info">
                                                    <p>Kaina žmogui: {{$places->price}}</p>
                                                </div>
                                                <hr>
                                                <div class="info">
                                                    <p>Maksimalus žmonių kiekis: {{$places->max_number_of_people}}</p>
                                                </div>
                                                <hr>
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
                                                <hr>
                                                @auth
                                                    @if($places->user_id !== $currentUser)
                                                        @if($average == null)
                                                        <form class="form" method="POST" action="{{route('place.saverating')}}">
                                                            @csrf
                                                            <div class="d-flex justify-content-center">
                                                                <div class="rating">
                                                                    <input type="radio"  name="rating" value="5" id="5"><label for="5">☆</label>
                                                                    <input type="radio"  name="rating" value="4" id="4"><label for="4">☆</label>
                                                                    <input type="radio" name="rating" value="3" id="3"><label for="3">☆</label>
                                                                    <input type="radio" name="rating" value="2" id="2"><label for="2">☆</label>
                                                                    <input type="radio" name="rating" value="1" id="1"><label for="1">☆</label>
                                                                </div>
                                                                <div>
                                                                    <input type="hidden" name="place_id" value="{{$places->id}}">
                                                                    <button type="submit" class="btn btn-primary">
                                                                        {{ __('Įvertinti') }}                                    </button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                        <hr>
                                                        @else
                                                            <div class="d-flex justify-content-center">
                                                                <div class="rating after">
                                                                    <label>Rating: {{$average}}</label>
                                                                </div>
                                                            </div>
                                                            <hr>
                                                        @endif
                                                    @else
                                                    <div class="d-flex justify-content-center">
                                                        <div class="rating after">
                                                            <label>Rating: {{$average}}</label>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    @endif
                                                @else
                                                <div class="d-flex justify-content-center">
                                                    <div class="rating after">
                                                        <label>Rating: {{$average}}</label>
                                                    </div>
                                                </div>
                                                <hr>
                                                @endauth
                                                <div class="info">
                                                    <div class="info after">
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
                                                @if($places->user_id !== $currentUser)
                                                    <div class="col-md-8">
                                                        <div class="rezervasion">
                                                            <a href="{{route('booking.rezervation', $places->id)}}">Rezervacija</a>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="p2">
                    <div class="container d-flex justify-content-end mt-5 ">
                        <div class="d-flex flex-column">
                            <div class="p-2">
                                @foreach($comments as $comment)
                                <div class="d-flex justify-content-center py-2">
                                    <div class="second py-2 px-2"> <span class="text1">{{$comment->comment}}</span>
                                        <div class="d-flex justify-content-between py-1 pt-2">
                                            <div><span class="text2">{{$comment->name}}</span></div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div class="p-2">
                                <form method="POST" class="form-inline" role="form" action="{{route('comment')}}">
                                    @csrf
                                    <div  class="d-flex flex-column">
                                        <div class="p-2">
                                            <input class="form-control" type="text" name="name" placeholder="Vardas">
                                        </div>
                                        <div class="p-2">
                                            <div class="form-group">
                                                <input  name="comment" class="form-control" type="text" placeholder="Jūsų komentaras" />
                                            </div>
                                            <div class="form-group">
                                                <input type="hidden" name="place_id" value="{{$places->id}}">
                                                <input type="submit" value="Sukurti" class="btn btn-primary mt-1">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="slide_photo d-flex justify-content-center">
            <div class="d-flex flex-column">
                <div class="p-2">
                    <div class="d-flex justify-content-end">
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
                                                <div class="info ">
                                                    <p>Adresas: {{$places->adress}}</p>
                                                </div>
                                                <hr>
                                                <div class="info">
                                                    <p>Kontaktai: {{$places->phonenumber}}</p>
                                                </div>
                                                <hr>
                                                <div class="info" >
                                                    <p>Kaina žmogui: {{$places->price}}</p>
                                                </div>
                                                <hr>
                                                <div class="info">
                                                    <p>Maksimalus žmonių kiekis: {{$places->max_number_of_people}}</p>
                                                </div>
                                                <hr>
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
                                                <hr>
                                                @auth
                                                    @if($places->user_id !== $currentUser)
                                                        @if($average == null)
                                                            <form class="form" method="POST" action="{{route('place.saverating')}}">
                                                                @csrf
                                                                <div class="d-flex justify-content-center">
                                                                    <div class="rating">
                                                                        <input type="radio"  name="rating" value="5" id="5"><label for="5">☆</label>
                                                                        <input type="radio"  name="rating" value="4" id="4"><label for="4">☆</label>
                                                                        <input type="radio" name="rating" value="3" id="3"><label for="3">☆</label>
                                                                        <input type="radio" name="rating" value="2" id="2"><label for="2">☆</label>
                                                                        <input type="radio" name="rating" value="1" id="1"><label for="1">☆</label>
                                                                    </div>
                                                                    <div>
                                                                        <input type="hidden" name="place_id" value="{{$places->id}}">
                                                                        <button type="submit" class="btn btn-primary">
                                                                            {{ __('Įvertinti') }}                                    </button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                            <hr>
                                                        @else
                                                            <div class="d-flex justify-content-center">
                                                                <div class="rating">
                                                                    <label>Rating: {{$average}}</label>
                                                                </div>
                                                            </div>
                                                            <hr>
                                                        @endif
                                                    @else
                                                        <div class="d-flex justify-content-center">
                                                            <div class="rating">
                                                                <label>Rating: {{$average}}</label>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                    @endif
                                                @else
                                                    <div class="d-flex justify-content-center">
                                                        <div class="rating">
                                                            <label>Rating: {{$average}}</label>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                @endauth
                                                <div class="info ">
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
                                                @if($places->user_id !== $currentUser)
                                                    <div class="col-md-8">
                                                        <div class="rezervasion">
                                                            <a href="{{route('booking.rezervation', $places->id)}}">Rezervacija</a>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="p2">
                    <div class="container d-flex justify-content-end mt-5 ">
                        <div class="d-flex flex-column">
                            <div class="p-2">
                                @foreach($comments as $comment)
                                    <div class="d-flex justify-content-center py-2">
                                        <div class="second py-2 px-2"> <span class="text1">{{$comment->comment}}</span>
                                            <div class="d-flex justify-content-between py-1 pt-2">
                                                <div><span class="text2">{{$comment->name}}</span></div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="p-2">
                                <form method="POST" class="form-inline" role="form" action="{{route('comment')}}">
                                    @csrf
                                    <div  class="d-flex flex-column">
                                        <div class="p-2">
                                            <input class="form-control" type="text" name="name" placeholder="Vardas">
                                        </div>
                                        <div class="p-2">
                                            <div class="form-group">
                                                <input  name="comment" class="form-control" type="text" placeholder="Jūsų komentaras" />
                                            </div>
                                            <div class="form-group">
                                                <input type="hidden" name="place_id" value="{{$places->id}}">
                                                <input type="submit" value="Sukurti" class="btn btn-primary mt-1">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

<script src="{{asset('js/datepicker.js')}}"></script>
<script src="{{asset('js/showSlides.js')}}"></script>




@endsection

