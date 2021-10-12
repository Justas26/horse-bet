@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Better edit</div>
                <div class="card-body">
                    <form method="POST" action="{{route('better.update',$better)}}">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" value="{{old('name',$better->name)}}">
                            <small class="form-text text-muted">Better name.</small>
                        </div>
                        <div class="form-group">
                            <label>Surname</label>
                            <input type="text" name="surname" class="form-control" value="{{old('surname',$better->surname)}}">
                            <small class="form-text text-muted">Better surname.</small>
                        </div>
                           <div class="form-group">
                            <label>Bet</label>
                            <input type="text" name="bet" class="form-control" value="{{old('bet',$better->bet)}}">
                            <small class="form-text text-muted">Better bet.</small>
                        </div>
                          <select name="horse_id">
                            @foreach ($horses as $horse)
                            <option value="{{$horse->id}}">{{$horse->runs}}</option>
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
<script>
    $(document).ready(function() {
        $('#summernote').summernote();
    });
</script>
@endsection