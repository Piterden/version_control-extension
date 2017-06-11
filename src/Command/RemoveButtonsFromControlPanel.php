<?php namespace Defr\VersionControlExtension\Command;

use Anomaly\Streams\Platform\Ui\ControlPanel\ControlPanelBuilder;
use Illuminate\Http\Request;

/**
 * Class for remove buttons from control panel.
 */
class RemoveButtonsFromControlPanel
{

    /**
     * Control panel builder
     *
     * @var ControlPanelBuilder
     */
    protected $builder;

    /**
     * Create an instance of RemoveButtonsFromControlPanel class
     *
     * @param ControlPanelBuilder $builder
     */
    public function __construct(ControlPanelBuilder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * Handle the command
     */
    public function handle(Request $request)
    {
        $namespace = $request->segment(2);
        $sections  = $this->builder->getSections();

        foreach ($sections as $slug => &$section)
        {
            $path = $slug . '.buttons';

            $buttons = [];

            array_set($sections, $path, $buttons);
        }

        $this->builder->setSections($sections);
    }
}
