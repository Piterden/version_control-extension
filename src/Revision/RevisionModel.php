<?php namespace Defr\VersionControlExtension\Revision;

use Anomaly\Streams\Platform\Model\VersionControl\VersionControlRevisionsEntryModel;
use Defr\VersionControlExtension\Revision\Contract\RevisionInterface;

class RevisionModel extends VersionControlRevisionsEntryModel implements RevisionInterface
{

    /**
     * Get stream namespace
     *
     * @return string
     */
    public function getNamespace()
    {
        return $this->namespace;
    }

    /**
     * Get stream slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Get ID of parent entry
     *
     * @return int
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Get created date
     *
     * @return datetime
     */
    public function getDate()
    {
        return $this->created_at;
    }
}
