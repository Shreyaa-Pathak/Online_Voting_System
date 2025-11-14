<?php

namespace Database\Seeders;

use App\Helpers\Sha256;
use App\Models\PreapprovedUser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class PreapprovedUsersCsvSeeder extends Seeder
{
    public function run(): void
    {
        $secret = config('app.preaaproved_key');
        $filePath = storage_path('app/csv/preapproved_users.csv');

        if (!file_exists($filePath)) {
            $this->command->error('CSV file not found: ' . $filePath);
            return;
        }

        $rows = array_map('str_getcsv', file($filePath));

        // Remove header row
        $header = array_shift($rows);

        foreach ($rows as $row) {
            [$name, $email, $dob, $phonenumber, $voteridnumber] = $row;

            PreapprovedUser::create([
                'name' => $name,
                'email' => $email,
                'dob' => $dob,
                'phonenumber' => $phonenumber,
                'key_hash' => Sha256::hash($voteridnumber . $email . $phonenumber . $dob . $name . $secret),
            ]);

            $this->command->info("Inserted: $name <$email>");
        }

        $this->command->info('All pre-approved users imported successfully.');
    }

}
