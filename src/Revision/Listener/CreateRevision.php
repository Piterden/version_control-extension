<?php namespace Defr\VersionControlExtension\Revision\Listener;

use Anomaly\SettingsModule\Setting\Contract\SettingRepositoryInterface;
use Anomaly\Streams\Platform\Ui\Form\Event\FormWasSaved;
use Defr\VersionControlExtension\Revision\Contract\RevisionRepositoryInterface;

class CreateRevision
{

    /**
     * Repository of revisions
     *
     * @var RevisionRepositoryInterface
     */
    protected $revisions;

    /**
     * Repository of settings
     *
     * @var SettingRepositoryInterface
     */
    protected $settings;

    /**
     * Create an instance of CreateRevision class
     *
     * @param SettingRepositoryInterface $settings
     * @param RevisionRepositoryInterface $revisions
     */
    public function __construct(
        SettingRepositoryInterface $settings,
        RevisionRepositoryInterface $revisions
    )
    {
        $this->settings  = $settings;
        $this->revisions = $revisions;
    }

    /**
     * Handle the event
     *
     * @param FormWasSaved $event
     */
    public function handle(FormWasSaved $event)
    {
        $enabled_streams = $this->settings->value(
            'defr.extension.version_control::enabled_streams'
        );

        /* @var FormBuilder $builder */
        $builder = $event->getBuilder();

        /* @var StreamInterface|null $stream */
        if (!$stream = $builder->getFormStream())
        {
            return;
        }

        if (!in_array(
            $stream->getNamespace() . '_' . $stream->getSlug(),
            $enabled_streams
        ))
        {
            return;
        }

        $fields = array_get($builder->getFields(), 0);

        foreach ($fields as $key => $value)
        {

        }
    }
}
