<?php 
namespace App\Lib;
use Cake\Core\Configure;
use Cake\Log\Log;
use Cake\Network\Http\Client;

class RealTimeDatabaseClient{
    const POST = 'POST';
    const GET = 'GET';
    const PATCH = 'PATCH';
    const DELETE = '_DELETE';
    const PUT = 'PUT';

    function __construct($route=[])
    {
        $this->rootUrl = Configure::read('RealTimeDatabase.rooturl');
        $this->requestUrl = __('{0}/{1}', $this->rootUrl, implode("/", $route));
        Log::write('debug', __('Using url {0}', $this->requestUrl));
    }

    public function isAlive()
    {
        $http = new Client();
        $response = $http->get($this->rootUrl);

        if($response)
        {
            return $response->code == 200;
        }
        return false;
    }

    private function request($type, $data){
        $http = new Client();
        $baseUrl = $this->requestUrl;
        $dataRequestUrl = __('{0}.json', $baseUrl);
        $response = null;

        if ($type == self::POST){
            $data = json_encode($data);
            $response = $http->post($dataRequestUrl, $data); 
        }elseif($type == self::PUT){
            $data = json_encode($data);
            $response = $http->put($dataRequestUrl, $data); 
        }elseif($type == self::GET){
            $dataRequestUrl = __('{0}/{1}.json', $baseUrl, $data);
            $response = $http->get($dataRequestUrl);
            $data = '';
        }elseif($type == self::DELETE){
            $dataRequestUrl = __('{0}/{1}.json', $baseUrl, $data);
            $response = $http->delete($dataRequestUrl);
            $data = '';
        }elseif($type == self::PATCH){
            $data = json_encode($data);
            $response = $http->patch($dataRequestUrl, $data);
        }

        Log::write('debug', __('Request type: {0}, Url: {1} Data: {2}', $type, $dataRequestUrl, $data));
        if ($response){
            Log::write('debug', __('Code {0}', $response->code));
        }
        return $response;
    }

    public function put($data) 
    {
        if ($response=$this->request(self::PUT, $data)){
             return $response->code == 200;  
        }
        return false;
    }
    
    public function add($data) 
    {
        if ($response=$this->request(self::POST, $data)){
             return $response->code == 200;  
        }
        return false;
    }

    public function edit($data) 
    {
        if ($response=$this->request(self::PATCH, $data)){
            return $response->code == 200;  
        }
        return false;
    }

    public function delete($route)
    {
        if($route)
        {
            return $this->request(self::DELETE, implode("/", $route))->code == 200;
        }
        return null;
    }

    public function get($route) {
        if(!$route){return null;}
        
        $response = $this->request(self::GET, implode("/", $route));
        if($response and $response->code == 200)
        {
            return json_decode($response->body, True);
        }
        return [];
    }
}
