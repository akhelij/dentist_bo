<?php

namespace Database\Seeders;

use App\Models\Intervention;
use App\Models\InterventionHistory;
use App\Models\Patient;
use App\Models\Payment;
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

            $patients = Patient::factory(20)->create(); 

            foreach($patients as $patient) {
                $intervention = Intervention::factory()->create([
                    'patient_id' => $patient->id
                ]);

                InterventionHistory::factory(3)->create(
                    [                        
                        'intervention_id' => $intervention->id
                    ]
                );

                Payment::factory(3)->create([
                    'intervention_id' => $intervention->id,
                    'amount' =>  $intervention->total_amount / 3
                ]);
                
            }


        }

        auth()->loginUsingId($admin->id);
    }
}

