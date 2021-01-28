@extends('layouts.app')

@section('content')
    <form class="needs-validation" novalidate method="post" action="{{route('people.store')}}">
        @method('POST')
        @csrf
        <div class="container">
            @if($errors->any())
                <div class="alert alert-danger" role="alert">
                    {{$errors->first()}}
                </div>
            @endif
            <div class="row">
                <div class="col-sm-5">
                    <table class="table table-bordered">
                        <thead class="thead-dark text-center">
                        <tr>
                            <th>name</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="text-center">
                                <input type="text" class="form-control" id="name"
                                       name="name" value="{{old('name')}}" required>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="col-sm-2">
                    <table class="table table-bordered">
                        <thead class="thead-dark text-center">
                        <tr>
                            <th>height</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="text-center">
                                <input type="text" class="form-control" id="height"
                                       name="height" value="{{old('height')}}" required>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="col-sm-2">
                    <table class="table table-bordered">
                        <thead class="thead-dark text-center">
                        <tr>
                            <th>mass</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="text-center">
                                <input type="text" class="form-control" id="mass"
                                       name="mass" value="{{old('mass')}}" required>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="col-sm-3">
                    <table class="table table-bordered">
                        <thead class="thead-dark text-center">
                        <tr>
                            <th>hair_color</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="text-center">
                                <input type="text" class="form-control" id="hair_color"
                                       name="hair_color" value="{{old('hair_color')}}" required>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        {{--        *************************************************************************************--}}
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <table class="table table-bordered">
                        <thead class="thead-dark text-center">
                        <tr>
                            <th>birth_year</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="text-center">
                                <input type="text" class="form-control" id="birth_year"
                                       name="birth_year" value="{{old('birth_year')}}" required>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="col-sm-4">
                    <table class="table table-bordered">
                        <thead class="thead-dark text-center">
                        <tr>
                            <th>created</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="text-center">
                                <input type="date" class="form-control" id="created"
                                       name="created" value="{{old('created')}}" required>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="col-sm-4">
                    <table class="table table-bordered">
                        <thead class="thead-dark text-center">
                        <tr>
                            <th>gender</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="text-center">
                                <div class="form-group">
                                    <select class="form-control" id="gender_id" name="gender_id" required>
                                        <option selected disabled></option>
                                        @foreach($genders as $gedersNext)
                                            <option value="{{$gedersNext->id}}">
                                                {{$gedersNext->gender}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        {{--        *************************************************************************************--}}
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <table class="table table-bordered">
                        <thead class="thead-dark text-center">
                        <tr>
                            <th>homeworld</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="text-center">
                                <div class="form-group">
                                    <select class="form-control" id="homeworld_id" name="homeworld_id" required>
                                        <option selected disabled></option>
                                        @foreach($homeworlds as $homeworldsNext)
                                            <option value="{{$homeworldsNext->id}}">
                                                {{$homeworldsNext->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="col-sm-4">
                    <table class="table table-bordered">
                        <thead class="thead-dark text-center">
                        <tr>
                            <th>film</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="text-left form-group">
                                @foreach($films as $filmsNext)
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox"
                                               id="{{$filmsNext->id}}" name="{{$filmsNext->id}}"
                                               value="{{$filmsNext->id}}">
                                        <label class="form-check-label"
                                               for="inlineCheckbox1">{{$filmsNext->title}}</label>
                                    </div>
                                    <br>
                                @endforeach
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="col-sm-4 text-center">
                    <button class="btn btn-warning" type="submit">save changes</button>
                </div>
            </div>
        </div>
    </form>
    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function () {
            'use strict';
            window.addEventListener('load', function () {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('needs-validation');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function (form) {
                    form.addEventListener('submit', function (event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>
@endsection
