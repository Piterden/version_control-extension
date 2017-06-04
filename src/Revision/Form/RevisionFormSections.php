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
        /* @var FieldType $dataField */
        $dataField = $builder->getFormFields()->first(
            function (FieldType $value)
            {
                return $value->field == 'data';
            }
        );

        $revisionData = json_decode($dataField->value, true);

        $entry = $this->dispatch(new GetRevisionData($revisionData));

        $builder->setSections(
            [
                'main' => [
                    'fields' => [
                        'namespace',
                        'slug',
                        'parent',
                    ],
                ],
                'data' => [
                    'fields' => array_keys($entry),
                ],
            ]
        );
    }
}
