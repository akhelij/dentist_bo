<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tenant;
use App\Models\User;

class DemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tenants = Tenant::factory(3)->create();
 
        $admin = User::factory()->create([
            'tenant_id' => null,
            'email' => 'admin@admin.com',
        ]);       
        
        foreach($tenants as $tenant) {      
            auth()->loginUsingId($admin->id);
            session()->put('tenant_id', $tenant->id);

            $doctor = User::factory()->create([
                'role' => 'doctor',
            ]);   
            
            auth()->loginUsingId($doctor->id);
            
            User::factory(2)->create([
                'role' => 'staff'
            ]);

            Client::factory(20)->create();        
        }

        auth()->loginUsingId($admin->id);
    }
}

