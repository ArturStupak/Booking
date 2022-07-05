
@extends('layouts.app')
@section('content')
<div id="booking" class="section edit">
        <div class="rezervation">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">{{ __('Rezervacija') }}</div>
                            <div class="card-body">
                                <form method="POST" action="{{route('booking.store')}}" >
                                    @csrf
                                    <div class="row mb-3">
                                        <label for="name"
                                               class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>
                                        <div class="col-md-6">
                                            <input type="hidden" name="place_id" value="{{$places->id}}">
                                            <input type="text" name="name" class="form-control" placeholder="Name">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="email"
                                               class="col-md-4 col-form-label text-md-end">{{ __('Email') }}</label>
                                        <div class="col-md-6">
                                            <input type="text" name="email" class="form-control" placeholder="Name">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div>
                                        <label for="period" class="col-md-4 col-form-label text-md-end">{{ __('Atvykimas') }}</label>
                                            <div class="form-group row mb-3">
                                                <div class='input-group date' id='datetimepicker'>
                                                    <input type="hidden" id="rezervdate" value="{{$dates}}">
                                                    <input type="text" id="arrival" name="arrival" class="form-control datepicker" autocomplete="off" >
                                                    <span class="input-group-addon">
                                              <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div>
                                            <label for="period" class="col-md-4 col-form-label text-md-end">{{ __('Išvykimas') }}</label>
                                            <div class="form-group row mb-3">
                                                <div class='input-group date' id='datetimepicker'>
                                                    <input type="hidden" id="rezervdate" value="{{$dates}}">
                                                    <input type="text" id="departure" name="departure" class="form-control datepicker" autocomplete="off">
                                                    <span class="input-group-addon">
                                                  <span class="glyphicon glyphicon-calendar"></span>
                                                </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="email"
                                               class="col-md-4 col-form-label text-md-end">{{ __('Žmonių skaičius') }}</label>
                                        <div class="col-md-6">
                                            <input type="number" name="number_of_people" class="form-control" min="1" max="{{$places->max_number_of_people}}" >
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="d-flex justify-content-center">
                                            <div>
                                                @foreach($checks as $check )
                                                    <div>
                                                        <label for="{{$check->atributes->name}}">{{$check->atributes->label}}</label>
                                                        <input type="checkbox" name="atributes[]" class="pool"  value="{{$check->atributes->id}}">
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Rezervuoti') }}                                    </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

</div>
<script src="{{asset('js/datepicker.js')}}"></script>

@endsection


