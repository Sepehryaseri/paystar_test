<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'username' => 'sepehr',
                'password' => bcrypt('sujix1379'),
                'card_number' => '5892101256512886',
            ]
        ];

        foreach ($users as $user) {
            User::query()
                ->updateOrCreate(
                    ['username' => $user['username']],
                    [
                        'password' => $user['password'],
                        'card_number' => $user['card_number']
                    ]);
        }
    }
}
