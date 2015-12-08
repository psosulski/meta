<?php
namespace AppBundle\Service;

use Doctrine\ORM\EntityManager;
use AppBundle\Entity\Entry;
use AppBundle\Entity\User;
use Symfony\Component\Config\Definition\Exception\Exception;

/**
 * This service should only perform request api request and return response. DB operations should be excluded due to narrowing responsibility.
 *
 * Class ApiService
 * @package AppBundle\Service
 */
class ApiService
{
    //@TODO CREATE AND MOVE IT TO ADMIN DASHBOARD
    const META_API_KEY = 'OlyymjBYupmshyZk9iXQRZT7mtjpp1xnilhjsnBCXucSdpBCLL';
    const META_API_URL = 'https://metacritic-2.p.mashape.com/find/';
    protected $em;

    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }

    public function getData($type, array $params, $httpMethod = "GET")
    {
        $params = $this->buildParams($params,$httpMethod);
        $response = $this->executeCurl(self::META_API_URL . $type, $params);

        return $this->prepareResponse($response);

    }

    private function executeCurl($url, array $params)
    {

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        if (isset($params["POST"])) {
            curl_setopt($ch, CURLOPT_POST, 1);
            $queryString = urlencode(http_build_query($params["POST"]));
            curl_setopt($ch, CURLOPT_POSTFIELDS, $queryString);
        }
        if (isset($params["PUT"])) {
            //@TODO
            throw new Exception('The PUT is currently not supported');
        }
        if (isset($params["GET"])) {
            curl_setopt($ch, CURLOPT_HTTPGET, 1);
            $queryString = urlencode(http_build_query($params["GET"]));
            curl_setopt($ch, CURLOPT_URL, $url . '?' . $queryString);

        }
        if (isset($params["HEADERS"])) {
            curl_setopt($ch, CURLOPT_HEADER, 1);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $params["HEADERS"]);
        }

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $response = curl_exec($ch);
        curl_close($ch);

        return $response;

    }

    private function buildParams(array $params,$httpMethod)
    {
        $curlParams = array(
            "HEADERS" => array(
                'X-Mashape-Key: ' . self::META_API_KEY,
                'Accept: application/json'
            )
        );
        $curlParams[$httpMethod] = array();
        foreach ($params as $k => $v) {
            $curlParams[$httpMethod] = $params;
        }
        return $curlParams;
    }

    private function prepareResponse($result)
    {
        return $result;
    }

}
