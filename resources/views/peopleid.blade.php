@extends('layouts.app')

@section('content')
    <div class="col-md-12">
        <table class="table table-bordered">
            <thead class="thead-dark text-center">
            <tr>
                <th>name</th>
                <th>height</th>
                <th>hair_color</th>
                <th>birth_year</th>
                <th>created</th>
                <th>gender</th>
                <th>homeworld</th>
                @auth()
                    @if(Auth::user()->id == 1)
                        <th>admin</th>
                    @endif
                @endauth
            </tr>
            </thead>
            <tbody class="text-center">

            <tr>
                <td><br>{{$people->name}}</td>
                <td><br>{{$people->height}}</td>
                <td><br>{{$people->hair_color}}</td>
                <td><br>{{$people->birth_year}}</td>
                <td><br>{{$people->created}}</td>
                <td><br>{{$people->gender->gender}}</td>
                <td><br><a href="{{route('homeworldId', $people->homeworld_id)}}">{{$people->homeworld->name}}</a></td>

                @auth()
                    @if(Auth::user()->id == 1)
                        <td>
                            @if (session('success'))
                                <div class="alert alert-success" role="alert">
                                    {{session()->get('success')}}
                                </div>
                            @endif
                            <a class="btn btn-warning" href="{{route('people.edit', $people->id)}}" role="button">
                                Edit </a>
                            <h6></h6>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-danger" data-toggle="modal"
                                    data-target="#exampleModal">
                                Delete
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Danger alert</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <h3>Do you want to delete the entry?</h3>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close
                                            </button>
                                            <form method="post" action="{{route('people.destroy', $people->id)}}">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-danger">DELETE</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    @endif
                @endauth
            </tr>
        </table>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-sm-7">
                <div id="carouselExampleIndicators" class="carousel slide text-center" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        @if(count($people->rolesPhoto) > 0)
                            @for($i = 1; $i < count($people->rolesPhoto); $i++)
                                <li data-target="#carouselExampleIndicators" data-slide-to="{{$i}}"></li>
                            @endfor
                        @endif
                    </ol>
                    <div class="carousel-inner">
                        @if(count($people->rolesPhoto) > 0)
                            {{$j = 0}}
                            @foreach($people->rolesPhoto as $item)
                                @if($j < 1)
                                    <div class="carousel-item active">
                                        @else
                                            <div class="carousel-item">
                                                @endif
                                                <img src="{{asset('/storage/' . $item->name_photos)}}"
                                                     class="d-block img-thumbnail w-100" alt="{{$j++}}">
                                            </div>
                                            @endforeach
                                            @else
                                                <div class="carousel-item active">
                                                    <img src="../img/1.jpg" class="d-block img-thumbnail w-100"
                                                         alt="...">
                                                </div>
                                            @endif
                                    </div>
                                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button"
                                       data-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button"
                                       data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                    </div>
                </div>
                <div class="col-sm-2">
                    <br>
                    <br>
                    <br>
                    <a class="btn btn-primary" href="{{route('photoList', $people->id)}}" role="button">All photo</a>
                </div>
                <div class="col-sm-3">
                    <table class="table table-bordered">
                        <thead class="thead-dark text-center">
                        <tr>
                            <th>films - {{$people->name}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="text-center">
                                @foreach($people->rolesFilm as $item)
                                    <h5>{{$item->title}}</h5>
                                    <br>
                                @endforeach
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
@endsection
