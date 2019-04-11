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
        $this->authKey = Configure::read('CloudMessaging.authorization');
        $this->topic = Configure::read('CloudMessaging.topic');
        $this->requestHeader = [ 
            'headers' =>[
                'Authorization' => $this->authKey,
                'Content-Type' => 'application/json'
            ]
        ];
        Log::write('debug', __('CloudMessaging header {0}', json_encode($this->requestHeader)));
    }

    private function buildNotification($title, $body, $data = [])
    {
        $notification = [
            'name' => self::IDENTIFIER_NAME,
            'to' => __("/topics/{0}", $this->topic),
            'notification' => [
                'title' => $title,
                'body' => $body
            ],
            'android' => [
                'collapse_key' => 'You have received pending schedules',
                'priority' => 'HIGH',
                'ttl' => '259200s',
                'badge' => '1',
            ]
        ];

        if ($data){
            $notification['data'] = $data;
        }
        $jsonNotificationBody = json_encode($notification);
        Log::write('debug', __('Notification: {0}',$jsonNotificationBody));
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

        if ($response and $response->code == 200)
        {
            $responseBody = json_decode($response->body);
            if(array_key_exists('failed', $responseBody) and $responseBody['failed']==1)
            {
                Log::write('debug', __('Failure response: {0}', $response->body));
                return false;
            }
            Log::write('debug', __('Success response: {0}', $response->body));
            return true;
        }
        Log::write('debug', __('Code: {0}, Response: {1}', $response->code, json_encode($response->body)));
        return false;
    }
}