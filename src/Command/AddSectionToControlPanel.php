<?php namespace Defr\VersionControlExtension\Command;

use Anomaly\SettingsModule\Setting\Contract\SettingRepositoryInterface;
use Anomaly\Streams\Platform\Ui\ControlPanel\ControlPanelBuilder;
use Illuminate\Http\Request;

/**
 * Class for add button to control panel.
 */
class AddSectionToControlPanel
{

    /**
     * Control panel builder
     *
     * @var ControlPanelBuilder
     */
    protected $builder;

    /**
     * Create an instance of AddSectionToControlPanel class
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

        if (!in_array(
            $namespace . '_' . $slug,
            $settings->value(
                'defr.extension.version_control::enabled_streams',
                []
            )
        ))
        {
            return;
        }

        $href = "admin/{$namespace}/{$slug}/revisions";

        if ($slug === $namespace)
        {
            $href = "admin/{$namespace}/revisions";
        }

        $sections = $this->builder->getSections();
        $capital = ucfirst($slug);

        array_set($sections, $slug, array_merge(
            array_get($sections, $slug, []),
            [
                'sections' => [
                    'revisions' => [
                        'title'  => "{$capital} revisions",
                        'hidden' => false,
                        'href'   => $href,
                    ],
                ],
            ]
        ));

        $this->builder->setSections($sections);
    }
}
