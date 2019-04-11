<?php
namespace App\Lib;
use Cake\Network\Http\Client;
use Cake\Core\Configure;
use Cake\Log\Log;

class CloudMessagingClient{
    const IDENTIFIER_NAME = "Mdima";
    function __construct()
    {
        $this->url = Configure::read('CloudMessaging.url');
        $this->authKey = Configure::read('CloudMessaging.key');
        $this->topic = Configure::read('CloudMessaging.topic');
        $this->requestHeader = [
            'Authorization' => $this->authKey,
            'Content-Type' => 'application/json'
        ];
        Log::write('debug', __('CloudMessaging header {0}', json_encode($this->requestHeader)));
    }

    private function buildNotification($title, $body, $data = [])
    {
        $notification = [
            'name' => self::IDENTIFIER_NAME,
            'to' => __('//topics//{0}', $this->topic),
            'name' => $title,
            'body' => $body
        ];

        if ($data){
            $notification['data'] = $data;
        }
        $jsonNotificationBody = json_encode($notification);
        Log::write('debug', __('Notification body: {0}',$jsonNotificationBody));
        return $jsonNotificationBody;
    }

    public function post($title, $body, $data=[])
    {
        $notification = $this->buildNotification($title, $body, $data);
        $http = new Client(); 
        try{
            $response = $http->post($this->url, $notification, $this->requestHeader);
        }catch(\Exception $e)
        {
            Log::write('error', $e->getMessage());
            return false;
        }
        Log::write('debug', 'Response '.$response);
        return $response ? $response->code == 200 : false;
    }
}