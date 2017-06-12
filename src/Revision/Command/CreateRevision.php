<?php namespace Defr\VersionControlExtension\Revision\Command;

use Anomaly\Streams\Platform\Ui\Form\FormBuilder;
use Defr\VersionControlExtension\Revision\Contract\RevisionRepositoryInterface;

/**
 * Class for create revision.
 */
class CreateRevision
{

    /**
     * Form builder instance
     *
     * @var FormBuilder
     */
    protected $builder;

    /**
     * Create an instance of CreateRevision class
     *
     * @param FormBuilder $builder
     */
    public function __construct(FormBuilder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * Handle the command
     *
     * @param RevisionRepositoryInterface $revisions
     */
    public function handle(RevisionRepositoryInterface $revisions)
    {
        /* @var StreamInterface|null $stream */
        if (!$stream = $this->builder->getFormStream())
        {
            return;
        }

        $parent = $this->builder->getFormEntry();

        $revisions->getModel()->getFieldType('parent')
            ->mergeConfig([
                'related' => get_class($parent),
            ]);

        $revisions->create([
            'namespace' => $stream->getNamespace(),
            'parent_id' => $parent->getId(),
            'slug'      => $stream->getSlug(),
            'data'      => json_encode($parent->toArray()),
        ]);
    }
}
