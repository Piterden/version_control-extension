<?php namespace Defr\VersionControlExtension\Listener;

use Anomaly\Streams\Platform\Ui\Button\ButtonRegistry;

/**
 * Class RegisterButtons
 */
class RegisterButtons
{

    /**
     * Handle the event
     *
     * @param  ButtonRegistry $registry
     */
    public function handle(ButtonRegistry $registry)
    {
        $registry->register(
            'revisions',
            [
                'type' => 'info',
                'text' => 'defr.extension.version_control::button.revisions',
                'icon' => 'fa fa-tasks',
            ]
        );

        $registry->register(
            'show_revision',
            [
                'type' => 'info',
                'text' => 'Show Revision',
                'icon' => 'fa fa-eye',
            ]
        );
    }
}
