<?php namespace Defr\VersionControlExtension\Revision\Table;

use Anomaly\Streams\Platform\Stream\Contract\StreamRepositoryInterface;
use Anomaly\Streams\Platform\Ui\Table\TableBuilder;

/**
 * RevisionTableBuilder class
 *
 * @package    defr.extension.version_control
 *
 * @author     Denis Efremov <efremov.a.denis@gmail.com>
 */
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
     * The table actions.
     *
     * @var array|string
     */
    protected $actions = [
        'delete',
    ];
}
