<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class PeoplesFilmsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $people_films = [];
        $id = 1;

        while (true) {
            $peopleHttp = Http::get('https://www.swapi.tech/api/films/' . $id);
            $peopleText = $peopleHttp->json();
            if (! isset($peopleText['result'])) {
                $i = 0;
                while ($i < 5) {
                    $id++;
                    $peopleHttp = Http::get('https://www.swapi.tech/api/films/' . $id);
                    $peopleText = $peopleHttp->json();
                    if (isset($peopleText['result'])) {
                        break;
                    }
                    $i++;
                }
                if ($i == 5) {
                    break;
                }
            }
            if (isset($peopleText['result'])) {
                $film_id = DB::table('films')
                    ->where('title', $peopleText['result']['properties']['title'])
                    ->value('id');
                $peopleText = $peopleText['result']['properties']['characters'];

                if (! empty($peopleText)) {
                    for ($j = 0; $j < count($peopleText); $j++) {
                        $people_id = DB::table('people')
                            ->where('url', $peopleText[$j])
                            ->value('id');
                        $film_people_id = DB::table('film_people')
                            ->where('film_id', $film_id)
                            ->where('people_id', $people_id)
                            ->value('id');
                        if (! $film_people_id > 0) {
                            $people_films[] = ['film_id' => $film_id, 'people_id' => $people_id];
                        }
                    }
                }
            }
            $id++;
        }
        DB::table('film_people')->insert($people_films);
    }
}
