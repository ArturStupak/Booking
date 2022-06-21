@extends('layouts.app')

@section('content')
<div id="booking" class="section">
    <div class="ads_container">
        <div class="ads">
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
                            <a href="{{route('place.edit', $place->id)}}" class="btn btn-primary">Plačiau</a>
                            <a href="{{route('places.deletePlace', $place->id)}}" class="btn btn-primary">Pašalinti</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</div>
@endsection

