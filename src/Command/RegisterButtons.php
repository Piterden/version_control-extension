<?php namespace Defr\VersionControlExtension\Command;

use Anomaly\Streams\Platform\Ui\Button\ButtonRegistry;

/**
 * Class RegisterButtons
 */
class RegisterButtons
{

    /**
     * Handle the command
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
    }
}
