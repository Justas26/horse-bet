@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Horse create</div>
                <div class="card-body">
                    <form method="POST" action="{{route('horse.store')}}">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" value="{{old('name')}}">
                            <small class="form-text text-muted">Horse name.</small>
                        </div>
                        <div class="form-group">
                            <label>Runs</label>
                            <input type="text" name="runs" class="form-control" value="{{old('runs')}}">
                            <small class="form-text text-muted"> Horse runs.</small>
                        </div>
                        <div class="form-group">
                            <label>Wins</label>
                            <input type="text" name="wins" class="form-control" value="{{old('wins')}}">
                            <small class="form-text text-muted">Horse wins.</small>
                        </div>
                         <div class="form-group">
                            <label>About</label>
                            <textarea type="text" name="about" class="form-control" id="summernote"> {{old('about')}} </textarea>
                            <small class="form-text text-muted">Horse about.</small>
                        </div>
                        
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




