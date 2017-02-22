<?php 

namespace Mediumart\Intercom;

use Intercom\IntercomClient;

class Client
{
    /**
     * Api client.
     * 
     * @var \Intercom\IntercomClient;
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
}