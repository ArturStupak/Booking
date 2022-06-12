@extends('layouts.app')

@section('content')
<div id="booking" class="section">
    <div class="ads_container">
        <div class="ads">
            @foreach($places as $place)
                <div class="card ads_card"  style="width: 18rem;">
                    <img src="{{$place->relationship->image}}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">{{$place->name}}</h5>
                        <p class="card-text">Kaina vienam asmeniui: {{$place->price}}</p>
                        <p class="card-text">{{$place->description}}</p>
                        <a href="{{route('place.edit', $place->id)}}" class="btn btn-primary">Plačiau</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</div>
@endsection

