<?php

namespace Http;

class Request
{

    const GET    = 'GET';

    const POST   = 'POST';

    const PUT    = 'PUT';

    const DELETE = 'DELETE';

    private $parameters;

    public function __construct(array $query = [], array $request = [])
    {
    	$this->parameters = array_merge($query, $request);
    }

    public static function createFromGlobals()
    {
        if(isset($_SERVER['CONTENT_TYPE'])) {
            if($_SERVER['CONTENT_TYPE'] != null && $_SERVER['CONTENT_TYPE'] == "application/json") {
                $data = json_decode(file_get_contents('php://input'), true);
                foreach ($data as $key => $value) {
                    $_POST[$key] = $value;
                }
            }
        }
    	return new self($_GET, $_POST);
    }

    public function getMethod()
    {
    	$method = isset($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : self::GET;
    	if(self::POST === $method){
            //TODO post avec CURL et J§ON
    		return $this->getParameter('_method', $method);
    	}
    	return $method;
    }

    public function getUri()
    {
    	$uri = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '/';

    	if ($pos = strpos($uri, '?')) {
		    $uri = substr($uri, 0, $pos);
		}
		return $uri;
    }

	public function getParameter($name, $default = null)
	{
        if (array_key_exists($name, $this->parameters)) {
		  return $this->parameters[$name];
        }
        return $default;
	}

	public function guessBestFormat(){
		$negotiator = new \Negotiation\Negotiator();
        
        if(isset($_SERVER['HTTP_ACCEPT'])){
            $acceptHeader = $_SERVER['HTTP_ACCEPT'];
        } else {
            $acceptHeader = 'text/html, application/json, application/x-www-form-urlencoded';
        }

        $priorities   = array('text/html; charset=UTF-8', 'application/json', 'application/x-www-form-urlencoded');
		$mediaType = $negotiator->getBest($acceptHeader, $priorities);

		return $mediaType->getType();
    }
}