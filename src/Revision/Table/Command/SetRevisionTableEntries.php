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
    protected $id;

    /**
     * @param $builder
     * @param $namespace
     * @param $slug
     * @param $id
     */
    public function __construct(
        RevisionTableBuilder $builder,
        string $namespace,
        string $slug,
        $id
    )
    {
        $this->builder   = $builder;
        $this->namespace = $namespace;
        $this->slug      = $slug;
        $this->id        = $id;
    }

    /**
     * Handle the command
     *
     * @param  RevisionRepositoryInterface $revisions
     * @return
     */
    function handle(RevisionRepositoryInterface $revisions)
    {
        $entries = $this->id
        ? $revisions->findAllByNamespaceSlugAndId(
            $this->namespace,
            $this->slug,
            $this->id
        )
        : $revisions->findAllByNamespaceAndSlug(
            $this->namespace,
            $this->slug
        );

        $this->builder->setEntries($entries);
    }
}
