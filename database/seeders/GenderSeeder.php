<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class GenderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $id = 1;

        while (true) {
            $genderId = Http::get('https://www.swapi.tech/api/people/' . $id);
            $genderText = $genderId->json();

            if (! isset($genderText['result'])) {
                $i = 0;
                while ($i < 5) {
                    $id++;
                    $genderId = Http::get('https://www.swapi.tech/api/people/' . $id);
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
            if (isset($genderText['result'])) {
                $genderText = $genderText['result']['properties'];
                $check = DB::table('genders')->where('gender', $genderText['gender'])->first();

                if (! isset($check)) {
                    $gender = ['gender' => $genderText['gender']];
                    DB::table('genders')->insert($gender);
                }
            }
            $id++;
        }
    }
}
