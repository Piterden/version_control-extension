<?php namespace Defr\VersionControlExtension\Command;

use Anomaly\SettingsModule\Setting\Contract\SettingRepositoryInterface;
use Anomaly\Streams\Platform\Ui\ControlPanel\ControlPanelBuilder;
use Illuminate\Http\Request;

/**
 * Class for add button to control panel.
 */
class AddButtonToControlPanel
{

    /**
     * Control panel builder
     *
     * @var ControlPanelBuilder
     */
    protected $builder;

    /**
     * Create an instance of AddButtonToControlPanel class
     *
     * @param ControlPanelBuilder $builder The builder
     */
    public function __construct(ControlPanelBuilder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * Handle the command
     *
     * @param SettingRepositoryInterface $settings
     * @param Request                    $request
     */
    public function handle(SettingRepositoryInterface $settings, Request $request)
    {
        $namespace = $request->segment(2);
        $sections  = $this->builder->getSections();

        $enabled_streams = $settings->value(
            'defr.extension.version_control::enabled_streams',
            []
        );

        $updated = [];

        foreach ($sections as $slug => $section)
        {
            $path = $slug;

            if (in_array($namespace . '_' . $slug, $enabled_streams))
            {
                $path = $slug . '.buttons';

                $section = array_merge(
                    array_get($section, 'buttons', []),
                    [
                        'revisions' => [
                            'text' => "All {$slug} revisions",
                        ],
                    ]
                );
            }

            array_set($updated, $path, $section);
        }

        $this->builder->setSections($updated);
    }
}
