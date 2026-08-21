<?php
// database/seeders/TagSeeder.php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    public function run(): void
    {
        $tags = [
            ['name' => 'Hukum Bisnis'],
            ['name' => 'Hukum Perdata'],
            ['name' => 'Hukum Pidana'],
            ['name' => 'Hukum Korporasi'],
            ['name' => 'Hukum Ketenagakerjaan'],
            ['name' => 'Hukum Teknologi'],
            ['name' => 'Hukum Keluarga'],
            ['name' => 'Hukum Internasional'],
            ['name' => 'Kontrak'],
            ['name' => 'Litigasi'],
            ['name' => 'Mediasi'],
            ['name' => 'Hak Kekayaan Intelektual'],
            ['name' => 'Hukum Pajak'],
            ['name' => 'Hukum Lingkungan'],
        ];

        foreach ($tags as $tag) {
            Tag::create($tag);
        }
    }
}