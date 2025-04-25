<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\LeaveRequest;


class LeaveRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $alice = User::where('email', 'alice@example.com')->first();
        $bob = User::where('email', 'bob@example.com')->first();

        LeaveRequest::create([
            'user_id' => $alice->id,
            'start_date' => now()->addDays(3),
            'end_date' => now()->addDays(5),
            'reason' => 'Family trip',
            'status' => 'Pending',
        ]);

        LeaveRequest::create([
            'user_id' => $bob->id,
            'start_date' => now()->addDays(7),
            'end_date' => now()->addDays(9),
            'reason' => 'Medical leave',
            'status' => 'Approved',
        ]);

        LeaveRequest::create([
            'user_id' => $alice->id,
            'start_date' => now()->subDays(10),
            'end_date' => now()->subDays(8),
            'reason' => 'Sick leave',
            'status' => 'Rejected',
        ]);
    }
}