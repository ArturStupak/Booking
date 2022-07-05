@extends('layouts.app')

@section('content')
<div id="booking" class="section">
    <div class="d-flex flex-column">
        <div class="p-2">
            <div class="col-md-4 ">
                <div class="booking-cta">
                    <h1>Mano sodybos</h1>
                </div>
            </div>
            <div class="d-flex flex-column">
                <div class="col-md-8">
                    <div class="ads_container">
                        <div class="ads">
                            @foreach($places as $place)
                                <div class="card ads_card"  style="width: 20rem;">
                                    @if(!empty($place->getFeaturedImage()->image))
                                    <img src="{{asset($place->getFeaturedImage()->image)}}" class="card-img-top" alt="...">
                                    @endif
                                    <div class="card-body justify-content-left">
                                        <h5 class="card-title">{{$place->name}}</h5>
                                        <h5 class="card-title">Kaina vienam asmeniui:</h5>
                                        <p class="card-text">{{$place->price}} Eur</p>
                                        <h5 class="card-title">Apie sodybą:</h5>
                                        <p class="card-text description">{{$place->description}}</p>
                                        <div class="d-flex flex-column">
                                            <div class="p-2">
                                                <a href="{{route('place.edit', $place->id)}}" class="btn btn-primary">Plačiau</a>
                                            </div>
                                            <div class="p-2">
                                                <a href="{{route('places.deletePlace', $place->id)}}" class="btn btn-primary">Pašalinti</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

