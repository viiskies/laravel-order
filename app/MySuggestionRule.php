<?php

namespace App;

use ScoutElastic\SearchRule;

class MySuggestionRule extends SearchRule
{
    public function buildQueryPayload()
    {
        return
            [
                'suggest'=> [
                    "product-suggest" => [
                        "prefix" => $this->builder->query,
                        "completion" => [],
                        "fuzziness" => "auto",
                        "prefix_length" => 1,
                        "operator" => "or"
                    ],
                ]
            ];
    }
}