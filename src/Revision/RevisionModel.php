<?php namespace Defr\VersionControlExtension\Revision;

use Anomaly\Streams\Platform\Model\VersionControl\VersionControlRevisionsEntryModel;
use Anomaly\Streams\Platform\Stream\StreamRepository;
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
     * Get stream model
     *
     * @return StreamInterface
     */
    public function getParentStream()
    {
        return app()->make(StreamRepository::class)
            ->findBySlugAndNamespace(
                $this->getSlug(),
                $this->getNamespace()
            );
    }

    /**
     * Get parent entry
     *
     * @return EntryInterface
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Get parent entry
     *
     * @return int
     */
    public function getParentId()
    {
        return $this->parent->getId();
    }

    /**
     * Get ID of parent entry
     *
     * @return EntryModel
     */
    public function getParentModel()
    {
        return $this->getParentStream()->getEntryModel();
    }

    /**
     * Get data in JSON string format
     *
     * @return string
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Get data in PHP array format
     *
     * @return array
     */
    public function getDataArray()
    {
        return json_decode($this->data, true);
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
