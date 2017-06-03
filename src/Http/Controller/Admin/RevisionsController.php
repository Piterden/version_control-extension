<?php namespace Defr\VersionControlExtension\Http\Controller\Admin;

use Anomaly\Streams\Platform\Http\Controller\AdminController;
use Defr\VersionControlExtension\Revision\Form\RevisionFormBuilder;
use Defr\VersionControlExtension\Revision\Table\Command\SetRevisionTableEntries;
use Defr\VersionControlExtension\Revision\Table\RevisionTableBuilder;

class RevisionsController extends AdminController
{

    /**
     * Display an index of existing entries.
     *
     * @param  RevisionTableBuilder $table
     * @return Response
     */
    public function index(
        RevisionTableBuilder $table,
        $namespace,
        $slug,
        $parent = null
    )
    {
        return $table->render();
    }

    /**
     * Display an index of existing entries.
     *
     * @param  RevisionTableBuilder $table
     * @return Response
     */
    public function shortIndex(
        RevisionTableBuilder $table,
        $namespace,
        $parent = null
    )
    {
        return $this->index($table, $namespace, $namespace, $parent);
    }

    /**
     * @param RevisionFormBuilder $form
     * @param $namespace
     * @param $slug
     * @param $id
     */
    public function show(
        RevisionFormBuilder $form,
        $namespace,
        $slug,
        $parent,
        $id = null
    )
    {
        return $form->render($id);
    }

    /**
     * @param RevisionFormBuilder $form
     * @param $namespace
     * @param $id
     */
    public function shortShow(
        RevisionFormBuilder $form,
        $namespace,
        $parent,
        $id = null
    )
    {
        return $form->render($id);
    }
}
