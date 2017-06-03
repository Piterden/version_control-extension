<?php namespace Defr\VersionControlExtension\Revision\Listener;

use Anomaly\Streams\Platform\Ui\Form\Event\FormWasValidated;
use Defr\VersionControlExtension\Revision\Command\CreateRevision;
use Illuminate\Foundation\Bus\DispatchesJobs;

class NewRevision
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
