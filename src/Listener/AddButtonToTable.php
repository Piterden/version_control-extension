<?php namespace Defr\VersionControlExtension\Listener;

use Anomaly\SettingsModule\Setting\Contract\SettingRepositoryInterface;
use Anomaly\Streams\Platform\Ui\Table\Event\TableIsQuerying;

/**
 * Class AddButtonToTable
 */
class AddButtonToTable
{

    /**
     * Repository of settings
     *
     * @var SettingRepositoryInterface
     */
    protected $settings;

    /**
     * Create an instance of CreateRevision class
     *
     * @param SettingRepositoryInterface $settings
     */
    public function __construct(SettingRepositoryInterface $settings)
    {
        $this->settings = $settings;
    }

    /**
     * Handle the event
     *
     * @param  TableIsQuerying            $event
     */
    public function handle(TableIsQuerying $event)
    {
        $enabled_streams = $this->settings->value(
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

        if (!in_array(
            $stream->getNamespace() . '_' . $stream->getSlug(),
            $enabled_streams
        ))
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
