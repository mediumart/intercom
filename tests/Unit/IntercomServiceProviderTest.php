<?php 

namespace Mediumart\Intercom\Tests\Unit;

use Mediumart\Intercom\Client;
use Mediumart\Intercom\Tests\TestCase;
use Mediumart\Intercom\IntercomServiceProvider;

class IntercomServiceProviderTest extends TestCase
{
    /** @test */
    public function it_provide_services() 
    {
        $provider = $this->app->getProvider(IntercomServiceProvider::class);

        $this->assertEquals(['intercom', Client::class], $provider->provides());
    }

    /** @test */
    public function it_register_services() 
    {
        $app = new \Illuminate\Container\Container();
        $provider = new IntercomServiceProvider($app);

        $provider->register();

        $this->assertInstanceOf(Client::class, $app->make('intercom'));
        $this->assertInstanceOf(Client::class, $app->make(Client::class));
    }
}
