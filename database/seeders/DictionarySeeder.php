<?php

namespace Database\Seeders;

use App\Models\Dictionary;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DictionarySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = json_decode(Storage::disk('local')->get('names.json'));

        foreach ($data as $key => $value) {
            Dictionary::updateOrCreate([
                'abbr'      => $value->alpha2,
            ], [
                'name'      => $value->english,
            ]);

        }
    }
}
