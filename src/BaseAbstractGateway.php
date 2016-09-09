<?php

namespace Omnipay\Alipay;

use Omnipay\Common\AbstractGateway;
use Omnipay\Common\Exception\InvalidRequestException;

/**
 * Alipay Base Gateway Class
 */
abstract class BaseAbstractGateway extends AbstractGateway
{

    public function getDefaultParameters()
    {
        return array(

            'app_id'          => '2016082000300403',
            'signType'     => 'RSA',
            'Charset' => 'utf-8',
        );
    }
    public function setBizContent($value)
    {
        $this->setParameter('biz_content', $value);
    }
    public function getBizContent()
    {
        return $this->getParameter('biz_content');
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

    public function getAppId()
    {
        return $this->getParameter('app_id');
    }


    public function setAppId($value)
    {
        return $this->setParameter('app_id', $value);
    }


    public function setNotifyUrl($value)
    {
        return $this->setParameter('notify_url', $value);
    }


    public function setReturnUrl($value)
    {
        return $this->setParameter('return_url', $value);
    }


    public function getSignType()
    {
        return $this->getParameter('sign_type');
    }


    public function setSignType($value)
    {
        return $this->setParameter('sign_type', $value);
    }

    public function getExterInvokeIp()
    {
        return $this->getParameter('exter_invoke_ip');
    }


    public function setExterInvokeIp($value)
    {
        return $this->setParameter('exter_invoke_ip', $value);
    }

    public function getMethod()
    {
        return $this->getParameter('Method');
    }


    public function setMethod($value)
    {
        return $this->setParameter('method', $value);
    }

    public function getAlipayPublicKey()
    {
        return $this->getParameter('alipay_public_key');
    }


    public function setAlipayPublicKey($value)
    {
        return $this->setParameter('alipay_public_key', $value);
    }

    public function setExtendParam($value)
    {
        $this->setParameter('extend_param', $value);
    }

    public function getExtendParam()
    {
        return $this->getParameter('extend_param');
    }

    public function purchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Alipay\Message\ExpressPurchaseRequest', $parameters);
    }


    public function completePurchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Alipay\Message\ExpressCompletePurchaseRequest', $parameters);
    }

    public function sendGoods(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Alipay\Message\SendGoodsRequest', $parameters);
    }
}
