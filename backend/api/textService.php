<?php

function getThankyouMessage($data, $payto){
    $companyName = htmlspecialchars($data['companyName']);
    $offerTitle = htmlspecialchars($data['offerTitle']);
    $totalPay = htmlspecialchars($data['totalPay']);
    return "
    <strong>Tack för visat intresse av våra aktier</strong> <br> <br>
    <strong>Du har visat intresse för $companyName</strong> <br>
    <strong>$offerTitle</strong> <br>
    <strong>Utdelning kommer att ske XX ggr per år till angivet konto.</strong> <br> <br>

    För att bli tilldelad dina aktier följ instruktionerna enligt nedan. <br> <br>

    Betala in <strong>$totalPay</strong> <br>
    Till <strong>$payto</strong> <br>
    Ange ditt personnummer som betalningsreferens 12 siffror 
    ";
}