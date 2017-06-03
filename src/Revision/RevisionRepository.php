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
     * @param string $namespace
     * @param string $slug
     * @return RevisionCollection
     */
    public function findAllByNamespaceAndSlug(
        string $namespace,
        string $slug
    )
    {
        return $this->model->where([
            'namespace' => $namespace,
            'slug'      => $slug,
        ])->get();
    }

    /**
     * Find all revisions of one stream
     *
     * @param string $namespace
     * @param string $slug
     * @param string|int $id
     * @return RevisionCollection
     */
    public function findAllByNamespaceSlugAndId(
        string $namespace,
        string $slug,
        $id
    )
    {
        return $this->model->where([
            'namespace' => $namespace,
            'slug'      => $slug,
            'id'        => $id,
        ])->get();
    }
}
