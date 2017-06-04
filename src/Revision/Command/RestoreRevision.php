<?php namespace Defr\VersionControlExtension\Revision\Command;

use Anomaly\Streams\Platform\Stream\Contract\StreamRepositoryInterface;
use Defr\VersionControlExtension\Revision\Contract\RevisionRepositoryInterface;

/**
 * Class for restore a revision.
 */
class RestoreRevision
{

    /**
     * ID of restoring entry
     *
     * @var mixed
     */
    protected $id;

    /**
     * Create an instance of RestoreRevision class
     *
     * @param mixed $id The id
     */
    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * Handle the command
     *
     * @param StreamRepositoryInterface   $streams   The streams
     * @param RevisionRepositoryInterface $revisions The revisions
     */
    public function handle(
        StreamRepositoryInterface $streams,
        RevisionRepositoryInterface $revisions
    )
    {
        /* @var RevisionInterface $revision */
        $revision = $revisions->find($this->id);

        $namespace = $revision->getNamespace();
        $slug      = $revision->getSlug();
        $parent_id = $revision->getParentId();

        /* @var StreamInterface $stream */
        $stream = $streams->findBySlugAndNamespace($slug, $namespace);

        /* @var EloquentInterface $model */
        $model = $stream->getEntryModel();
        $entry = $model->where('id', $parent_id)->first();

        // dd($entry);
    }
}
