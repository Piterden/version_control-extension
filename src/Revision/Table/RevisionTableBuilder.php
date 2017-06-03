<?php namespace Defr\VersionControlExtension\Revision\Table;

use Anomaly\Streams\Platform\Ui\Table\TableBuilder;

class RevisionTableBuilder extends TableBuilder
{

    /**
     * The table columns.
     *
     * @var array|string
     */
    protected $columns = [
        'entry.created_at',
        'namespace',
        'slug',
        'parent',
    ];

    /**
     * The table buttons.
     *
     * @var array|string
     */
    protected $buttons = [
        'show_revision',
    ];

    /**
     * The table actions.
     *
     * @var array|string
     */
    protected $actions = [
        'delete',
    ];
}
