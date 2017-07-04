<?php 

namespace Mediumart\Intercom;

use Intercom\IntercomClient as BaseClient;

class IntercomClient extends BaseClient
{
    /**
     * Notes.
     * 
     * @var \Intercom\IntercomNotes
     */
    public $notes;

    /**
     * Visitors.
     * 
     * @var \Intercom\IntercomVisitors
     */
    public $visitors;

    /**
     * Get the client acces token.
     * 
     * @return string 
     */
    public function getToken()
    {
        return $this->usernamePart;
    }

    /**
     * Set the client access token.
     * 
     * @param string $token
     */
    public function setToken($token)
    {
        $this->usernamePart = $token;
    }
}