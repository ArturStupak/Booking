@extends('layouts.app')

@section('content')
<h2>Laukite admino patvirtinimo</h2>

<div>
    <a href="{{ route('login') }}" class="btn btn-primary">{{ __('Login') }}</a>
</div>

@endsection
