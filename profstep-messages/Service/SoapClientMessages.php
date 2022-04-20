<?php

declare(strict_types=1);
/**
 * @by ProfStep, inc. 17.03.2022
 * @website: https://profstep.com
 */

namespace ProfStep\Messages\Service;

use Magento\Framework\Serialize\SerializerInterface;
use Magento\Framework\UrlInterface;
use SoapClient;
use SoapFault;

/**
 * SoapClient class.
 * @package ProfStep\Messages\Service
 */
class SoapClientMessages
{
    /**
     * Access token for api.
     */
    private const ACCESS_TOKEN = 'cdiv88yt900hmuinaieeu2fbm5xhfcjp';

    /**
     * Service which is used in request.
     */
    private const SERVICE = 'profStepMessagesMessageRepositoryV1';

    /**
     * Soap client class(create in method getSoapClient).
     *
     * @var SoapClient
     */
    private $soapClient = null;

    /**
     * Url helper class.
     *
     * @var UrlInterface
     */
    private UrlInterface $url;

    /**
     * Serializer class.
     *
     * @var SerializerInterface
     */
    private SerializerInterface $serializer;

    /**
     * SoapClientMessages constructor.
     * @param UrlInterface $url
     * @param SerializerInterface $serializer
     */
    public function __construct(
        UrlInterface $url,
        SerializerInterface $serializer
    ) {
        $this->url = $url;
        $this->serializer = $serializer;
    }

    /**
     * @return mixed
     */
    public function getAll()
    {
        $methodName = self::SERVICE . 'getAll';

        return $this->soapClient->$methodName();
    }

    /**
     * @param array $args
     */
    public function getList(array $args)
    {

    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getById(int $id)
    {
        $methodName = self::SERVICE . 'getById';

        return $this->soapClient->$methodName($id);
    }

    /**
     * Return Soap Client.
     *
     * @return SoapClient
     * @throws SoapFault
     */
    public function getSoapClient(): SoapClient
    {
        if ($this->soapClient) {
            return $this->soapClient;
        }

        $options = [
            'http' => [
                'header' => 'Authorization: Bearer ' . self::ACCESS_TOKEN
            ]
        ];

        $wsdlUrl = rtrim($this->url->getUrl('soap/all?wsdl&services=' . self::SERVICE), '/');

        $context = stream_context_create($options);
        $this->soapClient = new SoapClient($wsdlUrl, ['version' => SOAP_1_2, 'stream_context' => $context]);

        return $this->soapClient;
    }

    /**
     * Return array of result.
     *
     * @param $result
     * @return array
     */
    public function formatResult($result): array
    {
        $serialized = $this->serializer->serialize($result);

        return $this->serializer->unserialize($serialized)['result'];
    }

    /**
     * Get client data.
     *
     * @param string $methodName
     * @param array $args
     * @return array
     * @throws SoapFault
     */
    public function getClientData(string $methodName, array $args): array
    {
        $soapClient = $this->getSoapClient();
        $method = self::SERVICE . ucfirst($methodName);

        $result = $this->$method($args);

        return $this->formatResult($result);
    }
}
