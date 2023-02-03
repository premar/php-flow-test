<?php
namespace Nexit\Example\Model;

use JMS\Serializer\Annotation as JMS;

class Zone
{
    /**
     * @JMS\SerializedName("domain_name")
     */
    public string $originDomain = "";
    /**
     * @JMS\SerializedName("ns")
     */
    public array $nameServerRecords = array();
    /**
     * @JMS\SerializedName("a")
     */
    public array $addressRecords = array();
    /**
     * @JMS\SerializedName("aaaa")
     */
    public array $quadAddressRecords = array();
    /**
     * @JMS\SerializedName("mx")
     */
    public array $mailExchangeRecords = array();
    /**
     * @JMS\SerializedName("ptr")
     */
    public array $pointerRecords = array();
    /**
     * @JMS\SerializedName("cname")
     */
    public array $canonicalNameRecords = array();
    /**
     * @JMS\SerializedName("txt")
     */
    public array $textRecords = array();
    /**
     * @JMS\SerializedName("spf")
     */
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
