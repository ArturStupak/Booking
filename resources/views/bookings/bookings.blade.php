@extends('layouts.app')

@section('content')
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
    <div class="container-xl">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-5">
                            <h2>Naujos rezervacijos</h2>
                        </div>

                    </div>
                </div>
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Arrival</th>
                        <th>Departure</th>
                        <th>Number of People</th>
                        <th>Wishes</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($bookings as $element)
                        @foreach($element as $booking)
                        <tr>
                            <td>{{$booking->name}}</td>
                            <td>{{$booking->email}}</td>
                            <td>{{$booking->arrival}}</td>
                            <td>{{$booking->departure}}</td>
                            <td>{{$booking->number_of_people}}</td>
                            <td>@foreach($booking->wishes as $wish)
                                    {{$wish->atributes->name}}
                                @endforeach
                            </td>
                            <td>
                                <a href="{{route('booking.accept', $booking->id)}}" class="btn btn-primary" style="width:90px;">Patvirtinti</a>
                            </td>
                            <td>
                                <a href="{{route('booking.deleteBooking', $booking->id)}}" class="btn btn-primary" data-method="delete"  style="width:90px;">Pašalinti</a>
                            </td>
                        </tr>
                        @endforeach
                    @endforeach

                    </tbody>

                </table>

            </div>
        </div>
    </div>

@endsection

