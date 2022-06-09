<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Status;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        

        Status::Create([
            'status' => 'Pending',
        ]);
        Status::Create([
            'status' => 'Rejected',
        ]);
        Status::Create([
            'status' => 'Approved',
        ]);
        
        $this->call(CivilSeeder::class);
        $this->call(RoleSeeder::class);

        User::Create([
            'name' => 'wassim samoud',
            'email' => 'samoudwfr@gmail.com',
            'password' => Hash::make('123456789')
        ]);

        Customer::Create([
            'user_id' => 1,
            'civil_id' => 5,
            'role_id' => 3,
            'phone' => '93482125',
            'address' => 'City - Street',
            'gender' => 1,
            'age' => 28,
            'customer_number' => 'V125Obg782PhgT'
            
        ]);
    }
}
