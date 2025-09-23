<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\LlboVerification;
use App\Models\User;
use Carbon\Carbon;

class LlboVerificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get some users to create LLBO verifications for
        $users = User::where('role', 'user')->take(5)->get();

        foreach ($users as $user) {
            LlboVerification::create([
                'user_id' => $user->id,
                'license_number' => 'LLBO-' . str_pad(rand(1000, 9999), 4, '0', STR_PAD_LEFT),
                'license_type' => 'LLBO',
                'issue_date' => Carbon::now()->subMonths(rand(6, 18)),
                'expiry_date' => Carbon::now()->addDays(rand(30, 365)),
                'status' => ['pending', 'verified', 'rejected'][rand(0, 2)],
                'verification_notes' => rand(0, 1) ? 'License verified successfully' : null,
                'document_path' => 'llbo-documents/sample-license-' . $user->id . '.pdf',
                'verified_by' => rand(0, 1) ? 1 : null, // Admin user ID
                'verified_at' => rand(0, 1) ? Carbon::now()->subDays(rand(1, 30)) : null,
                'reminder_sent_at' => rand(0, 1) ? Carbon::now()->subDays(rand(1, 7)) : null,
            ]);
        }

        // Create some expiring soon verifications
        $expiringUsers = User::where('role', 'user')->skip(5)->take(3)->get();
        
        foreach ($expiringUsers as $user) {
            LlboVerification::create([
                'user_id' => $user->id,
                'license_number' => 'LLBO-' . str_pad(rand(1000, 9999), 4, '0', STR_PAD_LEFT),
                'license_type' => 'LLBO',
                'issue_date' => Carbon::now()->subYear(),
                'expiry_date' => Carbon::now()->addDays(rand(15, 30)), // Expiring soon
                'status' => 'verified',
                'verification_notes' => 'License verified - expires soon',
                'document_path' => 'llbo-documents/sample-license-' . $user->id . '.pdf',
                'verified_by' => 1,
                'verified_at' => Carbon::now()->subMonths(6),
                'reminder_sent_at' => null,
            ]);
        }

        // Create some expired verifications
        $expiredUsers = User::where('role', 'user')->skip(8)->take(2)->get();
        
        foreach ($expiredUsers as $user) {
            LlboVerification::create([
                'user_id' => $user->id,
                'license_number' => 'LLBO-' . str_pad(rand(1000, 9999), 4, '0', STR_PAD_LEFT),
                'license_type' => 'LLBO',
                'issue_date' => Carbon::now()->subYear(),
                'expiry_date' => Carbon::now()->subDays(rand(30, 90)), // Expired
                'status' => 'expired',
                'verification_notes' => 'License has expired',
                'document_path' => 'llbo-documents/sample-license-' . $user->id . '.pdf',
                'verified_by' => 1,
                'verified_at' => Carbon::now()->subYear(),
                'reminder_sent_at' => Carbon::now()->subDays(rand(30, 60)),
            ]);
        }
    }
}