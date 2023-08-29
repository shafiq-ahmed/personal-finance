<?php

return [
    'createPost' => [
        'type' => 2,
        'description' => 'Create a post',
    ],
    'updatePost' => [
        'type' => 2,
        'description' => 'Update post',
    ],
    'user' => [
        'type' => 1,
        'children' => [
            'createPost',
        ],
    ],
    'admin' => [
        'type' => 1,
        'children' => [
            'updatePost',
            'user',
        ],
    ],
];
