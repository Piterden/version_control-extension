<?php namespace Defr\VersionControlExtension\Revision\Form;

use Anomaly\Streams\Platform\Stream\Contract\StreamRepositoryInterface;
use Anomaly\Streams\Platform\Ui\Form\FormBuilder;
use Defr\VersionControlExtension\Revision\RevisionModel;
use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;

class RevisionFormBuilder extends FormBuilder
{

    /**
     * Parent entry
     *
     * @var EntryInterface
     */
    protected $parent;

    /**
     * Form model
     *
     * @var Model
     */
    protected $model = RevisionModel::class;

    /**
     * Fields to skip.
     *
     * @var array|string
     */
    protected $skips = [];

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
    protected $options = [
        'sorted' => ['created_at', 'DESC'],
    ];

    /**
     * The form assets.
     *
     * @var array
     */
    protected $assets = [];

    /**
     * Gets the parent.
     *
     * @return EntryInterface The parent.
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Sets the parent.
     *
     * @param  EntryInterface $parent The parent entry
     * @return $this
     */
    public function setParent(EntryInterface $parent)
    {
        $this->parent = $parent;

        return $this;
    }

    public function onReady()
    {
        $this->setFields([
            'created_at' => [
                'type' => 'anomaly.field_type.datetime',
            ],
            'namespace',
            'slug',
            'parent'     => [
                'config' => [
                    'related' => get_class($this->getParent()),
                ],
            ],
        ]);
    }
}
