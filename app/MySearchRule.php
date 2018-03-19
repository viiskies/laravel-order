<?php

namespace App;

use ScoutElastic\SearchRule;

class MySearchRule extends SearchRule
{
    public function buildQueryPayload()
    {
        return
            [
                'should'=> [
                    [
                        "multi_match" => [
                            "query" => $this->builder->query,
                            "fields" => ['name', 'publisher', 'platform'],
                            "fuzziness" => 'auto',
                            "prefix_length" => 1,
                            'operator' => 'or'
                        ],
                    ],
                    [
                        "match" => [
                            "ean" => $this->builder->query,
                        ],
                    ]
                ]
            ];
    }
}