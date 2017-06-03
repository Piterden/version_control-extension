<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;
use Anomaly\Streams\Platform\Entry\EntryModel;

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
        'parent'    => [
            'type'   => 'anomaly.field_type.relationship',
            'config' => [
                'related' => EntryModel::class,
            ],
        ],
    ];
}
