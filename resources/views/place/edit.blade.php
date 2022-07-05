
@extends('layouts.app')

@section('content')
@if (\Session::has('error'))
    <div class="alert alert-danger">
        <ul>
            <li>{!! \Session::get('error') !!}</li>
        </ul>
    </div>
@endif
<div id="booking" class="section edit">
    <div class="row justify-content-center">
            <div class="card edit">
                <div class="card-header">{{ __('Įkelti skelbimą') }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{route('place.update', $places->id)}}" enctype="multipart/form-data">
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
                                    <input type="text" value="{{$places->adress}}" name="adress" class="form-control" placeholder="Tel. numeris">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="phomnenumber" class="col-md-4 col-form-label text-md-end">{{ __('Tel. numeris') }}</label>
                                <div class="col-md-6">
                                    <input type="number" value="{{$places->phonenumber}}" name="phonenumber" class="form-control" placeholder="Adresas">
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

                                <div class="d-flex flex-row justify-content-center">
                                    @foreach($atributes as $atribute)
                                        @if(in_array($atribute->id, $checks))
                                            <div class="p-2">
                                                <input type="checkbox" name="atributes[]" class="pool"  value="{{$atribute->id}}" checked>
                                                <label for="{{$atribute->name}}">{{$atribute->label}}</label>
                                            </div>
                                        @else
                                            <div class="p-2" >
                                                <input type="checkbox" name="atributes[]" class="pool"  value="{{$atribute->id}}">
                                                <label for="{{$atribute->name}}">{{$atribute->label}}</label>
                                            </div>
                                        @endif
                                    @endforeach
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
                            @if($count == 3)
                                <div class="row mb-3">
                                </div>
                            @endif
                            @if($count == 2)
                                <div class="row mb-3 d-flex">
                                    <div class="d-flex flex-wrap">
                                        <label for="images" class="col-md-4 col-form-label text-md-end">{{ __('Nuotrauka') }}</label>
                                        <div class="col-md-6 d-flex">
                                            <input
                                                type="file"
                                                name="image[]"
                                                id="inputImage"
                                                class="form-control @error('image') is-invalid @enderror"
                                            >
                                            @error('image')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div>
                                            <input type="number" class="form-control" name="position[]" style="width: 40px" min="0" max="3" value="0">
                                        </div>
                                        <div>
                                            <label for="position" >{{ __('Pozicija') }}</label>
                                        </div>

                                    </div>
                                </div>
                            @endif
                            @if($count == 1)
                                <div class="row mb-3 d-flex">
                                    <div class="d-flex flex-wrap">
                                        <label for="images" class="col-md-4 col-form-label text-md-end">{{ __('Nuotrauka') }}</label>
                                        <div class="col-md-6 d-flex">
                                            <input
                                                type="file"
                                                name="image[]"
                                                id="inputImage"
                                                class="form-control @error('image') is-invalid @enderror"
                                            >
                                            <input type="number" class="form-control" name="position[]" style="width: 40px" min="0" max="3" value="0">
                                            @error('image')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                    </div>
                                </div>
                                <div class="row mb-3 d-flex">
                                    <div class="d-flex flex-wrap">
                                        <label for="images" class="col-md-4 col-form-label text-md-end">{{ __('Nuotrauka') }}</label>
                                        <div class="col-md-6 d-flex">
                                            <input
                                                type="file"
                                                name="image[]"
                                                id="inputImage"
                                                class="form-control @error('image') is-invalid @enderror"
                                            >
                                            <input type="number" class="form-control" name="position[]" style="width: 40px" min="0" max="3" value="0">
                                            @error('image')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                    </div>
                                </div>
                            @endif
                            @if($count == 0)
                                <div class="row mb-3 d-flex">
                                    <div class="d-flex flex-wrap">
                                        <label for="images" class="col-md-4 col-form-label text-md-end">{{ __('Nuotrauka') }}</label>
                                        <div class="col-md-6 d-flex">
                                            <input
                                                type="file"
                                                name="image[]"
                                                id="inputImage"
                                                class="form-control @error('image') is-invalid @enderror"
                                            >
                                            <input type="number" class="form-control" name="position[]" style="width: 40px" min="0" max="3" value="0">
                                            @error('image')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                    </div>
                                </div>
                                <div class="row mb-3 d-flex">
                                    <div class="d-flex flex-wrap">
                                        <label for="images" class="col-md-4 col-form-label text-md-end">{{ __('Nuotrauka') }}</label>
                                        <div class="col-md-6 d-flex">
                                            <input
                                                type="file"
                                                name="image[]"
                                                id="inputImage"
                                                class="form-control @error('image') is-invalid @enderror"
                                            >
                                            <input type="number" class="form-control" name="position[]" style="width: 40px" min="0" max="3" value="0">
                                            @error('image')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                    </div>
                                </div>
                                <div class="row mb-3 d-flex">
                                    <div class="d-flex flex-wrap">
                                        <label for="images" class="col-md-4 col-form-label text-md-end">{{ __('Nuotrauka') }}</label>
                                        <div class="col-md-6 d-flex">
                                            <input
                                                type="file"
                                                name="image[]"
                                                id="inputImage"
                                                class="form-control @error('image') is-invalid @enderror"
                                            >
                                            <input type="number" class="form-control" name="position[]" style="width: 40px" min="0" max="3" value="0">
                                            @error('image')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                    </div>
                                </div>
                            @endif
                            <div class="row mb-3">
                                <div class="row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Atnaujinti') }}                                    </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        @if(!$images->isEmpty())
                            <div class="row mb-3">
                                <label for="gallery" class="col-md-4 col-form-label text-md">{{ __('Nuotraukos:') }}</label>
                            </div>
                            <div class="row mb-3 ">
                                @foreach($images as $image)
                                    <form method="POST" action="{{route('places.deleteImage')}}">
                                        @csrf
                                        @method('POST')
                                        <div class="row mb-3 d-flex justify-content-end">
                                            <div class="col-md-2">
                                                <label for="position" class="col-form-label text-md">{{ __('Position:').' '.$image->position }}</label>
                                            </div>
                                            <div class="col-md-10">
                                                <img src="{{asset($image->image)}}" style="width:30%">
                                                <input type="hidden" name="image_id" value="{{$image->id}}">
                                                <button type="submit" class="btn btn-primary">
                                                    {{ __('Delete') }}
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>

    </div>
</div>
@endsection
