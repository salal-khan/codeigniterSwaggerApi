<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of Subject_lib
 *
 * @author: Muhammad Umar Hayat
 * @Description: users library to perform user functions.
 */

class Posts_lib
{
    /*
     * Property: 		CI
     * Description:             This will hold CI_Controller instance to perform all CI functionality
     * Type:     		Private
     */
    private $CI;

    /*
     * Mehtod:   		__construct
     * Params: 			.....
     * Description:             Load CI_Controller instance into $CI
     * Returns: 		.....
     */
    public function __construct()
    {
        $this->CI = &get_instance();
    }
    /*
     * Mehtod:   		add_subject
     * Params: 			.....
     * Description:             Add Subject
     * Returns: 		.....
     */
    public function upload($request = array())
    {
        $response       = array();
        /*
         * addSlashes Just to Secure From SQL Injection
         */
        $api_secret       = @trim(addslashes($request['api_secret']));
        $path             = @trim(addslashes($request['path']));
        $post_type        = @trim(addslashes($request['post_type']));
        $caption          = @trim(addslashes($request['caption']));
        $location         = @trim(addslashes($request['location']));
        $lat         = @trim(addslashes($request['lat']));
        $long         = @trim(addslashes($request['long']));
        if(empty($api_secret))
        {
            $response['result']['status']   = 'error';
            $response['result']['response'] = "API Secret is missing.";
            return array($response, 400);
        }
        $this->CI->load->model('api_keys_model');
        $data1    = $this->CI->api_keys_model->get_record_for_field('api_secret', $api_secret);

        if(empty($post_type))
        {
            $response['result']['status']   = 'error';
            $response['result']['response'] = "Post Type is missing.";
            return array($response, 400);
        }
        if(!empty($path))
        {
            $this->CI->load->helper('image_lib');
            $dir                = APPPATH.'../assets/uploads/';
            $display_picture    = image_lib::img($path, $dir);
        }
        $this->CI->load->model('posts_model');

        $data_array['user_id']          = $data1[0]->user_id;
        $data_array['path']             = $display_picture;

        $data_array['post_type']        = $post_type;
        $data_array['caption']          = $caption;
        $data_array['location']         = $location;
        $data_array['lat']              = $lat;
        $data_array['long']             = $long;
        $data_array['date_added']       = date("Y-m-d H:i:s");
        $data_array['last_updated']     = date("Y-m-d H:i:s");
        $this->CI->posts_model->save($data_array);

        $response['result']['status']       = 'success';
        $response['result']['response']     = "Post have been uploaded Successfully.";
        return array($response, 200);
    }

    public function newsfeed($request)
    {
      $api_secret       = @trim(addslashes($request['api_secret']));
      $page_number       = @trim(addslashes($request['page_number']));
      $this->CI->load->model('posts_model');
      if(empty($api_secret))
      {
          $response['result']['status']   = 'error';
          $response['result']['response'] = "API Secret is missing.";
          return array($response, 400);
      }
      $data = $this->CI->posts_model->get_record('*',$page_number);

      $response['result']['status']       = 'success';
      $response['result']['response']     = "Post have been uploaded Successfully.";
      $response['data']['posts']     = $data;
      return array($response, 200);
    }

    public function searchpost($request)
    {
      $api_secret       = @trim(addslashes($request['api_secret']));
      $search_post       = @trim(addslashes($request['search_post']));
      $page_number       = @trim(addslashes($request['page_number']));
      $this->CI->load->model('posts_model');
      if(empty($api_secret))
      {
          $response['result']['status']   = 'error';
          $response['result']['response'] = "API Secret is missing.";
          return array($response, 400);
      }

      $data = $this->CI->posts_model->inner_querry('*',$page_number,$search_post);

      $response['result']['status']       = 'success';
      $response['result']['response']     = "Post have been uploaded Successfully.";
      $response['data']['posts']     = $data;
      return array($response, 200);
    }


    protected function getPrimaryKeyName()
    {
        return $this->primary_key;
    }
}
