<?php namespace Defr\VersionControlExtension\Revision\Contract;

use Anomaly\Streams\Platform\Entry\Contract\EntryRepositoryInterface;

interface RevisionRepositoryInterface extends EntryRepositoryInterface
{

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
     * @param string|int $parent
     * @return RevisionCollection
     */
    public function findAllByNamespaceSlugAndParent(
        string $namespace,
        string $slug,
        $parent
    );
}
