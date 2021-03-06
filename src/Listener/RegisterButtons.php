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
     * @param ButtonRegistry $registry
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
                'text' => 'defr.extension.version_control::button.show_revision',
                'icon' => 'fa fa-eye',
                'href' => 'admin/{entry.namespace}/show_revision/{entry.parent}/{entry.id}',
            ]
        );

        $registry->register(
            'restore_revision',
            [
                'button' => 'prompt',
                'type'   => 'warning',
                'text'   => 'defr.extension.version_control::button.restore_revision',
                'icon'   => 'fa fa-hand-o-left',
                'href'   => 'admin/{entry.namespace}/restore_revision/{entry.id}',
            ]
        );
    }
}
