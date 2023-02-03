<?php
namespace Nexit\Example\Model;

use Nexit\Example\Exception\RecordTimeToLiveLowException;
use Nexit\Example\Exception\RecordTimeToLiveHighException;

class GenericRecord
{
    public string $destination;
    public string $value;
    public int $ttl;

    /**
     * @throws RecordTimeToLiveLowException
     * @throws RecordTimeToLiveHighException
     */
    function __construct(string $destination, string $value, int $ttl)
    {
        $this->destination = $destination;
        $this->value = $value;

        if ($ttl < 300)
        {
            throw new RecordTimeToLiveLowException("TTL must be at least 300.");
        }

        if ($ttl > 604800)
        {
            throw new RecordTimeToLiveHighException("TTL cant be at most 86400.");
        }

        $this->ttl = $ttl;
    }

    public function getDestination(): string
    {
        return $this->destination;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function getTtl(): int
    {
        return $this->ttl;
    }
}
