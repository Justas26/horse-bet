@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Horse information</div>
                <div class="card-body">
                    <table class="table-responsive-xl">
                        <tr>
                            <th>Name</th>
                            <th>Runs</th>
                            <th>Wins</th>
                            <th>About</th>
                            <th>Photo </th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                        @foreach ($horse as $horse)
                        <tr>
                            <td>{{$horse->name}}</td>
                            <td>{{$horse->runs}}</td>
                            <td>{{$horse->wins}}</td>
                            <td>{!!$horse->wins!!}</td>
                            <td>
                            <form action="{{route('horse.uploadPhoto',$horse)}}" method="post" enctype="multipart/form-data">
                            <input type="file" name="photo" id="">
                             @csrf
                            <button class="btn btn-success" type="submit">upload photo</button>
                            </form>
                            <td><a class="btn btn-primary" href="{{route('horse.edit',$horse)}}">edit</a></td>
                            <td>
                            <form method="POST" action="{{route('horse.destroy', $horse)}}">
                            @csrf
                            <button class="btn btn-danger" type="submit">DELETE</button>
                            </form>
                            </td>
                            <br>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection