<?php 

namespace Mediumart\Intercom;

class Client
{
    /**
     * Api client.
     * 
     * @var \Mediumart\Intercom\IntercomClient;
     */
    protected $intercomClient;

    /**
     * Contstrucor.
     * 
     * @param IntercomClient $intercomClient
     */
    public function __construct(IntercomClient $intercomClient)
    {
        $this->intercomClient = $intercomClient;
    }

    /**
     * Exposed intercom Api resources.
     * 
     * @param  string $property 
     * @return mixed
     * 
     * @throws \Exception
     */
    public function __get($property)
    {        
        if ($this->isClientPublicAttribute($property)) {
            return $this->intercomClient->{$property};
        }

        return null;
    }

    /**
     * Exposed intercomClient api.
     * 
     * @param  string $method
     * @param  array $parameters
     * @return mixed
     *
     * @throws \Exception
     */
    public function __call($method, $parameters)
    {
        if ($this->isClientPublicMethod($method) || IntercomClient::hasMacro($method)) {
            return call_user_func_array(array($this->intercomClient, $method), $parameters);
        }

        return static::__get($method);
    }

    /**
     * Sets GuzzleHttp client.
     *
     * @param $client
     * @return $this
     */
    public function setClient($client)
    {
        $this->intercomClient->setClient($client);

        return $this;
    }

    /**
     * Set the client access token.
     *
     * @param string $token
     * @return $this
     */
    public function setToken($token)
    {
        $this->intercomClient->setToken($token);

        return $this;
    }

    /**
     * Check method is part of the public client api.
     * 
     * @param  string  $method
     * @return boolean
     */
    protected function isClientPublicMethod($method)
    {
        return method_exists($this->intercomClient, $method) 
                    && (new \ReflectionMethod($this->intercomClient, $method))
                            ->isPublic();
    }

    /**
     * Check property is part of the public client api.
     *   
     * @param  string  $property
     * @return boolean
     */
    protected function isClientPublicAttribute($property)
    {
        return property_exists($this->intercomClient, $property) 
                    && (new \ReflectionProperty(get_class($this->intercomClient), $property))
                            ->isPublic();
    }
}
