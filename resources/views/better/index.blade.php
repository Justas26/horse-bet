@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Better list</div>
                 <form class="card-header" action="{{route('better.index')}}" method="get">
                    <fieldset>
                        <legend>Filter</legend>
                        <div class="block">
                            <div class="form-group">
                                <select name="horse_id">
                                    @foreach ($horses as $horse)
                                    <option value="{{$horse->id}}">{{$horse->name}}</option>
                                    @endforeach
                                </select>
                                <small class="form-text text-muted">Select horse from the list.</small>
                            </div>
                        </div>
                        <div class="block">
                            <button type="submit" class="btn btn-info" name="filter" value="horse">horse</button>
                            <a href="{{route('better.index')}}" class="btn btn-warning">Reset</a>
                        </div>
                    </fieldset>
                </form>
                <div class="card-body">
                     <div class="mb-3">{{$betters->links()}}</div>
                    <table class="table">
                        <tr>
                            <th>Name</th>
                            <th>Surname</th>
                            <th>Bet</th>
                            <th>Photo </th>
                            <th>Show</th>
                        </tr>
                        @foreach ($betters as $better)
                        <tr>
                            <td>{{$better->name}}</td>
                            <td>{{$better->surname}}</td>
                            <td>{{$better->bet}}</td>
                            <td>
                             <img src="{{asset('betterPhoto/'.$better->photo_name)}}"alt="">
                            </td>
                            <td> <a class="btn btn-primary" href="{{route('better.show',$better)}}">show</a></td>
                            <td>
                            <br>
                        </tr>
                        @endforeach
                    </table>
                </div>
                <div class="mt-3">{{$betters->links()}}</div>
            </div>
        </div>
    </div>
</div>
@endsection