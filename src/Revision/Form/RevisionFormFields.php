<?php namespace Defr\VersionControlExtension\Revision\Form;

use Illuminate\Foundation\Bus\DispatchesJobs;

class RevisionFormFields
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

        // $fields = [];

        // foreach ($entry as $key => $value)
        // {
        //     array_set($fields, 'entry_'.$key, [
        //         'disabled' => true,
        //         'type'     => 'anomaly.field_type.text',
        //         'field'    => $key,
        //     ]);
        // }

    }
}
