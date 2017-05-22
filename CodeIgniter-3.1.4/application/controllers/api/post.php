<?php
/**
 * Description of Subject
 *
 * @author      Muhammad Umar Hayat
 * @description Contacts Class For The Basic Functionality of including Syncing Contacts
 */
require_once APPPATH.'libraries/api/REST_Controller.php';
class Post extends REST_Controller
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
    /*
     * Mehtod:   		add_subject
     * Params: 			.....
     * Description:             .....
     * Returns: 		.....
     */
    public function upload_post()
    {
        $data = $this->_post_args;
        try
        {
          $this->load->library("api/posts_lib");
            $result = $this->posts_lib->upload($data);
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

    public function newsfeed_post()
    {
        $data = $this->_post_args;
        try
        {
          $this->load->library("api/posts_lib");
            $result = $this->posts_lib->newsfeed($data);
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

    public function searchpost_post()
    {
        $data = $this->_post_args;
        try
        {
          $this->load->library("api/posts_lib");
            $result = $this->posts_lib->searchpost($data);
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
