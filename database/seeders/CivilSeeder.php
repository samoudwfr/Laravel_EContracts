<?php

namespace Database\Seeders;

use App\Models\Civil;
use Illuminate\Database\Seeder;

class CivilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Civil::create([
            'name' => 'William Maxwell',
            'birth_date' => '1987-4-4',
            'id_number' => '19226500297',
            'address' => 'sanar',
            'profession'=>'Student',
            'law_number' => '0',
            
    ]);
    
            Civil::create([
            'name' => 'Salma Hayek',
            'birth_date' => '1990-8-6',
            'id_number' => '18188084910',
            'address' => 'aljanina',
            'profession'=>'employee',
            'law_number' => '0',
            ]);
            
            Civil::create([
            'name' => 'Tommy Lucas',
            'birth_date' => '1985-1-2',
            'id_number' => '19191620344',
            'address' => 'Khartoum',
            'profession'=>'Lawyer',
            'law_number' => '4253',
            
    ]);
    
            Civil::create([
           'name' => 'Ali Daei',
           'birth_date' => '1978-6-4',
           'id_number' => '17137049201',
           'address' => 'aldamir',
           'profession'=>'Lawyer',
           'law_number' => '3321',
           
    ]);

    Civil::create([
        'name' => 'Wassim Samoud',
        'birth_date' => '1984-1-7',
        'id_number' => '23589625480',
        'address' => 'Goma - DRC',
        'profession'=>'User',
        'law_number' => '0',
        
 ]);
    }
}
