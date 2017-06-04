<?php namespace Defr\VersionControlExtension\Http\Controller\Admin;

use Anomaly\Streams\Platform\Http\Controller\AdminController;
use Defr\VersionControlExtension\Revision\Form\RevisionFormBuilder;
use Defr\VersionControlExtension\Revision\Table\RevisionTableBuilder;

class RevisionsController extends AdminController
{

    /**
     * Display an index of existing entries.
     *
     * @param  RevisionTableBuilder $table
     * @param  string               $namespace The namespace
     * @param  string               $slug      The slug
     * @param  mixed                $parent    The parent
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
     * @param  string               $namespace The namespace
     * @param  mixed                $parent    The parent
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
     * { function_description }
     *
     * @param  RevisionFormBuilder $form
     * @param  string              $namespace The namespace
     * @param  string              $slug      The slug
     * @param  mixed               $parent    The parent
     * @param  mixed               $id        The identifier
     * @return Response
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
     * { function_description }
     *
     * @param  RevisionFormBuilder $form
     * @param  string              $namespace The namespace
     * @param  string              $parent    The parent
     * @param  mixed               $id        The identifier
     * @return Response            ( description_of_the_return_value )
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
