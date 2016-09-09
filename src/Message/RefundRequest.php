<?php

namespace Omnipay\Alipay\Message;

class ExpressRefundRequest extends BaseRequest
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
        $this->validate('refund_amount');
    }

    public function getTradeNo()
    {
        return $this->getParameter('trade_no');
    }
    public function setTradeNo($value)
    {
        $this->setParameter('trade_no', $value);
        $this->bizParas['trade_no'] = $value;
    }

    public function getRefundAmount()
    {
        return $this->getParameter('refund_amount');
    }
    public function setRefundAmount($value)
    {
        $this->setParameter('refund_amount', $value);
        $this->bizParas['refund_amount'] = $value;
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

    public function getRefundReason()
    {
        return $this->getParameter('refund_reason');
    }
    public function setRefundReason($value)
    {
        $this->setParameter('refund_reason', $value);
        $this->bizParas['refund_reason'] = $value;
    }

    public function getOutRequestNo()
    {
        return $this->getParameter('out_request_no');
    }
    public function setOutRequestNo($value)
    {
        $this->setParameter('out_request_no', $value);
        $this->bizParas['out_request_no'] = $value;
    }

    public function getOperatorId()
    {
        return $this->getParameter('operator_id');
    }
    public function setOperatorId($value)
    {
        $this->setParameter('operator_id', $value);
        $this->bizParas['operator_id'] = $value;
    }

    public function getStoreId()
    {
        return $this->getParameter('store_id');
    }
    public function setStoreId($value)
    {
        $this->setParameter('store_id', $value);
        $this->bizParas['store_id'] = $value;
    }

    public function getTerminalId()
    {
        return $this->getParameter('terminal_id');
    }
    public function setTerminalId($value)
    {
        $this->setParameter('terminal_id', $value);
        $this->bizParas['terminal_id'] = $value;
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
