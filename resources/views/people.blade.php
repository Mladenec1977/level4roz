@extends('layouts.app')

@section('content')
    <div class="col-md-12">
        <table class="table table-bordered">
            <thead class="thead-inverse text-center">
            <tr>
                <th>№</th>
                <th>
                    @auth()
                        @if(Auth::user()->id == 1)
                            <a class="page-link" href="{{route('people.create')}}">add people</a>
                        @else
                            name
                        @endif
                    @else
                        name
                    @endauth
                </th>
                <th>height</th>
                <th>mass</th>
                <th>hair_color</th>
                <th>birth_year</th>
                <th>created</th>
                <th>gender</th>
                <th>homeworld</th>
            </tr>
            </thead>
            <tbody>
            @php $j = 1; @endphp
            @foreach($peoples as $item)
                <tr class="text-center">
                    <th scope="row ">{{$res =
                            ($peoples->currentPage() - 1) * $peoples->perPage() + ($j++)}}</th>
                    <td><a href="{{route('people.show', $item->id)}}">{{$item->name}}</a></td>
                    <td>{{$item->height}}</td>
                    <td>{{$item->mass}}</td>
                    <td>{{$item->hair_color}}</td>
                    <td>{{$item->birth_year}}</td>
                    <td>{{$item->created}}</td>
                    <td>{{$item->gender->gender}}</td>
                    <td><a href="{{route('homeworldId', $item->homeworld_id)}}">{{$item->homeworld->name}}</a></td>
                </tr>
            @endforeach
        </table>
    </div>
    @if($peoples->hasPages())
        <br>
        <div class="row justify-content-center">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item"><a class="page-link" href="{{$peoples->previousPageUrl()}}">Previous</a></li>
                    @for($i = 1; $i <= $peoples->lastPage(); $i++)
                        @if ($i == $peoples->currentPage())
                            <li class="page-item active" aria-current="page"><a class="page-link"
                                                                                href="{{$peoples->url($i)}}">
                                    <span class="page-link">{{$i}}<span class="sr-only"></span></span></a></li>
                        @else
                            <li class="page-item"><a class="page-link" href="{{$peoples->url($i)}}">{{$i}}</a></li>
                        @endif
                    @endfor
                    <li class="page-item"><a class="page-link" href="{{$peoples->nextPageUrl()}}">Next</a></li>
                </ul>
            </nav>
        </div>
    @endif
@endsection
