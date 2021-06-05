<?php
if($_SERVER['REQUEST_METHOD'] != 'GET'){ die(); }
require_once './api.php';

$nin = $settings['nin'];

$gql = <<<QUERY
query{
authorizations(first: 1, filters: { nin: "$nin" }){
    nodes {
        asAdministrator {
            investmentProposals(first: 10, filters: { status: Started }) {
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
    company {
        name
    }
    price {
        currency{
          code
        }
        amountFloat
    }
}
QUERY;

$data = runQuery($gql);

$proposals = $data->authorizations->nodes[0]->asAdministrator->investmentProposals->nodes;

respond($proposals);
