<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class HomeworldSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $homeworld = [];
        $id = 1;

        while (true) {
            $homeworldId = Http::get('https://www.swapi.tech/api/planets/' . $id);
            $homeworlText = $homeworldId->json();
            if (! isset($homeworlText['result'])) {
                $i = 0;
                while ($i < 5) {
                    $id++;
                    $genderId = Http::get('https://www.swapi.tech/api/planets/' . $id);
                    $genderText = $genderId->json();
                    if (isset($genderText['result'])) {
                        break;
                    }
                    $i++;
                }
                if ($i == 5) {
                    break;
                }
            }
            if (isset($homeworlText['result'])) {
                $homeworlText = $homeworlText['result']['properties'];
                $check = DB::table('homeworlds')->where('name', $homeworlText['name'])->first();
                if (!isset($check)) {
                    $homeworld[] = ['name' => $homeworlText['name'],
                        'rotation_period' => $homeworlText['rotation_period'],
                        'orbital_period' => $homeworlText['orbital_period'],
                        'diameter' => $homeworlText['diameter'],
                        'climate' => $homeworlText['climate'],
                        'gravity' => $homeworlText['gravity'],
                        'terrain' => $homeworlText['terrain'],
                        'surface_water' => $homeworlText['surface_water'],
                        'population' => $homeworlText['population'],
                        'url' => $homeworlText['url']
                    ];
                }
            }
            $id++;
        }
        DB::table('homeworlds')->insert($homeworld);
    }
}
