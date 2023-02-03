<?php
namespace Nexit\Example\Model;

use Nexit\Example\Exception\RecordPriorityHighException;
use Nexit\Example\Exception\RecordPriorityLowException;
use Nexit\Example\Exception\RecordTimeToLiveHighException;
use Nexit\Example\Exception\RecordTimeToLiveLowException;

class MxRecord extends GenericRecord
{
    public int $priority;
    /**
     * @throws RecordPriorityHighException
     * @throws RecordTimeToLiveLowException
     * @throws RecordPriorityLowException
     * @throws RecordTimeToLiveHighException
     */
    function __construct(string $destination, string $value, int $ttl, int $priority)
    {
        parent::__construct($destination, $value, $ttl);

        if ($priority < 0)
        {
            throw new RecordPriorityLowException("Priority must be at least 0.");
        }

        # TODO: Check if this is correct, could not verify if this is true in rfc1035 or rfc974
        if ($priority > 65535)
        {
            throw new RecordPriorityHighException("Priority cant be at most 65535.");
        }

        $this->priority = $priority;
    }

    public function getPriority(): int
    {
        return $this->priority;
    }
}
