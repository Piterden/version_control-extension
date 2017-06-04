<?php namespace Defr\VersionControlExtension\Revision;

use Anomaly\Streams\Platform\Entry\EntryCriteria;

class RevisionCriteria extends EntryCriteria
{

    /**
     * By namespace limiting
     *
     * @param  string       $namespace The namespace
     * @param  $namespace
     * @return $this
     */
    public function ofNamespace($namespace)
    {
        $this->query->where('namespace', $namespace);

        return $this;
    }

    /**
     * Return chronologically.
     *
     * @return $this
     */
    public function recent()
    {
        $this->query->orderBy('created_at', 'DESC');

        return $this;
    }

    /**
     * By slug limiting
     *
     * @param  <type>  $slug The slug
     * @param  $slug
     * @return $this
     */
    public function ofSlug($slug)
    {
        $this->query->where('slug', $slug);

        return $this;
    }

    /**
     * Add the parent constraint.
     *
     * @param  string  $namespace  The namespace
     * @param  string  $slug       The slug
     * @param  mixed   $identifier The identifier
     * @return $this
     */
    public function ofParent(
        $namespace,
        $slug,
        $identifier
    )
    {
        $this->query
            ->where('parent', $identifier)
            ->where('namespace', $namespace)
            ->where('slug', $slug);

        return $this;
    }
}
