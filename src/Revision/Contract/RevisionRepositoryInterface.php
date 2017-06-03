<?php namespace Defr\VersionControlExtension\Revision\Contract;

use Anomaly\Streams\Platform\Entry\Contract\EntryRepositoryInterface;

interface RevisionRepositoryInterface extends EntryRepositoryInterface
{

    /**
     * [create description]
     *
     * @param  array  $attributes [description]
     * @return [type]             [description]
     */
    public function create(array $attributes);

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
    );

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
    );
}
