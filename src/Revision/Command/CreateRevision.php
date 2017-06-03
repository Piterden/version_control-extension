<?php namespace Defr\VersionControlExtension\Revision\Command;

use Anomaly\SettingsModule\Setting\Contract\SettingRepositoryInterface;
use Anomaly\Streams\Platform\Ui\Form\FormBuilder;
use Defr\VersionControlExtension\Revision\Contract\RevisionRepositoryInterface;

class CreateRevision
{

    /**
     * Form builder instance
     *
     * @var FormBuilder
     */
    protected $builder;

    /**
     * Create an instance of CreateRevision class
     *
     * @param FormBuilder $builder
     */
    public function __construct(FormBuilder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * Handle the command
     *
     * @param SettingRepositoryInterface $settings
     * @param RevisionRepositoryInterface $revisions
     */
    public function handle(
        SettingRepositoryInterface $settings,
        RevisionRepositoryInterface $revisions
    )
    {
        /* @var StreamInterface|null $stream */
        if (!$stream = $this->builder->getFormStream())
        {
            return;
        }

        $namespace = $stream->getNamespace();
        $slug      = $stream->getSlug();

        if (!in_array(
            $namespace . '_' . $slug,
            $settings->value(
                'defr.extension.version_control::enabled_streams',
                []
            )
        ))
        {
            return;
        }

        $fields = [];

        foreach ($this->builder->getFields() as $field)
        {
            $dot_path = array_get($field, 'translatable')
            ? array_get($field, 'locale') . '.' . array_get($field, 'field')
            : array_get($field, 'field');

            array_set(
                $fields,
                $dot_path,
                array_get($field, 'value')
            );
        }

        $data = json_encode($fields);

        $request = app('request');

        $parent = is_numeric($request->segment(4))
        ? $request->segment(4)
        : $request->segment(5);

        $revisions->create(
            compact('namespace', 'slug', 'parent', 'data')
        );
    }
}
