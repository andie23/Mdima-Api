<?php 
namespace App\Lib;
use Cake\Core\Configure;
use Cake\Log\Log;
use Cake\Network\Http\Client;

class RealTimeDatabaseClient{
    const POST = 'post';
    const GET = 'get';
    const PATCH = 'patch';
    const DELETE = 'delete';

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
        $dataRequestUrl = $baseUrl.'json';
        $response = null;

        if ($type == self::POST){
            $data = json_encode($data);
            $response = $http->post($dataRequestUrl, $data);
            Log::write('debug', __('POSTING to {0} with {1}', $dataRequestUrl, $data));
        }elseif($type == self::GET){
            $request = __('{0}/{1}.json', $baseUrl, $data);
            $response = $http->get($request);
            Log::write('debug', __('GETTING {0}', $request));
        }elseif($type == self::DELETE){
            $request = __('{0}/{1}.json', $baseUrl, $data);
            $response = $http->delete($request);
            Log::write('debug', __('DELETING {0}', $request));
        }elseif($type == self::PATCH){
            $data = json_encode($data);
            $response = $http->patch($dataRequestUrl, $data);
            Log::write('debug', __('PATCHING {0} with {1}', $dataRequestUrl, $data));
        }
        return $response;
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
