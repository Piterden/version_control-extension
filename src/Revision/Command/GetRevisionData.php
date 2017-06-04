<?php namespace Defr\VersionControlExtension\Revision\Command;

/**
 *
 */
class GetRevisionData
{

    /**
     * Stored data
     *
     * @var array
     */
    protected $data;

    /**
     * Create an instance of GetRevisionData class
     *
     * @param array $data
     */
    function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Handle the command
     *
     * @return array
     */
    public function handle()
    {
        $entry = [];

        foreach ($this->data as $key => $value)
        {
            if (!is_array($value))
            {
                array_set($entry, $key, $value);

                continue;
            }

            if ($key == 'type')
            {
                array_set($entry, 'type_id', array_get($value, 'id'));
            }

            if ($key == 'entry')
            {
                foreach ($value as $k => $v)
                {
                    if (!(starts_with($k, 'created_')
                        || starts_with($k, 'updated_')
                        || starts_with($k, 'deleted_')))
                    {
                        array_set($entry, 'entry_' . $k, $v);
                    }
                }
            }

            if (strlen($key) == 2)
            {
                foreach ($value as $k => $v)
                {
                    array_set($entry, 'trans_' . $key . '_' . $k, array_get($value, 'id'));
                }
            }
        }

        return $entry;
    }
}
