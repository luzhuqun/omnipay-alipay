<?php

namespace Omnipay\Alipay;

/**
 * Class ExpressGateway
 *
 * @package Omnipay\Alipay
 */
class ExpressGateway extends BaseAbstractGateway
{

    protected $service = 'alipay.trade.precreate';


    /**
     * Get gateway display name
     *
     * This can be used by carts to get the display name for each gateway.
     */
    public function getName()
    {
        return 'Alipay Express';
    }


    public function purchase(array $parameters = array())
    {
        $this->setMethod($this->service);

        return $this->createRequest('\Omnipay\Alipay\Message\ExpressPurchaseRequest', $parameters);
    }

    public function query(array $parameters = array())
    {
        $this->setMethod('alipay.trade.query');

        return $this->createRequest('\Omnipay\Alipay\Message\QueryRequest', $parameters);
    }

    public function refund(array $parameters = array())
    {
        $this->setMethod('alipay.trade.refund');

        return $this->createRequest('\Omnipay\Alipay\Message\RefundRequest', $parameters);
    }

    public function close(array $parameters = array())
    {
        $this->setMethod('alipay.trade.close');

        return $this->createRequest('\Omnipay\Alipay\Message\CloseRequest', $parameters);
    }

    public function refundQuery(array $parameters = array())
    {
        $this->setMethod('alipay.trade.fastpay.refund.query');

        return $this->createRequest('\Omnipay\Alipay\Message\RefundQueryRequest', $parameters);
    }

    public function billDownload(array $parameters = array())
    {
        $this->setMethod('alipay.data.dataservice.bill.downloadurl.query');

        return $this->createRequest('\Omnipay\Alipay\Message\BillDownloadRequest', $parameters);
    }

    public function monitor(array $parameters = array())//交易保障接口
    {
        $this->setMethod('monitor.heartbeat.syn');

        return $this->createRequest('\Omnipay\Alipay\Message\MonitorRequest', $parameters);
    }
}
