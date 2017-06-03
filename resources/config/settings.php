<?php

use Anomaly\Streams\Platform\Stream\Contract\StreamInterface;
use Anomaly\Streams\Platform\Stream\Contract\StreamRepositoryInterface;

return [
    'enabled_streams' => [
        'type'          => 'anomaly.field_type.checkboxes',
        'default_value' => [],
        'config'        => [
            'options' => function (StreamRepositoryInterface $streams)
            {
                return $streams->all()->mapWithKeys(
                    function (StreamInterface $stream)
                    {
                        $reference = $stream->getNamespace() . '_' . $stream->getSlug();

                        return [$reference => $reference];
                    }
                );
            },
        ],
    ],
];
