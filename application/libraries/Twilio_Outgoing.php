<?php if ( ! class_exists('Twilio_Base')) { require_once(FCPATH . APPPATH . 'libraries/Twilio_Base.php'); }

class Twilio_Outgoing extends Twilio_Base
{
    public $twilio;

    public function __construct()
    {
        parent::__construct();

        $this->twilio = new Services_Twilio($this->account_sid, $this->auth_token);
    }

    public function __call($method, $arguments)
    {
        try
        {
            return call_user_func_array(array($this->twilio, $method), $arguments);
        }
        catch (Exception $e)
        {
            throw new Exception("Undefined method Services_Twilio_Twiml::{$method}() called");
        }
    }

    public function __get($parameter)
    {
        return $this->twilio->{$parameter};
    }
}