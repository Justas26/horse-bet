@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Better create</div>
                <div class="card-body">
                    <form method="POST" action="{{route('better.store')}}">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" value="{{old('name')}}">
                            <small class="form-text text-muted">Better name.</small>
                        </div>
                        <div class="form-group">
                            <label>Surname</label>
                            <input type="text" name="surname" class="form-control" value="{{old('surname')}}">
                            <small class="form-text text-muted">Better surname.</small>
                        </div>
                           <div class="form-group">
                            <label>Bet</label>
                            <input type="text" name="bet" class="form-control" value="{{old('bet')}}">
                            <small class="form-text text-muted">Better bet</small>
                        </div>
                          <select name="horse_id">
                            @foreach ($horses as $horse)
                            <option value="{{$horse->id}}">{{$horse->name}}</option>
                            @endforeach
                        </select>
                        @csrf
                        <button class="btn btn-primary" type="submit">ADD</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection