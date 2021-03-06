<?php

namespace Omnipay\Alipay\Message;

class WapExpressPurchaseRequest extends BaseRequest
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

        $data = array(

            "app_id" => $this->getAppId(),
            "biz_content" => $this->getBizContent(),
            "charset" => $this->getCharset(),
            "method" => $this->getMethod(),
            "timestamp" => $this->getTimestamp(),
            "version" => $this->getVersion(),

        );

        $data = array_filter($data);
        $data['sign_type'] = $this->getSignType();
        $data['sign'] = $this->getParamsSignature($data);


        return $data;
    }

    protected function validateData()
    {
        parent::validateData();
        $this->validate('subject');
        $this->validate('total_amount');
        $this->validate('out_trade_no');
        $this->validate('product_code');
    }

    public function getSubject()
    {
        return $this->getParameter('subject');
    }

    public function setSubject($value)
    {
        $this->setParameter('subject', $value);
        $this->bizParas['subject'] = $value;

    }

    public function getTotalAmount()
    {
        return $this->getParameter('total_amount');
    }

    public function setTotalAmount($value)
    {
        $this->setParameter('total_amount', $value);
        $this->bizParas['total_amount'] = $value;
    }

    public function getOutTradeNo()
    {
        return $this->getParameter('out_trade_no');
    }

    public function setOutTradeNo($value)
    {
        $this->setParameter('out_trade_no', $value);
        $this->bizParas['out_trade_no'] = $value;
    }

    public function getProductCode()
    {
        return $this->getParameter('product_code');
    }

    public function setProductCode($value)
    {
        $this->setParameter('product_code', $value);
        $this->bizParas['product_code'] = $value;
    }

    public function getBizContent()
    {
        if (!empty($this->bizParas)) {
            $this->bizContent = json_encode($this->bizParas, JSON_UNESCAPED_UNICODE);
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
