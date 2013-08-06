<?php

/*
 * This file is part of the lx\Socket library.
 *
 * (c) Victor J. C. Geyer <victorgeyer@ciscaja.com>
 */

namespace lx\Socket\Connection;

use lx\Http\Http;

class HttpConnection extends RemoteSocketConnection
{
    /**
     * @var string
     */
    protected $response_header;

    /**
     * @var string
     */
    protected $request_header;

    /**
     * @var Http
     */
    protected $http;

    /**
     * @param string $host
     * @param int    $port
     * @param array  $parameters
     */
    public function __construct($host, $port, array $parameters = array())
    {
        parent::__construct($host, $port, $parameters);
        $this->http = new Http;
    }

    /**
     * @param string $header
     *
     * @return $this
     */
    public function setRequestHeader($header)
    {
        $this->request_header = $header;
    }

    /**
     * @return string|null
     */
    public function getRequestHeader()
    {
        return $this->request_header;
    }

    /**
     * @return array
     */
    public function getParsedRequestHeader()
    {
        return $this->http->parse_headers($this->getRequestHeader());
    }

    /**
     * @param string $header
     *
     * @return $this
     */
    public function setResponseHeader($header)
    {
        $this->response_header = $header;
    }

    /**
     * @return string|null
     */
    public function getResponseHeader()
    {
        return $this->response_header;
    }

    /**
     * @return array
     */
    public function getParsedResponseHeader()
    {
        return $this->http->parse_headers($this->getResponseHeader());
    }
}