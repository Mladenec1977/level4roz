<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class FilmsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $films = [];
        $id = 1;

        while (true) {
            $filmsId = Http::get('https://www.swapi.tech/api/films/' . $id);
            $filmsText = $filmsId->json();
            if (! isset($filmsText['result'])) {
                $i = 0;
                while ($i < 5) {
                    $id++;
                    $filmsId = Http::get('https://www.swapi.tech/api/films/' . $id);
                    $filmsText = $filmsId->json();
                    if (isset($filmsText['result'])) {
                        break;
                    }
                    $i++;
                }
                if ($i == 5) {
                    break;
                }
            }
            if (isset($filmsText['result'])) {
                $filmsText = $filmsText['result']['properties'];
                $check = DB::table('films')->where('title', $filmsText['title'])->first();
                if (!isset($check)) {
                    $films[] = ['title' => $filmsText['title'],
                        'episode_id' => $filmsText['episode_id'],
                        'release_date' => $filmsText['release_date'],
                        'url' => $filmsText['url']
                    ];
                }
            }
            $id++;
        }
        DB::table('films')->insert($films);
    }
}
