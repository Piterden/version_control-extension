<?php namespace Defr\VersionControlExtension\Revision;

use Anomaly\Streams\Platform\Entry\EntryRepository;
use Defr\VersionControlExtension\Revision\Contract\RevisionRepositoryInterface;

class RevisionRepository extends EntryRepository implements RevisionRepositoryInterface
{

    /**
     * The entry model.
     *
     * @var RevisionModel
     */
    protected $model;

    /**
     * Create a new RevisionRepository instance.
     *
     * @param RevisionModel $model
     */
    public function __construct(RevisionModel $model)
    {
        $this->model = $model;
    }

    /**
     * Find all revisions of one stream
     *
     * @param  $namespace
     * @param  $slug
     * @return RevisionCollection
     */
    public function findAllByNamespaceAndSlug(
        $namespace,
        $slug
    )
    {
        return $this->model
            ->where('namespace', $namespace)
            ->where('slug', $slug)
            ->get();
    }

    /**
     * Find all revisions of one stream
     *
     * @param  $namespace
     * @param  $slug
     * @param  $identifier
     * @return RevisionCollection
     */
    public function findAllByNamespaceSlugAndParent(
        $namespace,
        $slug,
        $identifier
    )
    {
        return $this->model
            ->where([
                'namespace' => $namespace,
                'slug'      => $slug,
                'parent'    => $identifier,
            ])
            ->get();
    }
}
