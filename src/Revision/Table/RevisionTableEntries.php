<?php namespace Defr\VersionControlExtension\Revision\Table;

use Defr\VersionControlExtension\Revision\Contract\RevisionRepositoryInterface;

class RevisionTableEntries
{

    /**
     * Revisions repository
     *
     * @var RevisionRepositoryInterface
     */
    protected $revisions;

    /**
     * Create an instance of RevisionTableEntries class
     *
     * @param RevisionRepositoryInterface $revisions
     */
    public function __construct(RevisionRepositoryInterface $revisions)
    {
        $this->revisions = $revisions;
    }

    /**
     * Handle the command
     *
     * @param  RevisionTableBuilder $builder
     */
    public function handle(RevisionTableBuilder $builder)
    {
        $parameters = app('request')->route()->parameters();

        $namespace = array_get($parameters, 'namespace', '');
        $parent    = array_get($parameters, 'parent', false);

        $slug = array_get($parameters, 'slug', $namespace);

        if ($parent)
        {
            return $builder->setTableEntries(
                $this->revisions->findAllByNamespaceSlugAndParent(
                    $namespace,
                    $slug,
                    $parent
                )
            );
        }

        return $builder->setTableEntries(
            $this->revisions->findAllByNamespaceAndSlug(
                $namespace,
                $slug
            )
        );
    }
}
