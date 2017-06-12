<?php namespace Defr\VersionControlExtension\Http\Controller\Admin;

use Anomaly\Streams\Platform\Http\Controller\AdminController;
use Defr\VersionControlExtension\Revision\Command\RestoreRevision;
use Defr\VersionControlExtension\Revision\Form\RevisionFormBuilder;
use Defr\VersionControlExtension\Revision\Table\RevisionTableBuilder;
use Anomaly\Streams\Platform\Stream\Contract\StreamRepositoryInterface;

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
    public function index(RevisionTableBuilder $table, $namespace, $slug, $parent = 0)
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
    public function shortIndex(RevisionTableBuilder $table, $namespace, $parent = 0)
    {
        return $this->index($table, $namespace, $namespace, $parent);
    }

    /**
     * Show one revision item
     *
     * @param  RevisionFormBuilder $form
     * @param  string              $namespace The namespace
     * @param  string              $slug      The slug
     * @param  mixed               $parent    The parent
     * @param  mixed               $id        The identifier
     * @return Response
     */
    public function show(StreamRepositoryInterface $streams, RevisionFormBuilder $form, $namespace, $slug, $parent, $id = 0)
    {

        // dd($streams->findBySlugAndNamespace($slug, $namespace)->getFieldType('parent'));
        // $this->dispatch(new SetModelsFromResponse($builder));
        $parentModel = $streams->findBySlugAndNamespace($slug, $namespace)->getEntryModel();

        $parentEntry = $parentModel->where('id', $parent)->first();

        $form->setParent($parentEntry);
        // dd($form->setParent($parentEntry));

        return $form->render($id);
    }

    /**
     * Show short route of one item of revision
     *
     * @param  RevisionFormBuilder $form
     * @param  string              $namespace The namespace
     * @param  string              $parent    The parent
     * @param  mixed               $id        The identifier
     * @return Response
     */
    public function shortShow(StreamRepositoryInterface $streams, RevisionFormBuilder $form, $namespace, $parent, $id = 0)
    {
        return $this->show($streams, $form, $namespace, $namespace, $parent, $id);
    }

    /**
     * Restore one revision
     *
     * @param RevisionTableBuilder $table The table
     * @param integer              $id    The identifier
     */
    public function restore(RevisionTableBuilder $table, $namespace, $id)
    {
        if (!$this->dispatch(new RestoreRevision($id)))
        {
            throw new \Exception('Can\'t restore revision, sorry ((');
        }

        return $table->render();
    }
}
