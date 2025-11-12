<?php
namespace App\Http\Helpers;

class CommonStringHelper
{
    public static function normalizeName(string $name): string
    {
        // Hapus spasi ekstra di awal dan akhir
        $name = trim($name);
        // Ubah ke huruf kecil
        $name = strtolower($name);
        // Ubah huruf pertama setiap kata menjadi kapital
        $name = ucwords($name);
        return $name;
    }
}
?>