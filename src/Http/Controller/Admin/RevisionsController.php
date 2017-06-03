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
     * @param RevisionTableBuilder $table
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(RevisionTableBuilder $table, $namespace, $slug, $id)
    {
        $this->dispatch(new SetRevisionTableEntries($table, $namespace, $slug, $id));

        return $table->render();
    }

    /**
     * Display an index of existing entries.
     *
     * @param RevisionTableBuilder $table
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function shortIndex(RevisionTableBuilder $table, $namespace, $id)
    {
        $this->dispatch(new SetRevisionTableEntries($table, $namespace, $namespace, $id));

        return $table->render();
    }

    /**
     * @param RevisionFormBuilder $form
     * @param $namespace
     * @param $slug
     * @param $id
     */
    public function show(RevisionFormBuilder $form, $namespace, $slug, $id)
    {

    }

    /**
     * @param RevisionFormBuilder $form
     * @param $namespace
     * @param $id
     */
    public function shortShow(RevisionFormBuilder $form, $namespace, $id)
    {

    }
}
