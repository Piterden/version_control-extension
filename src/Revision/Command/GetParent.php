<?php namespace Defr\VersionControlExtension\Revision\Command;

use Anomaly\Streams\Platform\Stream\StreamRepository;

/**
 *
 */
class GetParent
{

    /**
     * Stream namespace
     *
     * @var string
     */
    protected $namespace;

    /**
     * Stream slug
     *
     * @var string
     */
    protected $slug;

    /**
     * Model identifier
     *
     * @var mixed
     */
    protected $identifier;

    /**
     * Create an instance of GetParent class
     *
     * @param $namespace
     * @param $slug
     * @param $identifier
     */
    public function __construct(
        $namespace,
        $slug,
        $identifier
    )
    {
        $this->namespace  = $namespace;
        $this->slug       = $slug;
        $this->identifier = $identifier;
    }

    /**
     * Handle the command
     *
     * @param StreamRepository $streams
     */
    public function handle(StreamRepository $streams)
    {
        $stream = $streams->findBySlugAndNamespace(
            $this->slug,
            $this->namespace
        );

        dd($stream->getEntryModel()->getBoundModelName());
    }
}
