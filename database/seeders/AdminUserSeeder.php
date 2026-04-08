<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Mengubah user pertama (id=1) menjadi admin.
     * Jalankan dengan: php artisan db:seed --class=AdminUserSeeder
     */
    public function run(): void
    {
        // Mengubah user dengan id=1 menjadi admin
        $user = User::first();

        if ($user) {
            $user->update(['role' => 'admin']);
            $this->command->info('User "' . $user->name . '" berhasil dijadikan admin.');
        } else {
            $this->command->warn('Tidak ada user di database. Silakan daftar dulu.');
        }
    }
}
