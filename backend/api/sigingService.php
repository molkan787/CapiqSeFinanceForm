<?php

require_once './config.php';

$clientId = $settings['client_id'];
$clientSecret = $settings['client_secret'];

$redirectBaseUrl = $config['websiteBaseUrl'];

function requestAuthorizationCode($internalRedirect){
    global $clientId, $clientSecret, $redirectBaseUrl;

    $acceptUrl = $redirectBaseUrl . 'api/postlogin.php?status=accepted&internalRedirect=' . urlencode($internalRedirect);
    $declineUrl = $redirectBaseUrl . 'api/postlogin.php?status=declined&internalRedirect=' . urlencode($internalRedirect);

    $racQql = <<<QUERY
    mutation {
        requestAuthorizationCode(
            params: {
                clientId: "$clientId"
                clientSecret: "$clientSecret"
                acceptUrl: "$acceptUrl"
                declineUrl: "$declineUrl"
                scopes: [{ code: query_as_owner }, { code: mutate_as_owner }]
            }
        ) {
        url
        }
    }
    QUERY;

    $data = runQuery($racQql);

    return $data->requestAuthorizationCode->url;
}

function authenticateWithAuthorizationCode($code){
    $racQql = <<<QUERY
    mutation {
        authenticateWithAuthorizationCode(authorizationCode:"$code") {
            accessToken
            me {
                name
            }
        }
    }
    QUERY;

    $data = runQuery($racQql);

    return $data->authenticateWithAuthorizationCode;
}


function subscribeToInvestmentProposal($accessToken, $investmentProposalId, $units){
    createClient($accessToken);

    $racQql = <<<QUERY
    mutation {
        subscribeToInvestmentProposal(
          params: { investmentProposalId: "$investmentProposalId", numUnits: $units }
        ) {
          code
        }
    }
    QUERY;

    $data = runQuery($racQql);

    return $data->subscribeToInvestmentProposal->code;
}