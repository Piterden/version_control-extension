<?php namespace Defr\VersionControlExtension\Revision\Listener;

use Anomaly\Streams\Platform\Ui\Form\Event\FormWasValidated;
use Defr\VersionControlExtension\Revision\Command\CreateRevision;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class for add revision.
 *
 * @package    defr.extension.version_control
 *
 * @author     Denis Efremov <efremov.a.denis@gmail.com>
 */
class AddRevision
{

    use DispatchesJobs;

    /**
     * Handle the event
     *
     * @param FormWasValidated $event
     */
    public function handle(FormWasValidated $event)
    {
        $this->dispatch(new CreateRevision($event->getBuilder()));
    }
}
