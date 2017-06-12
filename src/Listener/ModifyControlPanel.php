<?php namespace Defr\VersionControlExtension\Listener;

use Anomaly\Streams\Platform\Ui\ControlPanel\Component\Section\Event\GatherSections;
use Defr\VersionControlExtension\Command\AddButtonToControlPanel;
use Defr\VersionControlExtension\Command\AddSectionToControlPanel;
use Defr\VersionControlExtension\Command\RemoveButtonsFromControlPanel;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;

/**
 * Class ModifyControlPanel
 */
class ModifyControlPanel
{
    use DispatchesJobs;

    /**
     * Request instance
     *
     * @var Request
     */
    protected $request;

    /**
     * Create an instance of ModifyControlPanel class
     *
     * @param Request $request The request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Handle the event
     *
     * @param GatherSections $event
     */
    public function handle(GatherSections $event)
    {
        /* @var ControlPanelBuilder $builder */
        $builder = $event->getBuilder();

        $this->dispatch(new AddSectionToControlPanel($builder));

        if (in_array('revisions', $this->request->segments()))
        {
            return $this->dispatch(new RemoveButtonsFromControlPanel($builder));
        }

        $this->dispatch(new AddButtonToControlPanel($builder));
    }
}
