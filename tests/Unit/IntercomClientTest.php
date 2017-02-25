<?php

namespace Tests\Unit;

use Mediumart\Intercom\IntercomClient;
use Mediumart\Intercom\Client;
use Tests\TestCase;

class IntercomClientTest extends TestCase
{
    public function api_resources()
    {
        return [
          ['users'],
          ['events'],
          ['companies'],
          ['messages'],
          ['conversations'],
          ['leads'],
          ['admins'],
          ['tags'],
          ['segments'],
          ['counts'],
          ['bulk'],
          ['notes'],
        ];
    }

    public function client_api()
    {
        return [
            ['setClient',   ['client']          ],
            ['post',        ['endpoint', []]    ],
            ['put',         ['endpoint', []]    ],
            ['delete',      ['endpoint', []]    ],
            ['get',         ['endpoint', []]    ],
            ['nextPage',    ['endpoint']        ],
            ['getAuth'],
            ['getToken'],
            ['setToken',    ['token']           ],
        ];
    }

    /** @test */
    public function resolve_client_as_singleton()
    {
        $intercom = $this->app->make('intercom');
        $intercom2 = $this->app->make(Client::class);

        $this->assertInstanceOf(Client::class, $intercom);
        $this->assertInstanceOf(Client::class, $intercom2);
        $this->assertSame($intercom, $intercom2);
    }

    /**
     * @test
     *
     * @dataProvider api_resources
     * @param $resource
     */
    public function expose_intercom_api_resources($resource)
    {
        $intercom = $this->app->make(Client::class);

        $this->assertNotNull($intercom->{$resource});
    }

    /**
     * @test
     *
     * @dataProvider api_resources
     * @param $resource
     */
    public function expose_intercom_resources_as_part_of_client_api($resource)
    {
        $intercom = $this->app->make(Client::class);

        $this->assertNotNull( call_user_func([$intercom, $resource]) );
    }

    /**
     * @test
     *
     * @dataProvider client_api
     * @param $method
     * @param array $parameters
     */
    public function expose_intercom_client_api($method, $parameters = [])
    {
        $api = $this->getMockBuilder(IntercomClient::class)
                    ->disableOriginalConstructor()
                    ->getMock();

        $returnValue = in_array($method, ['setClient', 'setToken']) ? Client::class : 'true';

        $api->method($method)->willReturn($returnValue);

        $intercom = new Client($api);

        (in_array($method, ['setClient', 'setToken']))
            ? $this->assertInstanceOf($returnValue, call_user_func_array([$intercom, $method], $parameters))
            : $this->assertEquals($returnValue, call_user_func_array([$intercom, $method], $parameters) );
    }
}
