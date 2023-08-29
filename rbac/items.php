<?php

return [
    'createExpense' => [
        'type' => 2,
        'description' => 'Create Expense Record',
    ],
    'createEarning' => [
        'type' => 2,
        'description' => 'Create Earnings Record',
    ],
    'user' => [
        'type' => 1,
        'children' => [
            'createExpense',
            'createEarning',
        ],
    ],
];
