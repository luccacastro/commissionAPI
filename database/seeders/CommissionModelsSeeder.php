<?php
// database/seeders/CommissionModelsSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommissionModelsSeeder extends Seeder
{
    public function run()
    {
        DB::table('commission_models')->insert([
            [
                'model_type' => 'default',
                'price_data' => json_encode([
                    'tiers' => [
                        ['limit' => 5000, 'rate' => 0.0],
                        ['limit' => 10000, 'rate' => 0.10],
                        ['limit' => 15000, 'rate' => 0.15],
                        ['limit' => 20000, 'rate' => 0.20],
                        ['limit' => 20001, 'rate' => 0.25],
                    ]
                ])
            ],
            [
                'model_type' => 'premium',
                'price_data' => json_encode([
                    'tiers' => [
                        ['limit' => 5000, 'rate' => 0.15],
                        ['limit' => 10000, 'rate' => 0.20],
                        ['limit' => 15000, 'rate' => 0.25],
                        ['limit' => 20000, 'rate' => 0.30],
                    ]
                ])
            ]
        ]);
    }
}
