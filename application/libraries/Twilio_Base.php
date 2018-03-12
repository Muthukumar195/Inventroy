<?php require_once('Twilio/Twilio/Twiml.php');

/**
 * A Code Igniter library to use with Twilio.
 *
 * This library wraps around Twilio's Services_Twilio_Twiml, Services_Twilio, and Services_Twilio_Capability classes for better use within Code Igniter.
 * See controllers/twilio_examples.php for usage examples.
 *
 * Thanks to Ben Edmunds for doing this initially at https://github.com/benedmunds/CodeIgniter-Twilio/blob/master/libraries/Twilio.php . I've taken cues from his work
 * and just expanded into a bit more functionality.
 *
 * @author Rich Brooks - i@iamri.ch
 * @version 1.0
 */

class Twilio_Base
{
    protected $ci
        , $account_sid
        , $auth_token;

    public function __construct()
    {
        $this->ci =& get_instance();

        $this->ci->config->load('twilio', true);

        $this->account_sid = $this->ci->config->item('account_sid', 'twilio');
        $this->auth_token = $this->ci->config->item('auth_token', 'twilio');
    }

    public function __get($var)
    {
        return (isset($this->$var)) ? $this->$var : false;
    }
}