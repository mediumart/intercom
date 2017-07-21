<?php

namespace Mediumart\Intercom\Tests\Unit;

use Mediumart\Intercom\IntercomClient;
use Mediumart\Intercom\Tests\TestCase;

class IntercomClientTest extends TestCase
{
    /** @test */
    public function _() 
    {
        $intercom = new IntercomClient(null, null);

        $intercom->setToken('token');

        $this->assertEquals('token', $intercom->getToken());
    }
}
