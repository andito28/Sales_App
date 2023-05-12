<?php

namespace Database\Seeders;

use App\Models\DataOrigin;
use Illuminate\Database\Seeder;

class DataOriginSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datas = [
            "pameran",
            "penawaran email",
            "presentasi",
            "public display",
            "referensi",
            "repeat order",
            "sosial media",
            "Spanduk/Baliho/Poster",
            "Telemarketing",
            "Walkin Office/Counter",
            "Website",
            "broadcast sms/wa",
            "canvasing",
            "flayering",
            "followup",
            "iklan",
            "keluarga",
            "komunitas",
            "open table",
            "other"
        ];

        foreach($datas as $key => $value){
            DataOrigin::create([
                'information' => $value
            ]);
        }
    }
}
