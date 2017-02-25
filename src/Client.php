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
        if( property_exists($this->intercomClient, $property) &&
            (new \ReflectionProperty(
                get_class($this->intercomClient), $property
            ))->isPublic() ) {
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
        if( method_exists($this->intercomClient, $method) && 
            (new \ReflectionMethod(
                $this->intercomClient, $method
            ))->isPublic() ) {
            return call_user_func_array(
                array($this->intercomClient, $method), $parameters
            );
        }

        return self::__get($method);
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
}