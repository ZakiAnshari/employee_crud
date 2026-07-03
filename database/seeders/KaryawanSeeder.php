<?php

namespace Database\Seeders;

use App\Models\Karyawan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class KaryawanSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $employees = [
            ['Budi Santoso', 'L'],
            ['Siti Nurhaliza', 'P'],
            ['Agus Setiawan', 'L'],
            ['Dewi Lestari', 'P'],
            ['Ahmad Fauzi', 'L'],
            ['Rina Wulandari', 'P'],
            ['Eko Prasetyo', 'L'],
            ['Yuni Kartika', 'P'],
            ['Hendra Gunawan', 'L'],
            ['Fitriani Rahayu', 'P'],
            ['Bambang Wijaya', 'L'],
            ['Sri Wahyuni', 'P'],
            ['Dedi Kurniawan', 'L'],
            ['Indah Permatasari', 'P'],
            ['Rudi Hartono', 'L'],
            ['Wulan Sari', 'P'],
            ['Andi Saputra', 'L'],
            ['Nur Aisyah', 'P'],
            ['Joko Susilo', 'L'],
            ['Ratna Dewi', 'P'],
            ['Fajar Nugroho', 'L'],
            ['Diah Puspita', 'P'],
            ['Slamet Riyadi', 'L'],
            ['Yulia Anggraini', 'P'],
            ['Taufik Hidayat', 'L'],
            ['Melati Putri', 'P'],
            ['Wahyu Aditya', 'L'],
            ['Lina Marlina', 'P'],
            ['Iwan Setiadi', 'L'],
            ['Puji Astuti', 'P'],
        ];

        $departments = ['IT', 'Finance', 'HR', 'Marketing', 'Operasional', 'Sales'];

        foreach ($employees as $index => [$name, $gender]) {
            $number = $index + 1;
            $slug = Str::slug($name, '.');

            Karyawan::create([
                'employee_id' => sprintf('EMP%03d', $number),
                'name' => $name,
                'gender' => $gender,
                'email' => "{$slug}@example.com",
                'phone' => '08' . fake()->numerify('##########'),
                'department' => $departments[$index % count($departments)],
                'join_date' => fake()->dateTimeBetween('-5 years', 'now')->format('Y-m-d'),
                'is_active' => fake()->boolean(85),
            ]);
        }
    }
}
