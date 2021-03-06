<?php namespace Defr\VersionControlExtension;

use Anomaly\Streams\Platform\Addon\AddonServiceProvider;
use Anomaly\Streams\Platform\Model\VersionControl\VersionControlRevisionsEntryModel;
use Anomaly\Streams\Platform\Ui\ControlPanel\Component\Section\Event\GatherSections;
use Anomaly\Streams\Platform\Ui\Form\Event\FormWasValidated;
use Anomaly\Streams\Platform\Ui\Table\Event\TableIsQuerying;
use Anomaly\Streams\Platform\Ui\Tree\Event\TreeIsQuerying;
use Defr\VersionControlExtension\Command\RegisterButtons;
use Defr\VersionControlExtension\Listener\ModifyControlPanel;
use Defr\VersionControlExtension\Listener\ModifyTable;
use Defr\VersionControlExtension\Listener\ModifyTree;
use Defr\VersionControlExtension\Revision\Contract\RevisionRepositoryInterface;
use Defr\VersionControlExtension\Revision\Listener\AddRevision;
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
        'admin/{namespace}/revisions/{parent?}'                  => 'Defr\VersionControlExtension\Http\Controller\Admin\RevisionsController@shortIndex',

        'admin/{namespace}/{slug}/revisions/{parent?}'           => 'Defr\VersionControlExtension\Http\Controller\Admin\RevisionsController@index',

        'admin/{namespace}/show_revision/{parent?}/{id?}'        => 'Defr\VersionControlExtension\Http\Controller\Admin\RevisionsController@shortShow',

        'admin/{namespace}/{slug}/show_revision/{parent?}/{id?}' => 'Defr\VersionControlExtension\Http\Controller\Admin\RevisionsController@show',

        'admin/{namespace}/restore_revision/{id}'                => 'Defr\VersionControlExtension\Http\Controller\Admin\RevisionsController@restore',
    ];

    /**
     * Extension event listeners
     *
     * @var array|null
     */
    protected $listeners = [
        TableIsQuerying::class  => [
            ModifyTable::class,
        ],
        TreeIsQuerying::class   => [
            ModifyTree::class,
        ],
        GatherSections::class   => [
            ModifyControlPanel::class,
        ],
        FormWasValidated::class => [
            AddRevision::class,
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
