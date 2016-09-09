<?php

namespace Omnipay\Alipay\Message;

class AuthTokenRequest extends BaseRequest
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
        $this->validate('grant_type');
    
    }

    public function getGrantType()
    {
        return $this->getParameter('grant_type');
    }

    public function setGrantType($value)
    {
        $this->setParameter('grant_type', $value);
        $this->bizParas['grant_type'] = $value;

    }

    public function getCode()
    {
        return $this->getParameter('code');
    }

    public function setCode($value)
    {
        $this->setParameter('code', $value);
        $this->bizParas['code'] = $value;
    }

    public function getRefreshToken()
    {
        return $this->getParameter('refresh_token');
    }

    public function setRefreshToken($value)
    {
        $this->setParameter('refresh_token', $value);
        $this->bizParas['refresh_token'] = $value;
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
