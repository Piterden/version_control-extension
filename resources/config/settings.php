<?php

use Anomaly\Streams\Platform\Stream\Contract\StreamInterface;
use Anomaly\Streams\Platform\Stream\Contract\StreamRepositoryInterface;

return [
    'enabled_streams' => [
        'type'   => 'anomaly.field_type.checkboxes',
        'config' => [
            'default_value' => ['pages_pages', 'posts_posts'],
            'options'       => function (StreamRepositoryInterface $streams)
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
