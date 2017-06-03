<?php namespace Defr\VersionControlExtension\Revision\Contract;

use Anomaly\Streams\Platform\Entry\Contract\EntryRepositoryInterface;

interface RevisionRepositoryInterface extends EntryRepositoryInterface
{

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
    );

    /**
     * Find all revisions of one stream
     *
     * @param  $namespace
     * @param  $slug
     * @param  $parent
     * @return RevisionCollection
     */
    public function findAllByNamespaceSlugAndParent(
        $namespace,
        $slug,
        $parent
    );
}
