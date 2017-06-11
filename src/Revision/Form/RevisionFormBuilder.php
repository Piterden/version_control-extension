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
        'main' => [
            'fields' => [
                'namespace',
                'slug',
                'parent',
            ],
        ],
        // 'data' => [
        //     'fields' => '',
        // ],
    ];

    /**
     * The form sections.
     *
     * @var array|string
     */
    protected $sections = [
        'namespace',
        'slug',
        'parent',
    ];

    /**
     * Fields to skip.
     *
     * @var array|string
     */
    protected $skips = [
        'data',
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
