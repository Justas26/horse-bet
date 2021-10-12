@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Better information</div>
                <div class="card-body">
                    <table class="table-responsive-xl">
                        <tr>
                            <th>Name</th>
                            <th>Surname</th>
                            <th>Bet</th>
                            <th>Photo </th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                        @foreach ($better as $better)
                        <tr>
                            <td>{{$better->name}}</td>
                            <td>{{$better->surname}}</td>
                            <td>{{$better->bet}}</td>
                            <td>
                            <form action="{{route('better.uploadPhoto',$better)}}" method="post" enctype="multipart/form-data">
                            <input type="file" name="photo" id="">
                             @csrf
                            <button class="btn btn-success" type="submit">upload photo</button>
                            </form>
                            <td><a class="btn btn-primary" href="{{route('better.edit',$better)}}">edit</a></td>
                            <td>
                            <form method="POST" action="{{route('better.destroy', $better)}}">
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