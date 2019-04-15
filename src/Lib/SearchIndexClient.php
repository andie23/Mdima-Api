<?php 
namespace App\Lib;
use Cake\Core\Configure;
use Cake\Log\Log;
use Cake\Network\Http\Client;

class SearchIndexClient {
    const ADD_BATCH_REQUEST = 'addObject';
    const UPDATE_BATCH_REQUEST = 'updateObject';
    const DELETE_BATCH_REQUEST = 'deleteObject';
    const POST = 'POST';
    const PUT = 'PUT';
    const DELETE = '_DELETE';

    public function __construct()
    {
        $indexName = Configure::read('SearchIndexer.index');
        $appId = Configure::read('SearchIndexer.application_id');
        $apiKey = Configure::read('SearchIndexer.admin_api_key');
        $this->baseUrl = __('https://{0}.algolia.net/1/indexes/{1}', $appId, $indexName);
        $this->headers = [
            'headers' => [
                'X-Algolia-API-Key' => $apiKey,
                'X-Algolia-Application-Id' => $appId,
                'Content-Type' => 'application/json'
            ]
        ];
        Log::write('debug', __('Default url: {0} with headers: {1}', $this->baseUrl, json_encode($this->headers)));
    }

    public function request($type, $url, $data=[])
    {
        $http = new Client();
        $jsonData = json_encode($data);
        Log::write('debug', __('Request type {0}, url {1}, body {2}', $type, $url, $jsonData));    
        try{
            switch($type){
                case self::POST:
                    $response = $http->post($url, $jsonData, $this->headers); 
                    break;
                case self::PUT:
                    $response = $http->put($url, $jsonData, $this->headers); 
                    break;
                case self::DELETE:
                    $response = $http->delete($url, $jsonData, $this->headers); 
                    break;
                default:
                    $response = [];
                    break;    
            }
        }catch(\Exception $e)
        {
            Log::write('error', $e->getMessage());
            return [];
        }
        Log::write('debug', __('Request response {0}', json_encode($response->body)));
        return $response;
    }

    public function index($data)
    {
       $this->request(
           self::PUT, __('{0}/{1}', $this->baseUrl, $data['objectID']), $data
        );
    }
    
    public function clear()
    {
       $response = $this->request(self::POST, __('{0}/clear',$this->baseUrl));
	   $responseBody = json_decode($response->body);
	   if(array_key_exists('taskID', $responseBody)){
			return true;
	   }
	   return false;
    }

    public function delete($objectID)
    {
        return $this->request(self::DELETE, __('{0}/{1}', $this->baseUrl, $objectID));
    }

    public function buildBatch($type, $rawEntities)
    {
        $entities = ['requests' => []];

        foreach($rawEntities as $entity)
        {
            $entity['objectID'] = $entity['id'];
            unset($entity['id']);

            $entities['requests'][] = [
                'action' => $type,
                'body' => $entity
            ];
        }
        return $entities;
    }

    public function indexBatch($batch)
    {
       $response = $this->request(self::POST, __('{0}/batch', $this->baseUrl), $batch);
	   $responseBody = json_decode($response->body);
	   if(array_key_exists('taskID', $responseBody)){
			return true;
	   }
	   return false;
    }
}