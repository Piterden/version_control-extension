<?php namespace Defr\VersionControlExtension\Listener;

use Anomaly\SettingsModule\Setting\Event\SettingsWereSaved;

class UpdateRevisionSchemas
{

    /**
     * Handle the event
     *
     * @param SettingsWereSaved $event
     * @return null
     */
    public function handle(SettingsWereSaved $event)
    {
        /* @var FormBuilder $builder */
        $builder   = $event->getBuilder();
        $namespace = $builder->getEntry();

        if ($namespace != 'defr.extension.version_control')
        {
            return;
        }

    }
}
