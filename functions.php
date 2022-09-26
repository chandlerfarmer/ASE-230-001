<?php


# THIS FUNCTION CALCULATES YOUR AGE. PASS STRING "DD-MM-YYYY"
function calcAge($birthdate){
    $current_date = date('d-m-Y');
    $age = date_diff(date_create($birthdate), date_create($current_date));
    $age_years = $age->format("%y");

    return $age_years;
}


# THIS FUNCTION CALCULATES HOW LONG YOU'VE BEEN ALIVE. PASS STRING "DD-MM-YYYY"
function calcTimeAlive($birthdate){
    $current_date = date('d-m-Y');
    $age = date_diff(date_create($birthdate), date_create($current_date));
    $time_alive = $age->format("%y ". "years ". "%m". " months & ". "%d". " days ago.");

    return $time_alive;
}
