# codeigniterSwaggerApi Documentation
Codeigniter with Swagger Integration


<h1>Changes Require</h1>

1)config.php file replace base_url & domain Your BasePAth

2)Change these two line your full path in constants.php file
<ul>
  <li>a) <pre>define('SWAGGER_PATH','http://localhost/codeigniterSwaggerApi/CodeIgniter-3.1.4/index.php/api_doc');</pre></li>
  <li>b) <pre>define('API_SWAGGER_PATH','http://localhost/codeigniterSwaggerApi/CodeIgniter-3.1.4/index.php/api');</pre></li>
  </ul>
  
  
  <h1>How To Use It..!</h1>
  
  1) Simple go to Controllers Folder
  
  2) Open api_doc.php
  
  3) Two Dummy Method Are Already Include for Demo
  
  4) if your want more method simple add 
    <pre>
    public function user()
    {
        $user = array(
            "apiVersion" => "1.0.0",
            "swaggerVersion" => "1.2",
            "basePath" => $this->base_path,
            "resourcePath" => "/user",
            "produces" => array("application/json"),
            "apis" => array()
                 ),
        );
        header('Access-Control-Allow-Origin: *');
        echo json_encode($user);
    }
    </pre>
  
     <p>
     and Add a Array index() method Just Like this</p>
          <pre>
          array(
              "path" => "/posts",
              "description" => "All functions including Upload, get posts"
          ),
          </pre>
                
.
    5) Add a Api  with all detail inner "apis" => array( here )
    
   <pre>
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
                                                "name" => "name",
                                                "description" => "",
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
                    ),
    </pre>
 
 
