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
        if ($request->segment(1) !== 'admin')
        {
            return;
        }

        $namespace = $request->segment(2);
        $slug      = $request->segment(3);

        if (!$slug || $slug === 'revisions')
        {
            $slug = $namespace;
        }

        $sections = $this->builder->getSections();

        $enabled = in_array(
            $namespace . '_' . $slug,
            $settings->value(
                'defr.extension.version_control::enabled_streams',
                []
            )
        );


        if (!$enabled)
        {
            return;
        }

        $href = "admin/{$namespace}/{$slug}/revisions";

        if ($slug === $namespace)
        {
            $href = "admin/{$namespace}/revisions";
        }

        $section = array_merge(
            array_get($sections, $slug, []),
            [
                'sections' => [
                    'revisions' => [
                        'title'   => 'Revisions',
                        'hidden'  => false,
                        'href'    => $href,
                    ],
                ],
            ]
        );

        array_set($sections, $slug, $section);

        $this->builder->setSections($sections);
    }
}
