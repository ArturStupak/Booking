@extends('layouts.app')

@section('content')
<div id="booking" class="section">
    <div class="d-flex flex-column">
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
