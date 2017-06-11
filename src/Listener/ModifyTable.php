<?php namespace Defr\VersionControlExtension\Listener;

use Anomaly\SettingsModule\Setting\Contract\SettingRepositoryInterface;
use Anomaly\Streams\Platform\Support\Resolver;
use Anomaly\Streams\Platform\Ui\Table\Event\TableIsQuerying;
use Defr\VersionControlExtension\Revision\RevisionModel;

/**
 * Class ModifyTable
 */
class ModifyTable
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
     * Create an instance of ModifyTable class
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
     * @param TableIsQuerying $event
     */
    public function handle(TableIsQuerying $event)
    {
        $enabled_streams = $this->settings->value(
            'defr.extension.version_control::enabled_streams',
            []
        );

        /* @var TableBuilder $builder */
        $builder = $event->getBuilder();

        /* @var QueryBuilder $query */
        $query = $event->getQuery();

        if ($builder->getTableModel() instanceof RevisionModel)
        {
            $parameters = app('request')->route()->parameters();

            if (!$namespace = array_get($parameters, 'namespace'))
            {
                return;
            }

            $slug = array_get($parameters, 'slug', $namespace);

            if (!$parent = array_get($parameters, 'parent'))
            {
                return $builder->setTableEntries(
                    $query->where([
                        'namespace' => $namespace,
                        'slug'      => $slug,
                    ])->get()
                );
            }

            return $builder->setTableEntries(
                $query->where([
                    'namespace' => $namespace,
                    'slug'      => $slug,
                    'parent'    => $parent,
                ])->get()
            );
        }

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
            $this->resolver->resolve($buttons, ['builder' => $builder]);
        }

        $buttons = $builder->getButtons();

        if (!is_array($buttons))
        {
            $buttons = [];
        }

        $builder->setButtons(array_merge($buttons, ['revisions']));
    }
}
