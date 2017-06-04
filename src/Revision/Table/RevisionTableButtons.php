<?php namespace Defr\VersionControlExtension\Revision\Table;

/**
 * Class for revision table buttons.
 *
 * @package    defr.extension.version_control
 *
 * @author     Denis Efremov <efremov.a.denis@gmail.com>
 */
class RevisionTableButtons
{

    /**
     * Handle the command
     *
     * @param RevisionTableBuilder $builder
     */
    public function handle(RevisionTableBuilder $builder)
    {
        $href = app('request')->segment(3) === app('request')->segment(2)
        ? 'admin/{entry.namespace}/{entry.slug}/show_revision/{entry.parent}/{entry.id}'
        : 'admin/{entry.namespace}/show_revision/{entry.parent}/{entry.id}';

        $builder->setButtons([
            'view' => [
                'href' => $href,
            ],
        ]);
    }
}
