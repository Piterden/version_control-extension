<?php namespace Defr\VersionControlExtension\Command;

use Anomaly\SettingsModule\Setting\Contract\SettingRepositoryInterface;
use Anomaly\Streams\Platform\Ui\Tree\Event\TreeIsQuerying;

/**
 * Class AddButtonToTree
 */
class AddButtonToTree
{

    /**
     * Handle the command
     *
     * @param  TreeIsQuerying $event
     * @return void
     */
    public function handle(TreeIsQuerying $event)
    {
        $settings = app(SettingRepositoryInterface::class);

        $enabled_streams = $settings->value(
            'defr.extension.version_control::enabled_streams'
        );

        /* @var TreeBuilder $builder */
        $builder = $event->getBuilder();

        /* @var StreamInterface $stream */
        $stream = $builder->getTreeStream();

        $reference = $stream->getNamespace() . '_' . $stream->getSlug();

        if (!in_array($reference, $enabled_streams))
        {
            return;
        }

        $buttons = $builder->getButtons();

        if (!is_array($buttons))
        {
            $buttons = [];
        }

        $builder->setButtons(array_merge($buttons, ['revisions']));
    }
}
