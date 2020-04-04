<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert($this->getAdmins()->map(function ($email, $name) {
            return [
                'name' => $name,
                'email' => $email,
                'password' => Hash::make('neopix2012'),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        })->toArray());
    }

    private function getAdmins(): Collection
    {
        return collect([
            'Vladimir Corelj' => 'vlada@weareneopix.com',
            'Darko Đorđević' => 'darko@weareneopix.com',
            'Miloš Todorović' => 'milos.todorovic@weareneopix.com',
            'Srđan Radić' => 'srdjan@weareneopix.com',
            'Marko Ilić' => 'marko@weareneopix.com',
            'Ivan Icić' => 'ica@weareneopix.com',
            'Aleksandra Jovanović' => 'alex@weareneopix.com',
            'Ivan Stojanović' => 'ivan@weareneopix.com',
            'Miša Ković' => 'misa@weareneopix.com',
            'Petra Antić' => 'petra@weareneopix.com',
        ]);
    }
}
