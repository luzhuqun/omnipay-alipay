<?php

namespace Omnipay\Alipay;

/**
 * Class ExpressGateway
 *
 * @package Omnipay\Alipay
 */
class AuthTokenGateway extends BaseAbstractGateway
{

    protected $service = 'alipay.open.auth.token.app';


    /**
     * Get gateway display name
     *
     * This can be used by carts to get the display name for each gateway.
     */
    public function getName()
    {
        return 'Alipay AUTHTOKEN';
    }


    public function purchase(array $parameters = array())
    {
        $this->setMethod($this->service);

        return $this->createRequest('\Omnipay\Alipay\Message\AuthTokenRequest', $parameters);
    }
}
