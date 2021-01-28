@extends('layouts.app')

@section('content')
    <div class="col-md-12">
        <table class="table table-bordered">
            <thead class="thead-dark text-center">
            <tr>
                <th>Planet</th>
                <th>rotation_period</th>
                <th>orbital_period</th>
                <th>diameter</th>
                <th>climate</th>
                <th>gravity</th>
                <th>terrain</th>
                <th>surface_water</th>
                <th>population</th>
            </tr>
            </thead>
            <tbody>
                <tr class="thead-light text-center">
                    <th class="bg-warning">{{$homeworld->name}}</th>
                    <th>{{$homeworld->rotation_period}}</th>
                    <th>{{$homeworld->orbital_period}}</th>
                    <th>{{$homeworld->diameter}}</th>
                    <th>{{$homeworld->climate}}</th>
                    <th>{{$homeworld->gravity}}</th>
                    <th>{{$homeworld->terrain}}</th>
                    <th>{{$homeworld->surface_water}}</th>
                    <th>{{$homeworld->population}}</th>
                </tr>
        </table>
    </div>
    <div class="container">
        <table class="table table-bordered">
            <thead class="thead-dark text-center">
            <tr>
                <th>People</th>
                @foreach($films as $itemFilm)
                <th>{{$itemFilm->title}}</th>
                @endforeach
            </tr>
            </thead>
            <tbody>
            @foreach($homeworld->rolesPeople as $itemPeople)
            <tr class="thead-light text-center">
                <th class="bg-light"><a href="{{route('people.show', $itemPeople->id)}}">{{$itemPeople->name}}</a></th>
                @foreach($films as $itemFilm)
                    <th {{ $i = '' }}>
                        @foreach($itemPeople->rolesFilm as $p_id)
                        @if($p_id->id == $itemFilm->id)
                                <h6{{$i = 'v'}}></h6>
                        @endif
                        @endforeach
                        <h3>{{$i}}</h3>
                    </th>
                @endforeach
            </tr>
            @endforeach
        </table>
    </div>
@endsection
