<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

class DefrExtensionVersionControlCreateVersionControlFields extends Migration
{

    /**
     * The addon fields.
     *
     * @var array
     */
    protected $fields = [
        'namespace' => 'anomaly.field_type.text',
        'slug'      => 'anomaly.field_type.text',
        'data'      => 'anomaly.field_type.textarea',
        'parent'    => [
            'type'   => 'anomaly.field_type.relationship',
            'config' => [],
        ],
    ];
}
