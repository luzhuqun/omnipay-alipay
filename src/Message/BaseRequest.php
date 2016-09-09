<?php
/**
 * https://doc.open.alipay.com/doc2/detail?treeId=62&articleId=103740&docType=1
 */
namespace Omnipay\Alipay\Message;

use Omnipay\Common\Message\ResponseInterface;

abstract class BaseRequest extends BaseAbstractRequest
{

    protected $liveEndpoint = 'https://openapi.alipaydev.com/gateway.do';


    protected function validateData()
    {
        $this->validate(
            'app_id','method','charset','timestamp','version'

        );
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
    public function getAppId()
    {
        return $this->getParameter('app_id');
    }


    public function setAppId($value)
    {
        return $this->setParameter('app_id', $value);
    }
    public function getMethod()
    {
        return $this->getParameter('method');
    }
    public function setMethod($value)
    {
        $this->setParameter('method', $value);
    }

    public function getCharset()
    {
        return $this->getParameter('charset');
    }


    public function setCharset($value)
    {
        $this->setParameter('charset', $value);
    }


    public function getEndpoint()
    {
        return $this->liveEndpoint;
    }


    /**
     * Send the request with specified data
     *
     * @param  mixed $data The data to send
     *
     * @return ResponseInterface
     */
    public function sendData($data)
    {
        return $this->response = new PurchaseResponse($this, $data);
    }
}
