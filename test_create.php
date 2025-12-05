<?php

require_once 'vendor/autoload.php';

use Illuminate\Foundation\Application;
use Illuminate\Contracts\Console\Kernel;

$app = require_once 'bootstrap/app.php';

$app->make(Kernel::class)->bootstrap();

use App\Models\TemuDokter;

try {
    $temu = TemuDokter::create([
        'no_urut' => 1,
        'waktu_daftar' => now(),
        'status' => 'P',
        'idpet' => 6,
        'idrole_user' => 7,
    ]);
    echo "Created ID: " . $temu->idreservasi_dokter . "\n";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}