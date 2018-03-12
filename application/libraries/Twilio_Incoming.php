<?php if ( ! class_exists('Twilio_Base')) { require_once('Twilio_Base.php'); }

class Twilio_Incoming extends Twilio_Base
{
    public $response;

    public function __construct()
    {
        parent::__construct();

        $this->response = new Services_Twilio_Twiml;
    }

    public function __call($method, $arguments)
    {
        try
        {
            return call_user_func_array(array($this->response, $method), $arguments);
        }
        catch (Exception $e)
        {
            throw new Exception("Undefined method Services_Twilio_Twiml::{$method}() called");
        }
    }
}