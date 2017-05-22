<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of User_lib
 *
 * @author: Muhammad Umar Hayat
 * @Description: users library to perform user functions.
 */

class User_lib
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

    public function login($request = array())
    {
        $this->CI->load->model('users_model');
        /*
         * addSlashes Just to Secure From SQL Injection
         */
        $email         = @trim(addslashes($request['email']));
        $password      = @$request['password'];
        $signin_type     = @$request['signin_type'];
        $fb_id         = @trim(addslashes($request['fb_id']));

        if(!empty($signin_type))
        {
            if($signin_type != Users_model::BY_FB &&  $signin_type != Users_model::BY_CUSTOM)
            {
                $response['result']['status'] 	= 'error';
                $response['result']['response'] = "Invalid Signin Type.";
                return array($response, 400);
            }
        }
        if($signin_type == Users_model::BY_CUSTOM)
        {
            if(empty($email))
            {
                $response['result']['status'] 	= 'error';
                $response['result']['response']     = "Email is missing.";
                return array($response, 400);
            }
            if(empty($password))
            {
                $response['result']['status']       = 'error';
                $response['result']['response']     = "Password is missing.";
                return array($response, 400);
            }
            $data   = $this->CI->users_model->get_record_for_field('email', $email);
        }
        elseif($signin_type == Users_model::BY_FB)
        {
            if(empty($fb_id))
            {
                $response['result']['status']       = 'error';
                $response['result']['response']     = "Facebook ID is missing.";
                return array($response, 400);
            }
            $data   = $this->CI->users_model->get_record_for_field('fb_id', $fb_id);
        }
        else
        {
            $response['result']['status'] 	= 'error';
            $response['result']['response']     = "Signin Type is Missing.";
            return array($response, 400);
        }

        if(empty($data))
        {
            $response['result']['status'] 	= 'error';
            $response['result']['response']     = "Invalid Crediantials.";
            return array($response, 400);
        }
        else
        {
            if($data[0]->password == md5($password) || $signin_by != Users_model::BY_CUSTOM)
            {
                $this->CI->load->model('api_keys_model');

                $api_key    = $this->CI->api_keys_model->get_record_for_field('user_id', $data[0]->user_id);


                $this->CI->users_model->user_id     = $data[0]->user_id;
                $this->CI->users_model->user_agent  = $_SERVER['HTTP_USER_AGENT'];
                $this->CI->users_model->save();

                $response['result']['status']       = 'success';
                $response['result']['response']     = "User login successful.";
                $response['data']['api_secret']     = $api_key[0]->api_secret;
                $response['data']['api_id']         = $api_key[0]->api_id;
                $response['data']['user data']     = $data[0];
                return array($response, 200);
            }
            else
            {
                $response['result']['status'] 	= 'error';
                $response['result']['response'] = "Invalid password.";
                return array($response, 400);
            }
        }
    }
    public function register($request = array())
    {
        $this->CI->load->model('users_model');
        /*
         * addSlashes Just to Secure From SQL Injection
         */
        $username           = @trim(addslashes($request['username']));
        $name               = @trim(addslashes($request['name']));
        $email              = @trim(addslashes($request['email']));
        $password           = @$request['password'];
        $bio                = @trim($request['bio']);
        $profile_pic           = @trim(addslashes($request['profile_pic']));
        $signup_ip          = @trim(addslashes($request['signup_ip']));
        $gender             = @trim(addslashes($request['gender']));
        $marital_status     = @trim(addslashes($request['marital_status']));
        $profile_type       = @trim(addslashes($request['profile_type']));
        $fb_id              = @trim(addslashes($request['fb_id']));
        $fb_token           = @trim(addslashes($request['fb_token']));
        $signup_type        = @$request['signup_type'];
        $last_login_ip      = @trim(addslashes($request['last_login_ip']));
        $gcm_key         = @trim(addslashes($request['gcm_key']));


        if(!empty($signup_type))
        {
            if($signup_type != Users_model::BY_FB &&  $signup_type != Users_model::BY_CUSTOM)
            {
                $response['result']['status'] 	= 'error';
                $response['result']['response'] = "Invalid Signup Type.";
                return array($response, 400);
            }
        }
        else
        {
            $response['result']['status'] 	= 'error';
            $response['result']['response']     = "Signup Type is Missing.";
            return array($response, 400);
        }
        if($signup_type == Users_model::BY_FB && !empty($fb_id))
        {
            $data = $this->CI->users_model->get_record_for_field('fb_id', $fb_id);
            if(!empty($data))
            {
                $response['result']['status'] 	= 'success';
                $response['result']['response'] = 'user already exist';
                $response['data'] = $data[0];
                return array($response, 409);
            }
        }
        elseif($signup_type == Users_model::BY_FB && empty($fb_id))
        {
            $response['result']['status']   = 'error';
            $response['result']['response'] = "Facebook ID is Missing.";
            return array($response, 400);
        }

        if(!empty($email))
        {
            $data = $this->CI->users_model->get_record_for_field('email', $email);
            if(!empty($data))
            {
                $response['result']['status'] 	= 'error';
                $response['result']['response'] = "Email Already Exists.";
                return array($response, 409);
            }
            elseif(!filter_var($email, FILTER_VALIDATE_EMAIL))
            {
                $response['result']['status'] 	= 'error';
                $response['result']['response'] = "Invalid Email Address.";
                return array($response, 400);
            }
        }
        if(!empty($username))
        {
            $data = $this->CI->users_model->get_record_for_field('username', $username);
            if(!empty($data))
            {
                $response['result']['status'] 	= 'error';
                $response['result']['response'] = "Username Already Taken.";
                return array($response, 409);
            }
        }

        if(!empty($password))
        {
            if(strlen($password) < 6)
            {
                $response['result']['status'] 	= 'error';
                $response['result']['response'] = "Minimum password lenght should be 6.";
                return array($response, 400);
            }
            $password = md5($password);
        }
        elseif($signup_type == Users_model::BY_CUSTOM)
        {
            $response['result']['status'] 	= 'error';
            $response['result']['response']     = "Password is Missing.";
            return array($response, 400);
        }


        if(!empty($gender))
        {
            if(strtolower($gender) != 'male' && strtolower($gender) != 'female')
            {
                $response['result']['status']       = 'error';
                $response['result']['response']     = "Invalid Gender.";
                return array($response, 400);
            }
            $gender     = ucfirst(strtolower($gender));
        }
        if(!empty($profile_pic))
        {
            $this->CI->load->helper('image_lib');
            $dir                = APPPATH.'../assets/profile_pictures/';
            $profile_pic    = image_lib::img($profile_pic, $dir);
        }
        $this->CI->users_model->username        = $username;
        $this->CI->users_model->name            = $name;
        $this->CI->users_model->email           = $email;
        $this->CI->users_model->password        = $password;
        $this->CI->users_model->bio             = $bio;
        $this->CI->users_model->signup_type     = $signup_type;
        $this->CI->users_model->gender          = $gender;
        $this->CI->users_model->marital_status  = $marital_status;
        $this->CI->users_model->profile_type    = $profile_type;
        $this->CI->users_model->fb_id           = $fb_id;
        $this->CI->users_model->fb_token        = $fb_token;
        $this->CI->users_model->profile_pic     = $profile_pic;
        $this->CI->users_model->signup_type     = $signup_type;
        $this->CI->users_model->signup_ip       = $signup_ip;
        $this->CI->users_model->last_login_ip   = $last_login_ip;
        $this->CI->users_model->user_agent      = $user_agent;
        $this->CI->users_model->gcm_key         = $gcm_key;
        $this->CI->users_model->date_added      = date("Y-m-d H:i:s");
        $this->CI->users_model->last_updated    = date("Y-m-d H:i:s");
        $user_id                                = $this->CI->users_model->save();

        $this->CI->load->model('api_keys_model');

        $api_id         = $this->CI->api_keys_model->generateApiID(array($user_id));
        $api_secret     = $this->CI->api_keys_model->generateApiSecret($api_id);

        $this->CI->api_keys_model->user_id          = $user_id;
        $this->CI->api_keys_model->api_id           = $api_id;
        $this->CI->api_keys_model->api_secret       = $api_secret;
        $this->CI->api_keys_model->expiry           = Api_keys_model::NEVER_EXPIRES;
        $this->CI->api_keys_model->save();
        $data = $this->CI->users_model->get_record_for_field('user_id', $user_id);

        $response['result']['status']       = 'success';
        $response['result']['response']     = "User Registered Successfully.";
        $response['data']['api_id']         = $api_id;
        $response['data']['api_secret']     = $api_secret;
	      $response['data']['user_data']	      = $data[0];

        return array($response, 200);
    }


    public function update($request = array())
    {
        $this->CI->load->model('users_model');
        /*
         * addSlashes Just to Secure From SQL Injection
         */
         $api_secret         = @trim(addslashes($request['api_secret']));
         $username           = @trim(addslashes($request['username']));
         $name               = @trim(addslashes($request['name']));
         $email              = @trim(addslashes($request['email']));
         $password           = @$request['password'];
         $bio                = @trim($request['bio']);
         $signup_ip          = @trim(addslashes($request['signup_ip']));
         $gender             = @trim(addslashes($request['gender']));
         $marital_status     = @trim(addslashes($request['marital_status']));
         $profile_type       = @trim(addslashes($request['profile_type']));
         $profile_pic       = @trim(addslashes($request['profile_pic']));
         $fb_id              = @trim(addslashes($request['fb_id']));
         $fb_token           = @trim(addslashes($request['fb_token']));
         $signup_type        = @$request['signup_type'];
         $last_login_ip      = @trim(addslashes($request['last_login_ip']));
         $user_agent         = @trim(addslashes($request['user_agent']));
         $gcm_key            = @trim(addslashes($request['gcm_key']));

        if(empty($api_secret))
        {
            $response['result']['status']   = 'error';
            $response['result']['response'] = "API Secret is missing.";
            return array($response, 400);
        }
        /*
         * API Secret Validation
         */
        $this->CI->load->model('api_keys_model');
        $user_id = $this->CI->api_keys_model->validate($api_secret);
        if(empty($user_id))
        {
            $response['result']['status']   = 'error';
            $response['result']['response'] = "Invalid API Secret.";
            return array($response, 400);
        }
	     if(!empty($signup_type))
        {
            if($signup_type != Users_model::BY_FB &&  $signup_type != Users_model::BY_CUSTOM)
            {
                $response['result']['status'] 	= 'error';
                $response['result']['response'] = "Invalid Signup Type.";
                return array($response, 400);
            }
        }
        else
        {
            $response['result']['status'] 	= 'error';
            $response['result']['response']     = "Signup Type is Missing.";
            return array($response, 400);
        }
        if(!empty($username))
        {
            $data = $this->CI->users_model->get_record_for_field('username', $username);
            if(!empty($data))
            {
                $response['result']['status'] 	= 'error';
                $response['result']['response'] = "Username Already Taken.";
                return array($response, 409);
            }
            else
            {
              $data_array['username']           = $username;
            }
        }
        if(!empty($email))
        {
            $data = $this->CI->users_model->get_record_for_field('email', $email);
            if(!empty($data))
            {
                $response['result']['status'] 	= 'error';
                $response['result']['response'] = "Email Already Exists.";
                return array($response, 409);
            }
            elseif(!filter_var($email, FILTER_VALIDATE_EMAIL))
            {
                $response['result']['status'] 	= 'error';
                $response['result']['response'] = "Invalid Email Address.";
                return array($response, 400);
            }
            else
            {
              $data_array['email']           = $email;
            }
        }

        if(!empty($password))
        {
            if(strlen($password) < 6)
            {
                $response['result']['status'] 	= 'error';
                $response['result']['response'] = "Minimum password lenght should be 6.";
                return array($response, 400);
            }
            $password = md5($password);
            $data_array['password']        = $password;
        }

        if(!empty($gender))
        {
            if(strtolower($gender) != 'male' && strtolower($gender) != 'female')
            {
                $response['result']['status']       = 'error';
                $response['result']['response']     = "Invalid Gender.";
                return array($response, 400);
            }
            $gender     = ucfirst(strtolower($gender));
            $data_array['gender']           = $gender;
        }
        if(!empty($bio))
        {
          $data_array['bio']              = $bio;
        }
        if(!empty($marital_status))
        {
          $data_array['marital_status']   = $marital_status;
        }
        if(!empty($profile_type))
        {
          $data_array['profile_type']     = $profile_type;
        }
        if(!empty($gcm_key))
        {
          $data_array['gcm_key']     = $gcm_key;
        }
        if (!empty($name)) {
          $data_array['name']            = $name;
        }
        if (!empty($profile_pic)) {
          $this->CI->load->helper('image_lib');
          $dir                = APPPATH.'../assets/profile_pictures /';
          $profile_picture    = image_lib::img($profile_pic, $dir);
          $data_array['profile_pic'] = $profile_picture;
        }
        //$data_array['signup_type']     = $signup_type;
        //$data_array['signup_ip']       = $signup_ip;
        //$data_array['last_login_ip']   = $last_login_ip;
        $data_array['last_updated']    = date("Y-m-d H:i:s");
        $where = array('user_id' => $user_id);

        $user_id = $this->CI->users_model->update_record($data_array,$where);

        $data = $this->CI->users_model->get_record_for_field('user_id', $user_id);


        $response['result']['status']       = 'success';
        $response['result']['response']     = 'user updated successfully';
        $response['data']['User Data']     = $data[0];

        return array($response, 200);
    }


    public function profile($request=array())
    {
      $username               = @trim(addslashes($request['username']));
      $page_number               = @trim(addslashes($request['page_number']));
      $like_username          = array('username' => $username);
      $like_name              = array('name' => $username);
      $limit = $page_number * 10;
      $this->CI->load->model('users_model');

      $allUsers = $this->CI->users_model->get_record('*','',$like_username,$like_name,$page_number);

      $response['result']['status']       = 'success';
      $response['result']['response']     = 'All user data';
      $response['data']['all users']      = $allUsers ;

      return array($response, 200);
    }

    public function profile_id($request=array())
    {
      $id               = @trim(addslashes($request['user_id']));

      $this->CI->load->model('users_model');
      $this->CI->load->model('followers_model');
      $this->CI->load->model('posts_model');


      $where  = array('user_id' => $id);
      $user_data = $this->CI->users_model->get_record('*',$where);
      if (empty($user_data))
      {
        $response['result']['status']       = 'error';
        $response['result']['response']     = "No User Exist";
        return array($response, 400);
      }

      $where  = array('follower_id' => $id);

      $followers = $this->CI->followers_model->get_record('*',$where);
      $followers_count = count($followers);

      $where  = array('following_id' => $id);
      $following = $this->CI->followers_model->get_record('*',$where);
      $following_count = count($following);



      $where  = array('user_id' => $id);
      $posts = $this->CI->posts_model->get_record('*',$where);
      $post_count = count($posts);

      $response['result']['status']       = 'success';
      $response['result']['response']     = 'All user data';
      $response['data']['info']      = $user_data[0];
      $response['data']['info']->following      = $following_count;
      $response['data']['info']->followers      = $followers_count;
      $response['data']['info']->total_post      = $post_count;
      $response['data']['posts']      = $posts;

      return array($response, 200);
    }

    public function block($request=array())
    {
      $api_secret                = @trim(addslashes($request['api_secret']));
      $blocked_user_id        = @trim(addslashes($request['blocked_user_id']));

      if(empty($api_secret))
      {
          $response['result']['status']   = 'error';
          $response['result']['response'] = "API Secret is missing.";
          return array($response, 400);
      }
      /*
       * API Secret Validation
       */
      $this->CI->load->model('api_keys_model');
      $user_id = $this->CI->api_keys_model->validate($api_secret);

      $data_array['user_id'] = $user_id;
      $data_array['blocked_user_id'] = $blocked_user_id;

      $this->CI->load->model('blocked_users_model');
      $this->CI->blocked_users_model->save($data_array);

      $response['result']['status']       = 'success';
      $response['result']['response']     = 'user Have Been Blocked';

      return array($response, 200);
    }

    public function unblock($request=array())
    {
      $user_id                = @trim(addslashes($request['user_id']));
      $blocked_user_id        = @trim(addslashes($request['blocked_user_id']));

      $where = array('user_id' => $user_id, 'blocked_user_id' => $blocked_user_id);

      $this->CI->load->model('blocked_users_model');
      $this->CI->blocked_users_model->delete_record($where);

      $response['result']['status']       = 'success';
      $response['result']['response']     = 'user Have Been Unblocked';

      return array($response, 200);
    }


}
