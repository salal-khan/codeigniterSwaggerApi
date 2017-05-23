<?php defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * ---------------------------------------------------------------------------------------
 * File: api_doc.php
 * Type: Controller
 * Created by: Hafiz Haseeb Ali
 * Description: This is controller to handle User functionss
 * ---------------------------------------------------------------------------------------
 */

require APPPATH . 'libraries/api/REST_Controller.php';

class Api_doc extends CI_Controller
{

    public $base_path = API_SWAGGER_PATH;

    /*
     * Function: 		index
     * Method Accepted:	post
     * URI: 			/api_doc/
     * Params: 			.....
     * URI Segments: 	None
     * Written by: 		Haseeb Ali
     * Description: 	This is for Swagger documentation
     * Returns: 		Swagger Json Array
     */
    function index()
    {
        $allvalue = array(
            "apiVersion" => "1.0.0",
            "swaggerVersion" => "1.2",
            "apis" => array(
                array(
                    "path" => "/user",
                    "description" => "User Functions"
                ),
                array(
                    "path" => "/posts",
                    "description" => "All functions including Upload, get posts"
          			),
            ),
            "info" => array(
                "title" => "Captor Restful API",
                "description" => "Below is the list of available REST API functions",

            )
        );
        header('Access-Control-Allow-Origin: *');
        echo json_encode($allvalue);

    }
    /*
     * Function: 		user
     * URI: 			/api_doc/user
     * Params: 			.....
        * Description: 	User Activity
     * Returns: 		Swagger Json Array
     */
    public function user()
    {
        $user = array(
            "apiVersion" => "1.0.0",
            "swaggerVersion" => "1.2",
            "basePath" => $this->base_path,
            "resourcePath" => "/user",
            "produces" => array("application/json"),
            "apis" => array(
                // all about login detail in Swagger Documentation and Testing
                array(
                        "path" => "/user/register",
                        "operations" => array(
                        array(
                                "method" => "POST",
                                "summary" => "Register New User.",
                                "notes" => "",
                                "type" => "string",
                                "nickname" => "Register New User",
                                "parameters" => array(
                                    array(
                                            "name" => "username",
                                            "description" => "User Name",
                                            "required" => false,
                                            "type" => "string",
                                            "paramType" => "form"
                                        ),
                                    array(
                                            "name" => "name",
                                            "description" => "Name",
                                            "required" => false,
                                            "type" => "string",
                                            "paramType" => "form"
                                        ),
                                    array(
                                            "name" => "profile_pic",
                                            "description" => "Profile Picture",
                                            "required" => false,
                                            "type" => "string",
                                            "paramType" => "form"
                                        ),
                                    array(
                                            "name" => "email",
                                            "description" => "Email Address",
                                            "required" => false,
                                            "type" => "string",
                                            "paramType" => "form"
                                        ),
                                    array(
                                            "name" => "password",
                                            "description" => "Password, Note: Minmum Password Lenght Should Be 6",
                                            "required" => false,
                                            "type" => "string",
                                            "paramType" => "form"
                                        ),
                                    array(
                                            "name" => "bio",
                                            "description" => "Bio",
                                            "required" => false,
                                            "type" => "string",
                                            "paramType" => "form"
                                        ),
                                    array(
                                            "name" => "signup_type",
                                            "description" => "Sign Up Type, 1 for Facebook, 2 for Custom",
                                            "required" => false,
                                            "type" => "string",
                                            "paramType" => "form"
                                        ),
                                    array(
                                            "name" => "gender",
                                            "description" => "male/female",
                                            "required" => false,
                                            "type" => "string",
                                            "paramType" => "form"
                                        ),
                                    array(
                                            "name" => "marital_status",
                                            "description" => "Marital Status EX. 'single', 'married', 'complicated'",
                                            "required" => false,
                                            "type" => "string",
                                            "paramType" => "form"
                                        ),
                                    array(
                                            "name" => "profile_type",
                                            "description" => "Profile Type EX. Private, Public",
                                            "required" => false,
                                            "type" => "string",
                                            "paramType" => "form"
                                        ),
                                    array(
                                            "name" => "fb_id",
                                            "description" => "Facebook ID if signup_by is 1",
                                            "required" => false,
                                            "type" => "string",
                                            "paramType" => "form"
                                        ),
                                    array(
                                            "name" => "fb_token",
                                            "description" => "Facebook Token if signup_by is 1",
                                            "required" => false,
                                            "type" => "string",
                                            "paramType" => "form"
                                        ),
                                    array(
                                            "name" => "signup_ip",
                                            "description" => "Signup IP Adress",
                                            "required" => false,
                                            "type" => "string",
                                            "paramType" => "form"
                                        ),
                                    array(
                                            "name" => "last_login_ip",
                                            "description" => "Last Login Ip Address",
                                            "required" => false,
                                            "type" => "string",
                                            "paramType" => "form"
                                        ),
                                    array(
                                            "name" => "user_agent",
                                            "description" => "User Agent",
                                            "required" => false,
                                            "type" => "string",
                                            "paramType" => "form"
                                        ),
                                    array(
                                            "name" => "date_added",
                                            "description" => "User Agent",
                                            "required" => false,
                                            "type" => "string",
                                            "paramType" => "form"
                                        )
                                ),
                                "responseMessages" => array(
                                        array(
                                                "code" => 200,
                                                "message" => "Operation Successful"
                                        ),
                                        array(
                                                "code" => 400,
                                                "message" => "Something Went Wrong"
                                        ),
                                        array(
                                                "code" => 409,
                                                "message" => "Email or User Name Already Exists."
                                        )
                                    )
                                )
                            )
                        ),
                    array(
                        "path" => "/user/login",
                        "operations" => array(
                        array(
                                "method" => "POST",
                                "summary" => "Login User With Email and Password or Facebook ID.",
                                "notes" => "",
                                "type" => "string",
                                "nickname" => "Login User",
                                "parameters" => array(
                                    array(
                                            "name" => "email",
                                            "description" => "Email Address",
                                            "required" => false,
                                            "type" => "string",
                                            "paramType" => "form"
                                        ),
                                    array(
                                            "name" => "password",
                                            "description" => "Password Note: Minimum 6 Characters",
                                            "required" => false,
                                            "type" => "string",
                                            "paramType" => "form"
                                        ),
                                    array(
                                            "name" => "fb_id",
                                            "description" => "Facebook ID in case if user is Facebook user",
                                            "required" => false,
                                            "type" => "string",
                                            "paramType" => "form"
                                        ),
                                    array(
                                            "name" => "signin_type",
                                            "description" => "Sign in Type, 1 for Facebook, 2 for Custom",
                                            "required" => false,
                                            "type" => "string",
                                            "paramType" => "form"
                                        )
                                ),
                                "responseMessages" => array(
                                        array(
                                                "code" => 200,
                                                "message" => "Operation Successful"
                                        ),
                                        array(
                                                "code" => 400,
                                                "message" => "Something Went Wrong"
                                        )
                                  )
                            )
                        )
                    ),

            ),
        );
        header('Access-Control-Allow-Origin: *');
        echo json_encode($user);
    }
    /*
         * Function: 		subjects
         * URI: 			/api_doc/subjects
         * Params: 			.....
         * Description:             Orders Related Functions
         * Returns: 		Swagger Json Array
         */
        public function posts()
        {
            $order = array(
                        "apiVersion" => "1.0.0",
                        "swaggerVersion" => "2.1.4",
                        "basePath" => $this->base_path,
                        "resourcePath" => "/posts",
                        "produces" => array("application/json"),
                        "apis" => array(

                        array(
                            "path" => "/post/upload",
                            "operations" => array(
                            array(
                                    "method" => "POST",
                                    "summary" => "Upload new Post.",
                                    "notes" => "",
                                    "type" => "string",
                                    "nickname" => "Upload Img/Video",
                                    "parameters" => array(
                                        array(
                                                "name" => "api_secret",
                                                "description" => "API Secret",
                                                "required" => true,
                                                "type" => "string",
                                                "paramType" => "form"
                                            ),
                                        array(
                                                "name" => "path",
                                                "description" => "img/ video Base64",
                                                "required" => false,
                                                "type" => "string",
                                                "paramType" => "form"
                                            ),
                                        array(
                                                "name" => "post_type",
                                                "description" => "img or vid",
                                                "required" => false,
                                                "type" => "string",
                                                "paramType" => "form"
                                            ),
                                        array(
                                                "name" => "caption",
                                                "description" => "Caption",
                                                "required" => false,
                                                "type" => "string",
                                                "paramType" => "form"
                                            ),
                                        array(
                                                "name" => "location",
                                                "description" => "Location",
                                                "required" => false,
                                                "type" => "string",
                                                "paramType" => "form"
                                            ),
                                        array(
                                                "name" => "lat",
                                                "description" => "Latitude",
                                                "required" => false,
                                                "type" => "string",
                                                "paramType" => "form"
                                            ),
                                        array(
                                                "name" => "lang",
                                                "description" => "Longitude",
                                                "required" => false,
                                                "type" => "string",
                                                "paramType" => "form"
                                            ),
                        		            ),
                                    "responseMessages" => array(
                                        array(
                                                "code" => 200,
                                                "message" => "Operation Successful"
                                        ),
                                        array(
                                                "code" => 400,
                                                "message" => "Something Went Wrong"
                                        ),
                                )
                        		)
                    		)
                    ),array(
                        "path" => "/post/newsfeed",
                        "operations" => array(
                        array(
                                "method" => "POST",
                                "summary" => "Get All new Posts.",
                                "notes" => "",
                                "type" => "string",
                                "nickname" => "",
                                "parameters" => array(
                                    array(
                                            "name" => "api_secret",
                                            "description" => "API Secret",
                                            "required" => true,
                                            "type" => "string",
                                            "paramType" => "form"
                                        ),array(
                                                "name" => "page_number",
                                                "description" => "Page Number",
                                                "required" => true,
                                                "type" => "string",
                                                "paramType" => "form"
                                            ),
                                    ),
                                "responseMessages" => array(
                                    array(
                                            "code" => 200,
                                            "message" => "Operation Successful"
                                    ),
                                    array(
                                            "code" => 400,
                                            "message" => "Something Went Wrong"
                                    ),
                                )
                            )
                        )
                            )
                        ),
            );
            header('Access-Control-Allow-Origin: *');
            echo json_encode($order);
        }


}
