<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: hungna
 * Date: 3/23/2017
 * Time: 11:13 AM
 */
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Formatter\LineFormatter;
class Requests
{
    protected $CI;
    protected $mono;
    protected $DEBUG;
    protected $logger_path;
    protected $logger_file;
    protected $timeout = 60;
    protected $header = array();
    /**
     * Requests constructor.
     */
    public function __construct()
    {
        $this->CI =& get_instance();
        // Setup Log
        $this->DEBUG       = false;
        $this->logger_path = APPPATH . 'logs-data/Requests/';
        $this->logger_file = 'Log-' . date('Y-m-d') . '.log';
        $this->mono        = array(
            'dateFormat' => "Y-m-d H:i:s u",
            'outputFormat' => "[%datetime%] %channel%.%level_name%: %message% %context% %extra%\n",
            'monoBubble' => true,
            'monoFilePermission' => 0777
        );
    }
    /**
     * Set Timeout
     * @param $timeout
     * @return $this
     */
    public function setTimeout($timeout)
    {
        $this->timeout = $timeout;
        return $this;
    }
    /**
     * Set Header
     * @param array $header
     * @return $this
     */
    public function setHeader($header = array())
    {
        $this->header = $header;
        return $this;
    }
    /**
     * Send Data Request
     * @param string $url
     * @param array $data
     * @param string $method
     * @param string $magic
     * @return Exception|HttpException|string
     */
    public function sendRequest($url = '', $data = array(), $method = 'GET', $magic = 'cURL')
    {
        $getMethod = strtoupper($method);
        if ($magic == 'file_get_contents')
        {
            $response = self::byGetContents($url, $data, $getMethod);
        }
        else
        {
            $response = self::byCurlRequest($url, $data, $getMethod);
        }
        if ($this->DEBUG === true)
        {
            // create a log channel
            $formatter = new LineFormatter($this->mono['outputFormat'], $this->mono['dateFormat']);
            $stream    = new StreamHandler($this->logger_path . 'sendRequest/' . $this->logger_file, Logger::INFO, $this->mono['monoBubble'], $this->mono['monoFilePermission']);
            $stream->setFormatter($formatter);
            $logger = new Logger('sendRequest');
            $logger->pushHandler($stream);
            $logger->info('||=========== Logger Requests ===========||');
            $logger->info('Method: ' . $getMethod);
            $logger->info('Request: ' . $url, $data);
            $logger->info('Response: ' . json_encode($response));
        }
        return $response;
    }
    /**
     * Request Data by cURL Request
     * @param string $url
     * @param array $data
     * @param string $method
     * @return string
     */
    public function byCurlRequest($url = '', $data = array(), $method = 'GET')
    {
        $getMethod = strtoupper($method);
        // create a log channel
        $formatter = new LineFormatter($this->mono['outputFormat'], $this->mono['dateFormat']);
        $stream    = new StreamHandler($this->logger_path . 'byCurlRequest/' . $this->logger_file, Logger::INFO, $this->mono['monoBubble'], $this->mono['monoFilePermission']);
        $stream->setFormatter($formatter);
        $logger = new Logger('Curl');
        $logger->pushHandler($stream);
        if ($this->DEBUG === true)
        {
            $logger->info('||=========== Logger Requests ===========||');
            $logger->info('Method: ' . $getMethod);
            $logger->info('Request: ' . $url, $data);
        }
        // Curl
        $curl = new Curl\Curl();
        $curl->setOpt(CURLOPT_RETURNTRANSFER, TRUE);
        $curl->setOpt(CURLOPT_SSL_VERIFYPEER, FALSE);
        $curl->setOpt(CURLOPT_ENCODING, "utf-8");
        $curl->setOpt(CURLOPT_MAXREDIRS, 10);
        $curl->setOpt(CURLOPT_TIMEOUT, 300);
        // Request
        if ('POST' == $getMethod)
        {
            $curl->post($url, $data);
        }
        else
        {
            $curl->get($url, $data);
        }
        // Response
        $response = $curl->error ? "cURL Error: " . $curl->error_message : $curl->response;
        // Close Request
        $curl->close();
        // Log Response
        if ($this->DEBUG === true)
        {
            if (is_array($response) || is_object($response))
            {
                $logger->info('Response: ' . json_encode($response));
            }
            else
            {
                $logger->info('Response: ' . $response);
            }
            if (isset($curl->request_headers))
            {
                if (is_array($curl->request_headers))
                {
                    $logger->info('Request Header: ', $curl->request_headers);
                }
                else
                {
                    $logger->info('Request Header: ' . json_encode($curl->request_headers));
                }
            }
            if (isset($curl->response_headers))
            {
                if (is_array($curl->response_headers))
                {
                    $logger->info('Response Header: ', $curl->response_headers);
                }
                else
                {
                    $logger->info('Response Header: ' . json_encode($curl->response_headers));
                }
            }
        }
        // Return Response
        return $response;
    }
    /**
     * Request Data by File Get Contents
     * @param string $url
     * @param array $data
     * @param string $method
     * @return Exception|HttpException|string
     */
    public function byGetContents($url = '', $data = array(), $method = 'GET')
    {
        $getMethod = strtoupper($method);
        // Request
        if ($method === 'POST')
        {
            $opts     = array(
                'http' => array(
                    'method' => 'POST',
                    'header' => 'Content-type: application/x-www-form-urlencoded',
                    'content' => $data
                )
            );
            $context  = stream_context_create($opts);
            $response = file_get_contents($url, false, $context);
        }
        else
        {
            $response = file_get_contents($url . '?' . http_build_query($data));
        }
        // Log Response
        if ($this->DEBUG === true)
        {
            // create a log channel
            $formatter = new LineFormatter($this->mono['outputFormat'], $this->mono['dateFormat']);
            $stream    = new StreamHandler($this->logger_path . 'byGetContents/' . $this->logger_file, Logger::INFO, $this->mono['monoBubble'], $this->mono['monoFilePermission']);
            $stream->setFormatter($formatter);
            $logger = new Logger('get_contents');
            $logger->pushHandler($stream);
            $logger->info('||=========== Logger Requests ===========||');
            $logger->info('Method: ' . $getMethod);
            $logger->info('Request: ' . $url, $data);
            $logger->info('Response: ' . $response);
        }
        // Return Response
        return $response;
    }
    // ========================================================================== //
    /**
     * xml Send Request
     * @param string $url
     * @param string $data
     * @param int $timeout
     * @return mixed|null
     */
    public function xmlRequest($url = '', $data = '', $timeout = 60)
    {
        if (empty($url) || empty($data))
        {
            return null;
        }
        // create a log channel
        $formatter = new LineFormatter($this->mono['outputFormat'], $this->mono['dateFormat']);
        $stream    = new StreamHandler($this->logger_path . 'xmlRequest/' . $this->logger_file, Logger::INFO, $this->mono['monoBubble'], $this->mono['monoFilePermission']);
        $stream->setFormatter($formatter);
        $logger = new Logger('request');
        $logger->pushHandler($stream);
        if ($this->DEBUG === true)
        {
            $logger->info('||=========== Logger xmlRequest ===========||');
            $logger->info('Request URL: ' . $url);
            $logger->info('Request Data: ' . $data);
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        $head[] = "Content-type: text/xml;charset=utf-8";
        curl_setopt($ch, CURLOPT_HTTPHEADER, $head);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($ch, CURLOPT_POST, count($data));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $page = curl_exec($ch);
        curl_close($ch);
        if ($this->DEBUG === true)
        {
            $logger->info('Response from Request: ' . $page);
        }
        return $page;
    }
    /**
     * Get Value from XML Result
     * @param $xml
     * @param $openTag
     * @param $closeTag
     * @return bool|string
     */
    public function xmlGetValue($xml, $openTag, $closeTag)
    {
        $f = strpos($xml, $openTag) + strlen($openTag);
        $l = strpos($xml, $closeTag);
        return ($f <= $l) ? substr($xml, $f, $l - $f) : "";
    }
}
