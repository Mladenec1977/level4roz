<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\Homeworld;
use Illuminate\Http\Request;

class HomeworldControler extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $homeworld = Homeworld::with('rolesPeople')
            ->find($id);
        $homeworld->rolesPeople->load('rolesFilm');

        $films = Film::select('id', 'title')
            ->get();

        return view('homeworld', compact('homeworld', 'films'));
    }
}
