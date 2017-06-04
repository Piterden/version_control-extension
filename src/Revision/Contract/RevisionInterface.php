<?php namespace Defr\VersionControlExtension\Revision\Contract;

use Anomaly\Streams\Platform\Entry\Contract\EntryInterface;

interface RevisionInterface extends EntryInterface
{

    /**
     * Get stream namespace
     *
     * @return string
     */
    public function getNamespace();

    /**
     * Get stream slug
     *
     * @return string
     */
    public function getSlug();

    /**
     * Get stream model
     *
     * @return StreamInterface
     */
    public function getStream();

    /**
     * Get ID of parent entry
     *
     * @return int
     */
    public function getParentId();

    /**
     * Get ID of parent entry
     *
     * @return EntryInterface
     */
    public function getParentModel();

    /**
     * Get data in JSON string format
     *
     * @return string
     */
    public function getData();

    /**
     * Get data in PHP array format
     *
     * @return array
     */
    public function getDataArray();

    /**
     * Get created date
     *
     * @return datetime
     */
    public function getDate();
}
