<?php namespace Defr\VersionControlExtension\Revision\Table\Command;

use Defr\VersionControlExtension\Revision\Contract\RevisionRepositoryInterface;
use Defr\VersionControlExtension\Revision\Table\RevisionTableBuilder;

/**
 * SetRevisionTableEntries class
 */
class SetRevisionTableEntries
{

    /**
     * @var RevisionTableBuilder
     */
    protected $builder;

    /**
     * @var string
     */
    protected $namespace;

    /**
     * @var string
     */
    protected $slug;

    /**
     * @var int|null
     */
    protected $parent;

    /**
     * @param $builder
     * @param $namespace
     * @param $slug
     * @param $parent
     */
    public function __construct(
        RevisionTableBuilder $builder,
        string $namespace,
        string $slug,
        $parent = null
    )
    {
        $this->builder   = $builder;
        $this->namespace = $namespace;
        $this->slug      = $slug;
        $this->parent    = $parent;
    }

    /**
     * Handle the command
     *
     * @param    RevisionRepositoryInterface $revisions
     * @return
     */
    function handle(RevisionRepositoryInterface $revisions)
    {
        $entries = ($this->parent !== null)
        ? $revisions->findAllByNamespaceSlugAndParent(
            $this->namespace,
            $this->slug,
            $this->parent
        )
        : $revisions->findAllByNamespaceAndSlug(
            $this->namespace,
            $this->slug
        );

        if (!$entries->count())
        {
            $entries = collect([]);
        }

        return $this->builder->setTableEntries($entries);
    }
}
