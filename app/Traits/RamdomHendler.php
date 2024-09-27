<?php
namespace App\Traits;



trait RamdomHendler{

    function generateRandomString($length = 10){
        $date = now()->format('Y-m-d'); // Format tanggal
        $randomNumber = rand(100000, 999999); // Generate random 6-digit number
    }
}
