<?php
if($_SERVER['REQUEST_METHOD'] != 'GET'){ die(); }
require_once './api.php';

$gql = <<<QUERY
query{
authorizations(first: 1, filters: { nin: "8211184653" }){
    nodes {
        asAdministrator {
            investmentProposals(first: 10) {
                ...investmentProposalAdministeredConnectionFragment
            }
        }
    }
}
}
fragment investmentProposalAdministeredConnectionFragment on InvestmentProposalAdministeredConnection{
    nodes {
        ...proposalFragment
    }
}
fragment proposalFragment on DirectedInvestmentProposalAdministered{
    id
    title
    description
    terms
}
QUERY;

$data = runQuery($gql);

$proposals = $data->authorizations->nodes[0]->asAdministrator->investmentProposals->nodes;

respond($proposals);
