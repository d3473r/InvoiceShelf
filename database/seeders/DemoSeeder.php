<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use InvoiceShelf\Models\Address;
use InvoiceShelf\Models\Setting;
use InvoiceShelf\Models\User;

class DemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::whereIs('super admin')->first();

        $user->setSettings(['language' => 'en']);

        Address::create(['company_id' => $user->companies()->first()->id, 'country_id' => 1]);

        Setting::setSetting('profile_complete', 'COMPLETED');

        \Storage::disk('local')->put('database_created', 'database_created');
    }
}
