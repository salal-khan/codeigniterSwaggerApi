<?php
/**
 * Description of User
 *
 * @author      Muhammad Umar Hayat
 * @description Contacts Class For The Basic Functionality of including Syncing Contacts
 */
require_once APPPATH.'libraries/api/REST_Controller.php';
class User extends REST_Controller
{
    /*
     * Mehtod:   		__construct
     * Params: 			.....
     * Description:             Calls parent contructor and load CI_Controller instance into $CI
     * Returns: 		.....
     */
    public function __construct()
    {
        parent::__construct();
    }
    public function register_post()
    {
        $data = $this->_post_args;
        try
        {
            $this->load->library("api/user_lib");
            $result = $this->user_lib->register($data);
        }
        catch(Exception $e)
        {
            $response['result']['status']       = 'error';
            $response['result']['response']	= $e->getMessage();
            $this->response($response, $e->getCode());
        }
        header("Access-Control-Allow-Origin: *");
        $this->response($result[0], $result[1]);
    }


    /*
     * Mehtod:   		login
     * Params: 			.....
     * Description:             .....
     * Returns: 		.....
     */
    public function login_post()
    {
        $data = $this->_post_args;
        try
        {
            $this->load->library("api/user_lib");
            $result = $this->user_lib->login($data);
        }
        catch(Exception $e)
        {
            $response['result']['status']       = 'error';
            $response['result']['response']	= $e->getMessage();
            $this->response($response, $e->getCode());
        }
        header("Access-Control-Allow-Origin: *");
        $this->response($result[0], $result[1]);
    }


    public function update_post()
    {
        $data = $this->_post_args;
        try
        {
            $this->load->library("api/user_lib");
            $result = $this->user_lib->update($data);
        }
        catch(Exception $e)
        {
            $response['result']['status']       = 'error';
            $response['result']['response']	= $e->getMessage();
            $this->response($response, $e->getCode());
        }
        header("Access-Control-Allow-Origin: *");
        $this->response($result[0], $result[1]);
    }

    public function profile_post()
    {
        $data = $this->_post_args;
        try
        {
            $this->load->library("api/user_lib");
            $result = $this->user_lib->profile($data);
        }
        catch(Exception $e)
        {
            $response['result']['status']       = 'error';
            $response['result']['response']	= $e->getMessage();
            $this->response($response, $e->getCode());
        }
        header("Access-Control-Allow-Origin: *");
        $this->response($result[0], $result[1]);
    }


    public function profile_id_post()
    {
        $data = $this->_post_args;
        try
        {
            $this->load->library("api/user_lib");
            $result = $this->user_lib->profile_id($data);
        }
        catch(Exception $e)
        {
            $response['result']['status']       = 'error';
            $response['result']['response']	= $e->getMessage();
            $this->response($response, $e->getCode());
        }
        header("Access-Control-Allow-Origin: *");
        $this->response($result[0], $result[1]);
    }


    public function block_post()
    {
        $data = $this->_post_args;
        try
        {
            $this->load->library("api/user_lib");
            $result = $this->user_lib->block($data);
        }
        catch(Exception $e)
        {
            $response['result']['status']       = 'error';
            $response['result']['response']	= $e->getMessage();
            $this->response($response, $e->getCode());
        }
        header("Access-Control-Allow-Origin: *");
        $this->response($result[0], $result[1]);
    }


    public function unblock_post()
    {
        $data = $this->_post_args;
        try
        {
            $this->load->library("api/user_lib");
            $result = $this->user_lib->unblock($data);
        }
        catch(Exception $e)
        {
            $response['result']['status']       = 'error';
            $response['result']['response']	= $e->getMessage();
            $this->response($response, $e->getCode());
        }
        header("Access-Control-Allow-Origin: *");
        $this->response($result[0], $result[1]);
    }
}
