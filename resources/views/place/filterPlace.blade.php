@extends('layouts.app')

@section('content')
    <div id="booking" class="section">
        <div class="d-flex flex-column">
            <div class="d-flex justify-content-center">
                <div class="d-flex flex-wrap">
                    <div class="p-2">
                        <div class="col-md-6">
                            <label for="maxPeoples" class="col-md-4 col-form-label text-md-end">{{ __('Miestas') }}</label>
                            <select name="city" style="width: 100px;"  class="form-control">
                                @foreach($cities as $city)
                                    <option value="{{$city->id}}">{{$city->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="p-2">
                        <div class="col-md-6">
                            <label for="maxPeoples" class="col-md-4 col-form-label text-md-end">{{ __('Maks. žmonių') }}</label>
                            <select name="maxPeples" style="width: 100px;"  class="form-control">
                                @foreach($maxPeoples as $people)
                                    <option value="{{$people}}">{{$people}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="p-2">
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
                </div>
            </div>
            <div class="p-2">
                <div class="col-md-4 ">
                    <div class="booking-cta">
                        <h1>Most popular booking places</h1>
                    </div>
                </div>
                <div class="d-flex align-content-around ">
                    @foreach($places as $place)
                        <div class="card ads_card"  style="width: 18rem;">
                            @if(!empty($place->relationship->image))
                                <img src="{{$place->relationship->image}}" class="card-img-top" alt="...">
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">{{$place->name}}</h5>
                                <p class="card-text">Kaina vienam asmeniui: {{$place->price}}</p>
                                <p class="card-text">{{$place->description}}</p>
                                <div>
                                    <a href="{{route('place.show', $place->id)}}" class="btn btn-primary">Plačiau</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
