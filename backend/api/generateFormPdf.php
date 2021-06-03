<?php
require_once '../vendor/autoload.php';

use Dompdf\Dompdf;

function generateFormPdf($data){
    global $kvarifranOptions, $jagOptions;

    $dompdf = new Dompdf();
    $dompdf->loadHtml(
        "
        <style>
        body {  
            font-family: 'Helvetica'  
        }
        h5{
            font-weight: normal;
            text-decoration: underline;
        }
        table th{
            text-align: left;
        }
        table td{
            padding-right:15px;
        }
        </style>
        " .
        fpg_block('Offer', $data['offerTitle']) .
        fpg_block('Offer Id', $data['offerId'], true) .
        fpg_block('Jag investerar som', $jagOptions[$data['jag']]) .
        (
            $data['jag'] == 'abhbkb' ? (
                fpg_block('Organisationsnummer', $data['organisationsnummer']) .
                fpg_title('Verklig huvudman') .
                "
                <table>
                    <thead>
                        <tr>
                            <th>Personer</th>
                            <th>Ägande</th>
                        </tr>
                    </thead>
                    <tbody>
                        ".(strlen($data['personer_med1']) > 0 ? "<tr> <td>".$data['personer_med1']."</td> <td>".$data['agande1']."%</td> </tr>" : "")."
                        ".(strlen($data['personer_med2']) > 0 ? "<tr> <td>".$data['personer_med2']."</td> <td>".$data['agande2']."%</td> </tr>" : "")."
                        ".(strlen($data['personer_med3']) > 0 ? "<tr> <td>".$data['personer_med3']."</td> <td>".$data['agande3']."%</td> </tr>" : "")."
                        ".(strlen($data['personer_med4']) > 0 ? "<tr> <td>".$data['personer_med4']."</td> <td>".$data['agande4']."%</td> </tr>" : "")."
                    </tbody>
                </table>
                "
            ) : ''
        ) .
        fpg_title('Mina personuppgifter') .
        fpg_block('Personnummer', $data['personnummer'], true) . 
        fpg_block('E-post', $data['e_post'], true) . 
        fpg_block('Mobiltelefon', $data['mobiltelefon'], true) . 
        fpg_block('Mitt namn', $data['mitt_namn'], true) . 
        fpg_block('Varifrån kommer de investerade pengarna', $kvarifranOptions[$data['kvarifran']]) .
        (
            $data['kvarifran'] == 'aannat' ? fpg_block('Vänligen beskriv var pengarna kommer från', $data['vanligen_beskriv'], true) : ''
        ) .
        fpg_block('Person med politiskt utsatt ställning PEP finns', $data['chvarifran'] ? 'Ja' : 'Nej') . 
        fpg_title('Ange ditt konto för automatisk utbetalning av utdelning') .
        fpg_block('Clearing', $data['ange_clearing'], true) .
        fpg_block('Kontonummer', $data['ange_kontonummer'], true) .
        fpg_block('Jag har läst och förstått villkoren', $data['varifran'] ? 'Ja' : 'Nej')
    );

    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();
    // $dompdf->stream('form.pdf', array("Attachment" => false));
    
    return $dompdf->output();
}

$jagOptions = array(
    'firma' => 'Privatperson eller enskild firma',
    'abhbkb' => 'AB, HB eller KB'
);

$kvarifranOptions = array (
    'siab' => 'Sparande i annan bank',
    'vinva' => 'Vinst värdepapper',
    'forfor' => 'Företagsförsäljning',
    'fastfor' => 'Fastighetsförsäljning',
    'faat' => 'Försäljning av andra tillgångar',
    'vifor' => 'Vinst i företag',
    'aannat' => 'Annat',
);


function fpg_block($title, $response = null, $nmrt = false){
    $astl = $nmrt ? 'margin-top:4px' : '';
    if($response){
        return "
        <h5 style=\"margin-bottom: 0;opacity: 0.7;$astl\">$title:</h5>
        <h4 style=\"margin-top: 2px;margin-bottom: 2px;$astl\">$response</h4>
        ";
    }else{
        return "
        <h5 style=\"margin-bottom: 2px;opacity: 0.8;$astl\">$title:</h5>
        ";
    }
}

function fpg_title($title){
    return "
    <h4 style=\"margin-bottom: 0;opacity: 0.7\">$title:</h4>
    ";
}