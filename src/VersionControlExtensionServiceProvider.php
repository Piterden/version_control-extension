<?php namespace Defr\VersionControlExtension;

use Anomaly\Streams\Platform\Addon\AddonServiceProvider;
use Anomaly\Streams\Platform\Model\VersionControl\VersionControlRevisionsEntryModel;
use Anomaly\Streams\Platform\Ui\ControlPanel\Component\Section\Event\GatherSections;
use Anomaly\Streams\Platform\Ui\Form\Event\FormWasValidated;
use Anomaly\Streams\Platform\Ui\Table\Event\TableIsQuerying;
use Anomaly\Streams\Platform\Ui\Tree\Event\TreeIsQuerying;
use Defr\VersionControlExtension\Listener\AddButtonToControlPanel;
use Defr\VersionControlExtension\Listener\AddButtonToTable;
use Defr\VersionControlExtension\Listener\AddButtonToTree;
use Defr\VersionControlExtension\Listener\RegisterButtons;
use Defr\VersionControlExtension\Revision\Contract\RevisionRepositoryInterface;
use Defr\VersionControlExtension\Revision\Listener\NewRevision;
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
        'admin/{namespace}/revisions/{id?}'            => 'Defr\VersionControlExtension\Http\Controller\Admin\RevisionsController@shortIndex',
        'admin/{namespace}/{slug}/revisions/{id?}'     => 'Defr\VersionControlExtension\Http\Controller\Admin\RevisionsController@index',
        'admin/{namespace}/show_revision/{id?}'        => 'Defr\VersionControlExtension\Http\Controller\Admin\RevisionsController@shortShow',
        'admin/{namespace}/{slug}/show_revision/{id?}' => 'Defr\VersionControlExtension\Http\Controller\Admin\RevisionsController@show',
    ];

    /**
     * Extension event listeners
     *
     * @var array|null
     */
    protected $listeners = [
        TableIsQuerying::class  => [
            AddButtonToTable::class,
        ],
        TreeIsQuerying::class   => [
            AddButtonToTree::class,
        ],
        GatherSections::class   => [
            AddButtonToControlPanel::class,
        ],
        FormWasValidated::class => [
            NewRevision::class,
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
