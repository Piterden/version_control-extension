<?php namespace Defr\VersionControlExtension\Command;

use Anomaly\SettingsModule\Setting\Contract\SettingRepositoryInterface;
use Anomaly\Streams\Platform\Ui\Table\Event\TableIsQuerying;

/**
 * Class AddButtonToTable
 */
class AddButtonToTable
{

    /**
     * Handle the command
     *
     * @param  TableIsQuerying            $event
     */
    public function handle(TableIsQuerying $event)
    {
        $settings = app(SettingRepositoryInterface::class);

        $enabled_streams = $settings->value(
            'defr.extension.version_control::enabled_streams'
        );

        /* @var TableBuilder $builder */
        $builder = $event->getBuilder();

        if ($builder->isAjax())
        {
            return;
        }

        /* @var StreamInterface|null $stream */
        if (!$stream = $builder->getTableStream())
        {
            return;
        }

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

        $builder->setButtons(array_merge($buttons, ['revisions']));}
}
