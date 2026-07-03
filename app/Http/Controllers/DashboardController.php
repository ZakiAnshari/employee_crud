<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Karyawan;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
    private const WEATHER_CODES = [
        0 => 'Cerah',
        1 => 'Cerah Berawan',
        2 => 'Berawan Sebagian',
        3 => 'Mendung',
        45 => 'Berkabut',
        48 => 'Berkabut Beku',
        51 => 'Gerimis Ringan',
        53 => 'Gerimis Sedang',
        55 => 'Gerimis Lebat',
        61 => 'Hujan Ringan',
        63 => 'Hujan Sedang',
        65 => 'Hujan Lebat',
        71 => 'Salju Ringan',
        73 => 'Salju Sedang',
        75 => 'Salju Lebat',
        80 => 'Hujan Lokal Ringan',
        81 => 'Hujan Lokal Sedang',
        82 => 'Hujan Lokal Lebat',
        95 => 'Badai Petir',
    ];

    public function index()
    {
        $isAdmin = auth()->user()->role_id == 1;

        $employeeCount = Karyawan::count();
        $accessCount = $isAdmin ? User::count() : 0;
        $logCount = $isAdmin ? ActivityLog::count() : 0;
        $weather = $this->getJakartaWeather();

        return view('admin.dashboard.index', compact('employeeCount', 'accessCount', 'logCount', 'weather'));
    }

    private function getJakartaWeather(): ?array
    {
        return Cache::remember('dashboard.weather.jakarta', now()->addMinutes(30), function () {
            try {
                $response = Http::timeout(5)->get('https://api.open-meteo.com/v1/forecast', [
                    'latitude' => -6.2088,
                    'longitude' => 106.8456,
                    'current_weather' => true,
                ]);

                if (!$response->successful()) {
                    return null;
                }

                $current = $response->json('current_weather');

                if (!$current) {
                    return null;
                }

                $current['description'] = self::WEATHER_CODES[$current['weathercode']] ?? 'Tidak diketahui';

                return $current;
            } catch (\Throwable $e) {
                return null;
            }
        });
    }
}
