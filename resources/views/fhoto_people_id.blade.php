@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-3">
                <table class="table table-striped">
                    <thead class="text-center table-dark">
                    <tr>
                        <th scope="col">Name</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th scope="row"><a href="{{route('people.show', $people->id)}}">{{$people->name}}</a></th>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-1"></div>
            <div class="col-3 text-center">
                @if(count($people->rolesPhoto) < 1)
                    <div class="alert alert-danger" role="alert">
                        No images to view!
                    </div>
                @endif
            </div>
            <div class="col-5 text-right">
                <br>
                @auth()
                    @if(Auth::user()->id == 1)
                        <image-upload v-bind:peopleid='@json($people->id)'></image-upload>
                    @endif
                @endauth
            </div>
        </div>
    </div>
    <br>
    <br>
    @if($people->rolesPhoto)
        <div class="container">
            <div class="row">
                @foreach($people->rolesPhoto as $item)
                    <div class="col-6 text-center">
                        <img src="{{asset('/storage/' . $item->name_photos)}}" class="img-fluid w-100">
                        @auth()
                            @if(Auth::user()->id == 1)
                                <form method="post" action="{{route('photoDelete', $item->id)}}">
                                    @csrf
                                    <button type="submit" class="btn btn-danger">DELETE</button>
                                </form>
                            @endif
                        @endauth
                    </div>
                @endforeach
            </div>
        </div>
    @endif
@endsection
