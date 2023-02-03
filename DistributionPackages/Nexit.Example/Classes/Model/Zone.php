<?php
namespace Nexit\Example\Model;

class Zone
{
    public string $originDomain = "";
    public array $nameServerRecords = array();
    public array $addressRecords = array();
    public array $quadAddressRecords = array();
    public array $mailExchangeRecords = array();
    public array $pointerRecords = array();
    public array $canonicalNameRecords = array();
    public array $textRecords = array();
    public array $senderPolicyFrameworkRecords = array();

    public function addNameServerRecord(string $nameserver): bool
    {
        if (in_array($nameserver, $this->nameServerRecords)) {
            throw new \Exception("Nameserver already exists");
        }

        if (count($this->nameServerRecords) >= 4) {
            throw new \Exception("Too many nameservers");
        }

        if (!filter_var($nameserver, FILTER_VALIDATE_DOMAIN, FILTER_FLAG_HOSTNAME)) {
            throw new \Exception("Invalid nameserver");
        }

        $this->nameServerRecords[] = $nameserver;
        return true;
    }

    public function addAddressRecord(string $destination, string $ip, int $ttl): bool
    {
        if (in_array($ip, $this->addressRecords)) {
            throw new \Exception("A record already exists");
        }

        if (!filter_var($ip, FILTER_VALIDATE_IP)) {
            throw new \Exception("Invalid IP");
        }

        $aRecord = new GenericRecord($destination, $ip, $ttl);
        $this->addressRecords[] = $aRecord;
        return true;
    }

    public function addQuadAddressRecord(string $destination, string $ip, int $ttl): bool
    {
        if (in_array($ip, $this->quadAddressRecords)) {
            throw new \Exception("AAAA record already exists");
        }

        if (!filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
            throw new \Exception("Invalid IP");
        }

        $aaaaRecord = new GenericRecord($destination, $ip, $ttl);
        $this->quadAddressRecords[] = $aaaaRecord;
        return true;
    }

    public function addMailExchangeRecord(string $destination, string $mailServer, int $ttl, int $priority): bool
    {
        if (in_array($mailServer, $this->mailExchangeRecords)) {
            throw new \Exception("MX record already exists");
        }

        if (!filter_var($mailServer, FILTER_VALIDATE_DOMAIN, FILTER_FLAG_HOSTNAME)) {
            throw new \Exception("Invalid mailserver");
        }

        $mxRecord = new MailExchangeRecord($destination, $mailServer, $ttl, $priority);
        $this->mailExchangeRecords[] = $mxRecord;
        return true;
    }
}
