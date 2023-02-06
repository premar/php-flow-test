<?php
namespace Nexit\Example\Model;

use Doctrine\ORM\Mapping as ORM;
use Nexit\Example\Exception\RecordTimeToLiveLowException;
use Nexit\Example\Exception\RecordTimeToLiveHighException;

class GenericRecord
{
    /**
     * @var Zone
     * @ORM\ManyToOne(cascade={"persist", "merge"}, inversedBy="nameServerRecords")
     * @ORM\JoinColumn(nullable=false)
     */

    protected $zone;
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

    /**
     * @return Zone
     */
    public function getZone(): Zone
    {
        return $this->zone;
    }

    /**
     * @param Zone $zone
     */
    public function setZone(Zone $zone): void
    {
        $this->zone = $zone;
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
