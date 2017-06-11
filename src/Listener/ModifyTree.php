<?php namespace Defr\VersionControlExtension\Listener;

use Anomaly\SettingsModule\Setting\Contract\SettingRepositoryInterface;
use Anomaly\Streams\Platform\Support\Resolver;
use Anomaly\Streams\Platform\Ui\Tree\Event\TreeIsQuerying;

/**
 * Class ModifyTree
 */
class ModifyTree
{

    /**
     * Settings repository
     *
     * @var SettingRepositoryInterface
     */
    protected $settings;

    /**
     * Resolver
     *
     * @var Resolver
     */
    protected $resolver;

    /**
     * Create an instance of ModifyTree class
     *
     * @param SettingRepositoryInterface $settings Settings repository
     * @param Resolver                   $resolver The resolver
     */
    public function __construct(
        SettingRepositoryInterface $settings,
        Resolver $resolver
    )
    {
        $this->settings = $settings;
        $this->resolver = $resolver;
    }

    /**
     * Handle the event
     *
     * @param TreeIsQuerying $event
     */
    public function handle(TreeIsQuerying $event)
    {
        $enabled_streams = $this->settings->value(
            'defr.extension.version_control::enabled_streams'
        );

        /* @var TreeBuilder $builder */
        $builder = $event->getBuilder();

        /* @var StreamInterface|null $stream */
        if (!$stream = $builder->getTreeStream())
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
