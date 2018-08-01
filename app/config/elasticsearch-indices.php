<?php

return [
    'index' => 'shakespeare',
    'body' => [
        'mappings' => [
            'shakespeare' => [
                'properties' => [
                    'speaker' => [
                        'type' => 'keyword'
                    ],
                    'play_name' => [
                        'type' => 'keyword'
                    ],
                    'line_id' => [
                        'type' => 'integer'
                    ],
                    'speech_number' => [
                        'type' => 'integer'
                    ],
                ]
            ]
        ]
    ]
];