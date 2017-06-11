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
        'parent'    => 'anomaly.field_type.relationship',
        'data'      => 'anomaly.field_type.textarea',
    ];
}
