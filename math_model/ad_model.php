<?php
//обчислює функцію
function N($t, $alpha1, $alpha2, $k, $N0)
{
    $Nt1 = -($alpha1 / $alpha2);
    $Nt21 = ($alpha1 / $alpha2) + $N0;
    $ex = exp(-$k * (($alpha1 / $alpha2) + $N0) * ($alpha2 * $t));
    $Nt2 = 1 + ($alpha2 / $alpha1) * $N0 * $ex;
    $Nt = $Nt1 + ($Nt21 / $Nt2);
    return $Nt;
}

function N_before_T1($t, $alpha_max, $alpha21, $k, $N0)
{
    $Nt1 = ($alpha_max / $alpha21);
    $Nt21 = $alpha_max + ($alpha21 + $N0);
    $ex = exp(-$k * (($alpha_max / $alpha21) + $N0) * ($alpha21 * $t));
    $Nt2 = $alpha_max + ($alpha21 * $N0 * $ex);
    $Nt = $Nt1 * (($Nt21 / $Nt2) - 1);
    return $Nt;
}

function N_after_T1($t, $T1, $alpha_opt, $alpha22, $k, $N0, $N1)
{
    $Nt1 = -($alpha_opt / $alpha22);
    $Nt21 = ($alpha_opt / $alpha22) + $N0;
    $ex = exp(-$k * (($alpha_opt / $alpha22) + $N0) * $alpha22 * ($t - $T1));
    $Nt2 = 1 + ((($N0 - $N1) / ($N1 + ($alpha_opt / $alpha22))) * $ex);
    $Nt = $Nt1 + ($Nt21 / $Nt2);
    return $Nt;
}

function main1($alpha1, $alpha2, $k, $N0)
{
    $N_t = array();
    $T = array();

for ($t = 0; $t < 101; $t++) {
    $t1 = $t * 0.01;
    $Nt = N($t1, $alpha1, $alpha2, $k, $N0);
    $N_t[$t] = $Nt;
    $T[$t] = $t1;
    echo $N_t[$t];echo "\n";
}
}

function main2($alpha2, $alpha1, $alpha_opt, $alpha22, $k, $N0){
    $N_alpha = array();
    $T_alpha = array();

    $T1 = log(($alpha2 / $alpha1) * $N0) / ($k * (($alpha1 / $alpha2) + $N0) * $alpha2);
    $N1 = N($T1, $alpha1, $alpha2, $k, $N0);
    echo "\n";
    $t = 0;
    while ($t <= ($T1 * 100)){
        $t1 = $t * 0.01;
        $Nt = N_before_T1($t1, $alpha1, $alpha2, $k, $N0);
        $N_alpha[$t] = $Nt;
        $T_alpha[$t] = $t1;
        echo $N_alpha[$t];echo "\n";
        $t += 1;
    }

    while ($t <= 100){
        $t1 = $t * 0.01;
        $Nt = N_after_T1($t1, $T1, $alpha_opt, $alpha22, $k, $N0, $N1);
        $N_alpha[$t] = $Nt;
        $T_alpha[$t] = $t1;
        echo $N_alpha[$t];echo "\n";
        $t += 1;
    }
}