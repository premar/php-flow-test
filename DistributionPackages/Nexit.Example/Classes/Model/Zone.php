<?php
namespace Nexit\Example\Model;

class Zone
{
    public string $origin = "";
    public array $nsRecords = array();
    public array $aRecords = array();
    public array $aaaaRecords = array();
    public array $mxRecords = array();
    public array $prtRecords = array();
    public array $cnameRecords = array();
    public array $txtRecords = array();
    public array $spfRecords = array();

    public function addNsRecord(string $nameserver): bool
    {
        if (in_array($nameserver, $this->nsRecords)) {
            throw new \Exception("Nameserver already exists");
        }

        if (count($this->nsRecords) >= 4) {
            throw new \Exception("Too many nameservers");
        }

        if (!filter_var($nameserver, FILTER_VALIDATE_DOMAIN, FILTER_FLAG_HOSTNAME)) {
            throw new \Exception("Invalid nameserver");
        }

        $this->nsRecords[] = $nameserver;
        return true;
    }

    public function addARecord(string $destination, string $ip, int $ttl): bool
    {
        if (in_array($ip, $this->aRecords)) {
            throw new \Exception("A record already exists");
        }

        if (!filter_var($ip, FILTER_VALIDATE_IP)) {
            throw new \Exception("Invalid IP");
        }

        $aRecord = new GenericRecord($destination, $ip, $ttl);
        $this->aRecords[] = $aRecord;
        return true;
    }

    public function addAAAARecord(string $destination, string $ip, int $ttl): bool
    {
        if (in_array($ip, $this->aaaaRecords)) {
            throw new \Exception("AAAA record already exists");
        }

        if (!filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
            throw new \Exception("Invalid IP");
        }

        $aaaaRecord = new GenericRecord($destination, $ip, $ttl);
        $this->aaaaRecords[] = $aaaaRecord;
        return true;
    }

    public function addMxRecord(string $destination, string $mailserver, int $ttl, int $priority): bool
    {
        if (in_array($mailserver, $this->mxRecords)) {
            throw new \Exception("MX record already exists");
        }

        if (!filter_var($mailserver, FILTER_VALIDATE_DOMAIN, FILTER_FLAG_HOSTNAME)) {
            throw new \Exception("Invalid mailserver");
        }

        $mxRecord = new MxRecord($destination, $mailserver, $ttl, $priority);
        $this->mxRecords[] = $mxRecord;
        return true;
    }
}
