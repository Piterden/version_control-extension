<?php namespace Defr\VersionControlExtension\Listener;

use Anomaly\SettingsModule\Setting\Contract\SettingRepositoryInterface;
use Anomaly\Streams\Platform\Ui\ControlPanel\Component\Section\Event\GatherSections;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class AddButtonToControlPanel
 */
class AddButtonToControlPanel
{

    use DispatchesJobs;

    /**
     * Repository of settings
     *
     * @var SettingRepositoryInterface
     */
    protected $settings;

    /**
     * Create an instance of AddButtonToControlPanel class
     *
     * @param SettingRepositoryInterface $settings
     */
    public function __construct(
        SettingRepositoryInterface $settings
    )
    {
        $this->settings = $settings;
    }

    /**
     * Handle the event
     *
     * @param  GatherSections $event
     */
    public function handle(GatherSections $event)
    {
        /* @var ControlPanelBuilder $builder */
        $builder = $event->getBuilder();

        $namespace = app('request')->segment(2);
        $sections  = $builder->getSections();

        $enabled = $this->settings->value(
            'defr.extension.version_control::enabled_streams',
            []
        );

        $updated = [];

        foreach ($sections as $slug => $section)
        {
            if (!in_array($namespace . '_' . $slug, $enabled))
            {
                array_set($updated, $slug, $section);

                continue;
            }

            array_set($updated, $slug . '.buttons', array_merge(
                array_get($section, 'buttons'),
                ['revisions']
            ));
        }

        $builder->setSections($updated);
    }
}
