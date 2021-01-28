<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class PeoplesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $people = [];
        $id = 1;

        while (true) {
            $peopleId = Http::get('https://www.swapi.tech/api/people/' . $id);
            $peopleText = $peopleId->json();
            if (! isset($peopleText['result'])) {
                $i = 0;
                while ($i < 5) {
                    $id++;
                    $peopleId = Http::get('https://www.swapi.tech/api/people/' . $id);
                    $peopleText = $peopleId->json();
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
                $peopleText = $peopleText['result']['properties'];
                $check = DB::table('people')->where('name', $peopleText['name'])->first();
                if (!isset($check)) {
                    $people[] = ['name' => $peopleText['name'],
                        'height' => $peopleText['height'],
                        'mass' => $peopleText['mass'],
                        'hair_color' => $peopleText['hair_color'],
                        'birth_year' => $peopleText['birth_year'],
                        'gender_id' => ($gender_id = DB::table('genders')
                            ->where('gender', $peopleText['gender'])
                            ->value('id')),
                        'homeworld_id' => ($homeworld_id = DB::table('homeworlds')
                            ->where('url', $peopleText['homeworld'])
                            ->value('id')),
                        'created' => date("Y-m-d H:i:s", strtotime($peopleText['created'])),
                        'url' => $peopleText['url']
                    ];
                }
            }
            $id++;
        }
        DB::table('people')->insert($people);
    }
}
