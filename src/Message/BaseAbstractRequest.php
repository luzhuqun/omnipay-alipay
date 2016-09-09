<?php

namespace Omnipay\Alipay\Message;

use Exception;
use Omnipay\Common\Message\AbstractRequest;

abstract class BaseAbstractRequest extends AbstractRequest
{

    public function setPrivateKey($value)
    {
        $this->setParameter('private_key', $value);
    }


    public function setAppId($value)
    {
        $this->setParameter('app_id	', $value);
    }


    public function setSignType($value)
    {
        if (in_array($value, array('md5', 'rsa'))) {
            throw new Exception('sign_type should be upper case');
        }
        $this->setParameter('sign_type', $value);
    }


    protected function getParamsSignature($data)
    {
        ksort($data);
        reset($data);
        $query = http_build_query($data);
        $query = urldecode($query);

        $signType = strtoupper($this->getSignType());
        if ($signType == 'MD5') {
            $sign = $this->signWithMD5($query);
        } elseif ($signType == 'RSA' || $signType == '0001') {
            $sign = $this->signWithRSA($query, $this->getPrivateKey());
        } else {
            $sign = '';
        }

        return $sign;
    }


    public function getSignType()
    {
        return $this->getParameter('sign_type');
    }


    protected function signWithMD5($query)
    {
        return md5($query . $this->getAppId());
    }


    public function getAppId()
    {
        return $this->getParameter('app_id	');
    }


    protected function signWithRSA($data, $privateKey)
    {
        //$privateKey = $this->prefixCertificateKeyPath($privateKey);
        $privateKey = '-----BEGIN RSA PRIVATE KEY-----
MIICXQIBAAKBgQC7IlrEbqqy3o7i+vTF9glkKJ18uacoxxyHLWmtxU+/UxAjkez4
AvMfCXn0IchfcFpCKiZJOe99wIg/0Bt7rm40zuonrXUrq801SJaPPQzB9h3pIC0b
+2tpVeIIDt11UYrnonfhzLC7G0X5sspDAHoWzbcr1NvW52qJdpQkumyJ5QIDAQAB
AoGBAIs0GA8NP5+FHQdNpS1pQz0lVVmFhQo5a0hHCNjB8Puin1vGXl9zWkUZOIXZ
Z4NPQWT8k7RfC38g7HmDph4P+Fu7KePJ83tNya+hlyyhgm5UvpmM00Vr/Z1RsLly
1nx31P03ydaeTiDLNAV2o7D6jF1p5MTeTcf9pLsqY3IlbprVAkEA72moPqPtK2c0
T7QjPXgyz7VuJGPXj0vX1k0OxENv2+bkg3JMko4VPPfEtBDokkYu8GTbB+wVLB2k
81Yk6QMY4wJBAMgZdaE40n0d1FdNNWX3plE6AC6+mdDJwzWqiiW5Fe5ItFrPttgn
rutvNQc+8fOs4JG9jRVo67pyJTzuVg8GdJcCQCOiy3s/dT7/pqayfohYyt9l9xYN
knlu5Zqtb6RBEXZfAOab7c/mvDyN+MaAuc2ECtqXeI7OUjx10SazTN0uK9cCQARa
mXail+HlDkPACFNpqhLGYk6iExK58SdvyIW9mz6OEm6PankVk/bHeq3nrrgQoOpK
55D5sXdjGHBU90Zoa40CQQDpZJBj1JbOzF+joL1K5iQYo30njTiWDpYmJSWr2V/1
Z5f9N0MsIQhEVqC3bWq21ky3gI41eeApw8Usg6boEJN3
-----END RSA PRIVATE KEY-----';
        $res        = openssl_pkey_get_private($privateKey);
        openssl_sign($data, $sign, $res);
        openssl_free_key($res);
        $sign = base64_encode($sign);

        return $sign;
    }


    /**
     * Prefix the key path with 'file://'
     *
     * @param $key
     *
     * @return string
     */
    protected function prefixCertificateKeyPath($key)
    {
        if (strtoupper(substr(PHP_OS, 0, 3)) != 'WIN' && is_file($key) && substr($key, 0, 7) != 'file://') {
            $key = 'file://' . $key;
        }

        return $key;
    }


    public function getPrivateKey()
    {
        return $this->getParameter('private_key');
    }
}
