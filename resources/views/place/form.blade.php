
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
<div id="booking" class="section">
    <div class="d-flex flex-column">
        <div class="p-2">
            <div class="col-md-4 ">
                <div class="booking-cta">
                    <h1>Pridėti sodybą</h1>
                </div>
            </div>
            <div class="d-flex flex-column ">
                <div class="card">
                    <div class="card-header">{{ __('Įkelti skelbimą') }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{route('place.store')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Sodybos pavadinimas') }}</label>
                                <div class="col-md-6">
                                    <input type="text" name="name" class="form-control" placeholder="Sodyba">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="adress" class="col-md-4 col-form-label text-md-end">{{ __('Adresas') }}</label>
                                <div class="col-md-6">
                                    <input type="text" name="adress" class="form-control" placeholder="Adresas">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="phonenumber" class="col-md-4 col-form-label text-md-end">{{ __('Tel. numeris') }}</label>
                                <div class="col-md-6">
                                    <input type="number" name="phonenumber" class="form-control" placeholder="Tel. numeris">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="city" class="col-md-4 col-form-label text-md-end">{{ __('Miestas') }}</label>
                                <div class="col-md-6">
                                    <select name="city"  class="form-control">
                                        @foreach($cities as $city)
                                            <option value="{{$city->id}}">{{$city->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="price" class="col-md-4 col-form-label text-md-end">{{ __('Kaina') }}</label>
                                <div class="col-md-6">
                                    <input type="number" name="price" class="form-control" placeholder="Kaina asm">
                                </div>
                            </div>
                            <div class="d-flex flex-column">
                                @foreach($atributes as $atribute)
                                    <div>
                                        <input type="checkbox" name="atributes[]" class="pool"  value="{{$atribute->id}}">
                                        <label for="{{$atribute->name}}">{{$atribute->label}}</label>
                                    </div>
                                @endforeach

                            </div>
                            <div class="row mb-3">
                                <label for="max_number_of_people" class="col-md-4 col-form-label text-md-end">{{ __('Maksimalus žmonių skaičius') }}</label>
                                <div class="col-md-6">
                                    <input id="max_number_of_people" type="number" class="form-control" name="max_number_of_people">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="description" class="col-md-4 col-form-label text-md-end">{{ __('Aprašymas') }}</label>
                                <div class="col-md-6">
                                <textarea name="description" class="form-control">

                                </textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="images" style="width: 120px">{{ __('Nuotrauka') }}</label>
                                <div class="col-md-9 d-flex">
                                    <input
                                        type="file"
                                        name="image[]"
                                        id="inputImage"
                                        class="form-control @error('image') is-invalid @enderror"

                                    >
                                    <input type="number"  class="form-control" name="position[]" style="width: 40px" min="0" max="3" value="0">
                                    <label for="position" style="width: 60px">{{ __('Pozicija') }}</label>

                                    @error('image')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="images" style="width: 120px">{{ __('Nuotrauka') }}</label>
                                <div class="col-md-9 d-flex">
                                    <input
                                        type="file"
                                        name="image[]"
                                        id="inputImage"
                                        class="form-control @error('image') is-invalid @enderror"

                                    >
                                    <input type="number"  class="form-control" name="position[]" style="width: 40px" min="0" max="3" value="0">
                                    <label for="position" style="width: 60px">{{ __('Pozicija') }}</label>

                                    @error('image')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="images" style="width: 120px">{{ __('Nuotrauka') }}</label>
                                <div class="col-md-9 d-flex">
                                    <input
                                        type="file"
                                        name="image[]"
                                        id="inputImage"
                                        class="form-control @error('image') is-invalid @enderror"

                                    >
                                    <input type="number"  class="form-control" name="position[]" style="width: 40px" min="0" max="3" value="0">
                                    <label for="position" style="width: 60px">{{ __('Pozicija') }}</label>

                                    @error('image')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
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
</div>
@endsection
