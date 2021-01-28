<?php

namespace App\Repository\Interfaces;

interface PeopleRepositoryInterface
{
    /**
     * @param $page
     * @return mixed
     */
    public function peopleAllPaginate($page);

    /**
     * @param $id
     * @return mixed
     */
    public function peopleId($id);

    /**
     * @param $id
     * @return mixed
     */
    public function peopleIdAll($id);

    /**
     * @param $id
     * @return mixed
     */
    public function peopleIdFhoto($id);

    /**
     * @param $id
     * @return mixed
     */
    public function peopleIdFilms($id);

    /**
     * @return mixed
     */
    public function gendersAll();

    /**
     * @return mixed
     */
    public function homeworldsAll();

    /**
     * @return mixed
     */
    public function filmsAll();
}
