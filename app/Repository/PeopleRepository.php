<?php
namespace App\Repository;
use App\Models\Film;
use App\Models\Gender;
use App\Models\Homeworld;
use App\Models\People;
use App\Repository\Interfaces\PeopleRepositoryInterface;

class PeopleRepository implements PeopleRepositoryInterface
{

    /**
     * @param $page
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function peopleAllPaginate($page)
    {
        $peoples = People::with('gender')
            ->with('homeworld')
            ->paginate($page);
        return $peoples;
    }

    /**
     * @param $id
     */
    public function peopleId($id)
    {
        // TODO: Implement peopleId() method.
    }

    /**
     * @param $id
     * @return mixed
     */
    public function peopleIdAll($id)
    {
        $people = People::where('id', $id)
            ->with('gender')
            ->with('homeworld')
            ->with('rolesFilm')
            ->with('rolesPhoto')
            ->first();

        return $people;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function peopleIdFhoto($id)
    {
        $people = People::where('id', $id)
            ->select('id', 'name')
            ->with('rolesPhoto')
            ->first();
        return $people;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function peopleIdFilms($id)
    {
        $people = People::where('id', $id)
            ->with('rolesFilm')
            ->first();
        return $people;
    }

    /**
     * @return mixed
     */
    public function gendersAll()
    {
        $genders = Gender::select('id', 'gender')
            ->get();
        return $genders;
    }

    /**
     * @return mixed
     */
    public function homeworldsAll()
    {
        $homeworlds = Homeworld::select('id', 'name')
            ->get();
        return $homeworlds;
    }

    /**
     * @return mixed
     */
    public function filmsAll()
    {
        $films = Film::select('id', 'title')
            ->get();
        return $films;
    }
}
