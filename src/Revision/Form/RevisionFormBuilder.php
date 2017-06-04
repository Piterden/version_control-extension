<?php namespace Defr\VersionControlExtension\Revision\Form;

use Anomaly\Streams\Platform\Ui\Form\FormBuilder;

class RevisionFormBuilder extends FormBuilder
{

    /**
     * The form fields.
     *
     * @var array|string
     */
    protected $fields = [
        'namespace' => [
            'disabled' => true,
        ],
        'slug'      => [
            'disabled' => true,
        ],
        'parent'    => [
            'disabled' => true,
        ],
        'data' => [
            'disabled' => true,
        ],
    ];

    /**
     * Fields to skip.
     *
     * @var array|string
     */
    protected $skips = [
        // 'data',
    ];

    /**
     * The form actions.
     *
     * @var array|string
     */
    protected $actions = [];

    /**
     * The form buttons.
     *
     * @var array|string
     */
    protected $buttons = [];

    /**
     * The form options.
     *
     * @var array
     */
    protected $options = [];

    /**
     * The form assets.
     *
     * @var array
     */
    protected $assets = [];

}
