<?php namespace Defr\VersionControlExtension\Revision\Table;

use Defr\VersionControlExtension\Revision\Contract\RevisionRepositoryInterface;

/**
 * Class for revision table entries.
 */
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
     * @return <type>               ( description_of_the_return_value )
     */
    public function handle(RevisionTableBuilder $builder)
    {
        $parameters = app('request')->route()->parameters();

        if (!$namespace = array_get($parameters, 'namespace'))
        {
            return;
        }

        $slug = array_get($parameters, 'slug', $namespace);

        if (!$parent = array_get($parameters, 'parent'))
        {
            return $builder->setTableEntries(
                $this->revisions->findAllByNamespaceAndSlug(
                    $namespace,
                    $slug
                )
            );
        }

        return $builder->setTableEntries(
            $this->revisions->findAllByNamespaceSlugAndParent(
                $namespace,
                $slug,
                $parent
            )
        );
    }
}
