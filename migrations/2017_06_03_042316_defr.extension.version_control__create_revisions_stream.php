<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

class DefrExtensionVersionControlCreateRevisionsStream extends Migration
{

    /**
     * The stream definition.
     *
     * @var array
     */
    protected $stream = [
        'slug'         => 'revisions',
        'title_column' => 'namespace',
        // 'translatable' => true,
        // 'trashable'    => true,
        'sortable'     => true,
        'searchable'   => true,
    ];

    /**
     * The stream assignments.
     *
     * @var array
     */
    protected $assignments = [
        'namespace' => [
            'required' => true,
        ],
        'slug'      => [
            'required' => true,
        ],
        'parent'    => [
            'required' => true,
        ],
    ];

}
