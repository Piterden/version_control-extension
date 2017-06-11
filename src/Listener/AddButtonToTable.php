<?php namespace Defr\VersionControlExtension\Listener;

use Anomaly\SettingsModule\Setting\Contract\SettingRepositoryInterface;
use Anomaly\Streams\Platform\Support\Resolver;
use Anomaly\Streams\Platform\Ui\Table\Event\TableIsQuerying;
use Illuminate\Contracts\Container\Container;

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
     * App container
     *
     * @var Container
     */
    protected $container;

    /**
     * Create an instance of CreateRevision class
     *
     * @param SettingRepositoryInterface $settings
     */
    public function __construct(SettingRepositoryInterface $settings, Container $container)
    {
        $this->settings  = $settings;
        $this->container = $container;
    }

    /**
     * Handle the event
     *
     * @param TableIsQuerying $event
     */
    public function handle(TableIsQuerying $event)
    {
        $resolver = new Resolver($this->container);

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

        if (is_string($buttons))
        {
            $resolver->resolve($buttons, ['builder' => $builder]);
        }

        $buttons = $builder->getButtons();

        if (!is_array($buttons))
        {
            $buttons = [];
        }

        $builder->setButtons(array_merge($buttons, ['revisions']));
    }
}
