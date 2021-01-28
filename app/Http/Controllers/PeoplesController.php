<?php

namespace App\Http\Controllers;

use App\Http\Requests\PeopleRequest;
use App\Models\Film;
use App\Models\FilmPeople;
use App\Models\People;
use App\Repository\Interfaces\PeopleRepositoryInterface;

class PeoplesController extends Controller
{
    private $PeopleRepository;

    public function __construct(PeopleRepositoryInterface $PeopleRepository)
    {
        $this->PeopleRepository = $PeopleRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $peoples = $this->PeopleRepository->peopleAllPaginate(10);

        return view('people', compact('peoples'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $genders = $this->PeopleRepository->gendersAll();
        $homeworlds = $this->PeopleRepository->homeworldsAll();
        $films = $this->PeopleRepository->filmsAll();

        return view('people_create', compact('genders', 'homeworlds', 'films'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PeopleRequest $request)
    {
        $data = $request->all();
        $result = People::create($data);
        if ($result) {
            $dataFilm = Film::all();
            foreach ($dataFilm as $nextdataHome) {
                if (isset($data[$nextdataHome->id])){
                    $newPeopleFilms = FilmPeople::create([
                        'people_id' => $result->id,
                        'film_id' => $nextdataHome->id
                    ]);
                }
            }
            return redirect()
                ->route('people.show', $result->id)
                ->with(['success' => 'saved successfully']);
        } else {
            return back(['msg' => "Save error"])
                ->withErrors()
                ->withInput();
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $people = $this->PeopleRepository->peopleIdAll($id);

        return view('peopleid', compact('people'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $people = $this->PeopleRepository->peopleIdFilms($id);
        $genders = $this->PeopleRepository->gendersAll();
        $homeworlds = $this->PeopleRepository->homeworldsAll();
        $films = $this->PeopleRepository->filmsAll();

        return view('people_edit', compact('people', 'genders', 'homeworlds', 'films'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PeopleRequest $request, $id)
    {
        $item = People::find($id);
        if (empty($item)) {
            return back(['msg' => "Entry id =[{$id}] not found"])
                ->withErrors()
                ->withInput();
        }

        $data = $request->all();
        $result = $item->update($data);

        if ($result) {
            $dataHome = Film::all();
            foreach ($dataHome as $nextdataHome) {
                $checkPeopleFilms = FilmPeople::where('people_id', $id)
                    ->where('film_id', $nextdataHome->id)
                    ->first();
                if (isset($data[$nextdataHome->id])){
                    if (empty($checkPeopleFilms)) {
                        $newPeopleFilms = FilmPeople::create([
                            'people_id' => $id,
                            'film_id' => $nextdataHome->id
                        ]);
                    }
                } else if (!empty($checkPeopleFilms)) {
                    $checkPeopleFilms->delete();
                }
            }
            return redirect()
                ->route('people.show', $item->id)
                ->with(['success' => 'saved successfully']);
        } else {
            return back(['msg' => "Save error"])
                ->withErrors()
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deletedRows = People::where('id', $id)->delete();
        return redirect()->route('peopleList');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showPhoto($id)
    {
        $people = $this->PeopleRepository->peopleIdFhoto($id);

        return view('fhoto_people_id', compact('people'));
    }
}
