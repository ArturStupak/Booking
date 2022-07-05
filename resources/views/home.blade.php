@extends('layouts.app')

@section('content')
<div id="booking" class="section">
    <div class="d-flex flex-column">
        <div class="p-2">
            <div class="col-md-4 ">
                <div class="booking-cta">
                    <h1>Sodybos</h1>
                </div>
            </div>
            <div class="d-flex flex-column ">
                <div class="p-2 filters">
                    <div class="d-flex justify-content-left selectors">
                        <form method="GET" action="{{route('place.filter')}}">
                            <div class="d-flex flex-wrap">
                                <div class="p-2 city">
                                    <div class="col-md-6">
                                        <label for="maxPeoples" class="col-md-4 col-form-label text-md-end">{{ __('Miestas') }}</label>
                                        <select name="city" style="width: 100px;"  class="form-control">
                                            <option value="">All</option>
                                            @foreach($cities as $city)
                                                <option value="{{$city->id}}">{{$city->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="p-2 maxPeople">
                                    <div class="col-md-6">
                                        <label for="maxPeoples" class="col-md-4 col-form-label text-md-end">{{ __('Maks. žmonių') }}</label>
                                        <select name="maxPeoples" style="width: 100px;"  class="form-control">
                                            <option value="">All</option>
                                            @foreach($maxPeoples as $people)
                                                <option value="{{$people}}">{{$people}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="p-2  atributes">
                                    <div class="selectors">
                                        @foreach($atributes as $atribute)
                                            <div class="col-md-6">
                                                <input type="checkbox" name="atributes[]" class="pool"  value="{{$atribute->id}}">
                                                <label for="{{$atribute->name}}">{{$atribute->label}}</label>
                                                </select>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="p-2 button">
                                    <div class="col-md-6">
                                        <input type="submit" value="Ieškoti" class="btn btn-primary">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="d-flex align-content-around p-2 cards  ">
                    @foreach($places as $place)
                        <div class="card ads_card"  style="width: 20rem;">
                            @if(!empty($place->getFeaturedImage()->image))
                                <img src="{{asset($place->getFeaturedImage()->image)}}" class="card-img-top" alt="...">
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">{{$place->name}}</h5>
                                <h5 class="card-title">Kaina vienam asmeniui:</h5>
                                <p class="card-text">{{$place->price}} Eur</p>
                                <h5 class="card-title">Apie sodybą:</h5>
                                <p class="card-text description">{{$place->description}}</p>
                                <div>
                                    <a href="{{route('place.show', $place->id)}}" class="btn btn-primary">Plačiau</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div>
                    {{ $places->links('pagination::bootstrap-5')}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

