@extends('layouts.app')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        <form class="form" method="post" action="{{route('admin.update')}}">
                            @csrf
                            {{--                            @method('PUT')--}}
                            <div class="form-group">
                                <input type="hidden" name="user_id" value="{{$user->id}}">
                                <input type="text" name="name" value="{{$user->name}}" class="form-control" placeholder="Name">
                                <input type="text" name="last_name" value="{{$user->last_name}}" class="form-control" placeholder="Last Name">
                                <input type="text" name="email" value="{{$user->email}}" class="form-control" placeholder="Email">
                                <select name="active"  class="form-control">
                                    <option>Active or not</option>
                                        <option @if($user->active == 0) selected value="0" @endif>0</option>
                                        <option @if($user->active == 1) selected value="1" @endif>1</option>
                                </select>
                                <select name="role"  class="form-control">
                                    <option>Role</option>
                                    <option @if($user->role == 1) selected value="1" @endif>1</option>
                                    <option @if($user->role == 2) selected value="2" @endif>2</option>
                                </select>
                                <input type="submit" value="Atnaujinti" class="btn btn-primary">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        function update() {
            var select = document.getElementById('manufacturers_id');
            var option = select.options[select.selectedIndex];

            document.getElementById('value').value = option.value;
            document.getElementById('text').value = option.text;
        }

        update();
    </script>

@endsection

