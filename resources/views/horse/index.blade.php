@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Horse  list</div>
                <div class="card-body">
                    <div class="mb-3">{{$horses->links()}}</div>
                    <table class="table">
                        <tr>
                            <th>Name</th>
                            <th>Runs</th>
                            <th>Wins</th>
                            <th>About</th>
                            <th>Photo</th>
                            <th>Show</th>
                        </tr>
                        @foreach ($horses as $horse)
                        <tr>
                            <td>{{$horse->name}}</td>
                            <td>{{$horse->runs}}</td>
                            <td>{{$horse->wins}}</td>
                            <td>{!!$horse->about!!}</td>
                            <td>
                             <img src="{{asset('horsePhoto/'.$horse->photo_name)}}"alt="">
                            </td>
                             <td> <a class="btn btn-primary" href="{{route('horse.show',$horse)}}">show</a></td>
                            <br>
                        </tr>
                        @endforeach
                    </table>
                </div>
                <div class="mt-3">{{$horses->links()}}</div>
            </div>
        </div>
    </div>
</div>
@endsection