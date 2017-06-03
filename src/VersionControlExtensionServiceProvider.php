<?php namespace Defr\VersionControlExtension;

use Anomaly\Streams\Platform\Addon\AddonServiceProvider;
use Anomaly\Streams\Platform\Model\VersionControl\VersionControlRevisionsEntryModel;
use Anomaly\Streams\Platform\Ui\Table\Event\TableIsQuerying;
use Anomaly\Streams\Platform\Ui\Tree\Event\TreeIsQuerying;
use Defr\VersionControlExtension\Command\AddButtonToTable;
use Defr\VersionControlExtension\Command\AddButtonToTree;
use Defr\VersionControlExtension\Command\RegisterButtons;
use Defr\VersionControlExtension\Revision\Contract\RevisionRepositoryInterface;
use Defr\VersionControlExtension\Revision\RevisionModel;
use Defr\VersionControlExtension\Revision\RevisionRepository;

class VersionControlExtensionServiceProvider extends AddonServiceProvider
{

    /**
     * Extension bindings
     *
     * @var array
     */
    protected $bindings = [
        VersionControlRevisionsEntryModel::class => RevisionModel::class,
    ];

    /**
     * Extension singletons
     *
     * @var array
     */
    protected $singletons = [
        RevisionRepositoryInterface::class => RevisionRepository::class,
    ];

    /**
     * Extension routes
     *
     * @var array|null
     */
    protected $routes = [
        'admin/{namespace}/revisions/{id}'        => 'Defr\VersionControlExtension\Http\Controller\Admin\RevisionsController@shortIndex',
        'admin/{namespace}/{slug}/revisions/{id}' => 'Defr\VersionControlExtension\Http\Controller\Admin\RevisionsController@index',
    ];

    /**
     * Extension event listeners
     *
     * @var array|null
     */
    protected $listeners = [
        TableIsQuerying::class => [
            AddButtonToTable::class,
        ],
        TreeIsQuerying::class  => [
            AddButtonToTree::class,
        ],
    ];

    /**
     * Register the extension
     */
    public function register()
    {
        $this->dispatch(new RegisterButtons());
    }
}
