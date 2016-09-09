<?php

namespace Omnipay\Alipay\Message;

class BillDownloadRequest extends BaseRequest
{

    /**
     * Get the raw data array for this message. The format of this varies from gateway to
     * gateway, but will usually be either an associative array, or a SimpleXMLElement.
     *
     * @return mixed
     */
    private $bizParas = array();
    private $bizContent = NULL;

    public function getData()
    {
        $this->validateData();
        $data              = array(
            "app_id" => $this->getAppId(),
            "biz_content" => $this->getBizContent(),
            "charset" => $this->getCharset(),
            "method" => $this->getMethod(),
            "timestamp" => $this->getTimestamp(),
            "version" => $this->getVersion(),
        );
        $data              = array_filter($data);
        $data['sign_type'] = $this->getSignType();
        $data['sign']      = $this->getParamsSignature($data);

        return $data;
    }

    protected function validateData()
    {
        parent::validateData();
        $this->validate('bill_type');
        $this->validate('bill_date');

    }

    public function getBillType()
    {
        return $this->getParameter('bill_type');
    }
    public function setBillType($value)
    {
        $this->setParameter('bill_type', $value);
        $this->bizParas['bill_type'] = $value;
    }

    public function getBillDate()
    {
        return $this->getParameter('bill_date');
    }
    public function setBillDate($value)
    {
        $this->setParameter('bill_date', $value);
        $this->bizParas['bill_date'] = $value;
    }

    public function getBizContent()
    {
        if(!empty($this->bizParas)){
            $this->bizContent = json_encode($this->bizParas,JSON_UNESCAPED_UNICODE);
        }
        return $this->bizContent;
    }
    public function getVersion()
    {
        return $this->getParameter('version');
    }
    public function setVersion($value)
    {
        $this->setParameter('version', $value);
    }
    public function getTimestamp()
    {
        return $this->getParameter('timestamp');
    }
    public function setTimestamp($value)
    {
        $this->setParameter('timestamp', $value);
    }
    public function getCharset()
    {
        return $this->getParameter('charset');
    }
    public function setCharset($value)
    {
        $this->setParameter('charset', $value);
    }
}
