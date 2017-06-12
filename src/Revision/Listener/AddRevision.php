<?php namespace Defr\VersionControlExtension\Revision\Listener;

use Anomaly\SettingsModule\Setting\Contract\SettingRepositoryInterface;
use Anomaly\Streams\Platform\Ui\Form\Event\FormWasValidated;
use Defr\VersionControlExtension\Revision\Command\CreateRevision;
use Illuminate\Foundation\Bus\DispatchesJobs;

/**
 * Class for add revision.
 *
 * @package    defr.extension.version_control
 *
 * @author     Denis Efremov <efremov.a.denis@gmail.com>
 */
class AddRevision
{

    use DispatchesJobs;

    /**
     * Settings repository
     *
     * @var SettingRepositoryInterface
     */
    protected $settings;

    /**
     * Create an instance of AddRevision class
     *
     * @param SettingRepositoryInterface $settings The settings
     */
    public function __construct(SettingRepositoryInterface $settings)
    {
        $this->settings = $settings;
    }

    /**
     * Handle the event
     *
     * @param FormWasValidated $event
     */
    public function handle(FormWasValidated $event)
    {
        $builder = $event->getBuilder();

        /* @var StreamInterface|null $stream */
        if (!$stream = $builder->getFormStream())
        {
            return;
        }

        $namespace = $stream->getNamespace();
        $slug      = $stream->getSlug();

        if (in_array(
            $namespace . '_' . $slug,
            $this->settings->value(
                'defr.extension.version_control::enabled_streams',
                []
            )
        ))
        {
            $this->dispatch(new CreateRevision($builder));
        }
    }
}
