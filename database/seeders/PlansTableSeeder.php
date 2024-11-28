<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlansTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('plans')->insert([
            ['name' => 'Monthly Plan', 'stripe_price_id' => 'price_1QPv0qI3nt5ZF2Ew4N9VAvc7', 'price' => 4.99],
            ['name' => 'Yearly Plan', 'stripe_price_id' => 'price_1QPuxhI3nt5ZF2Ew3GBMxqzM', 'price' => 34.99],
            ['name' => 'Lifetime Plan', 'stripe_price_id' => 'price_1QPv0qI3nt5ZF2EwRd2JYIfo', 'price' => 174.99],
        ]);
    }
}
