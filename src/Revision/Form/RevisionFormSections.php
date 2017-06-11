<?php namespace Defr\VersionControlExtension\Revision\Form;

use Anomaly\Streams\Platform\Addon\FieldType\FieldType;
use Defr\VersionControlExtension\Revision\Command\GetRevisionData;
use Illuminate\Foundation\Bus\DispatchesJobs;

class RevisionFormSections
{

    use DispatchesJobs;

    /**
     * Handle the command
     *
     * @param RevisionFormBuilder $builder
     */
    public function handle(RevisionFormBuilder $builder)
    {
        // /* @var FieldType $dataField */
        // $dataField = $builder->getFormFields()->first(
        //     function (FieldType $value)
        //     {
        //         return $value->field == 'data';
        //     }
        // );

        // $revisionData = json_decode($dataField->value, true);

        // $entry = $this->dispatch(new GetRevisionData($revisionData));

        $builder->setSections([
            'general' => [
                'tabs' => [
                    'main'     => [
                        'title'  => 'defr.module.catalog::tab.main',
                        'fields' => [
                            'created_at',
                            'namespace',
                            'slug',
                            'parent',
                        ],
                    ],
                    'data'    => [
                        'title'  => 'defr.module.catalog::tab.media',
                        'fields' => [
                            'data',
                        ],
                    ],
                ],
            ],
        ]);
    }
}
