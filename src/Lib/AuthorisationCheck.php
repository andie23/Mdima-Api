<?php
namespace App\Lib;
use Cake\ORM\TableRegistry;

class AuthorisationCheck
{
        
    public function validate($request, $user, $exceptions=null)
    {
        $reqController = $request['controller'];
        $whitelist = $user['access_levels'][0];
        
        if($exceptions){
            if (array_key_exists($reqController, $exceptions)){
                $whitelist[$reqController] = array_merge(
                    $whitelist[$reqController], $exceptions[$reqController]
                );
            }
        }

        if (!array_key_exists($reqController, $whitelist)){
           throw new \Exception(__('You do not have permission to use {0}', $reqController));
        }
        
        $reqAction = $request['action'];
        $accessibleActions = $whitelist[$reqController];

        if (!array_key_exists($reqAction, $accessibleActions)){
            throw new \Exception(__('You are not permitted to {0} {1}', $reqAction, $reqController));
        }
        
        if(is_array($accessibleActions[$reqAction]) and array_key_exists('scope', $accessibleActions[$reqAction]))
        {
            $scope = $accessibleActions[$reqAction]['scope'];
            if ($scope == 'ONLY-OWN' and !$this->validateOwner($user, $request))
            {
                throw new \Exception(__('You do not have priviledges to {0} other {1}', $reqAction, $reqController));
            }
        }
    
        return True;
    }

    public function isOwner($table, $conditions){
        $tableObj = TableRegistry::get($table);
        $query = $tableObj->find()
                          ->where($conditions);
        return $query->count() >= 1;
    }

    public function isPostOwner($tableName, $conditions){
        $tableObj = TableRegistry::get($tableName);
        $query = $tableObj->find()
                          ->innerJoin('posts', __('posts.id = {0}.post_id', $tableName))
                          ->where($conditions);
        return $query->count() >= 1;
    }

    public function validateOwner($user, $request)
    {
        $userId = $user['id'];
        $controller = $request['controller'];
        switch(strtolower($controller)){
            case 'blogs':
                if ($request['pass']){
                    $id = $request['pass'][0];
                    return $this->isPostOwner('blogs', ['blogs.id'=> $id, 'posts.user_id' => $userId]);
                }
                return false;
            case 'logs':
                if ($request['pass']){
                    $id = $request['pass'][0];
                    return $this->isOwner('logs', ['user_id' => $userId]);
                }
                return false;
            case 'comments':
                if ($request['pass']){
                    $id = $request['pass'][0];
                    return $this->isPostOwner('comments', ['comments.id'=> $id, 'posts.user_id' => $userId]);
                }
                return false;
            case 'contactlists':
                if ($request['pass']){
                    $id = $request['pass'][0];
                    return $this->isOwner('contact_lists', ['id'=> $id, 'list_owner' => $userId]);
                }
                return False;
            case 'messages':
                if ($request['pass']){
                    $id = $request['pass'][0];
                    return $this->isPostOwner('messages', ['messages.id'=> $id, 'posts.user_id' => $userId]);
                }
                return False;
            case 'dashboard':
                if ($request['pass']){
                    $id = $request['pass'][0];
                    return $userId == $id;
                }
                return False;
            case 'users':
                if ($request['pass']){
                    $id = $request['pass'][0];
                    return $userId ==  $id;
                }
                return False;
            case 'documents':
                if ($request['pass']){
                    $id = $request['pass'][0];
                    return $this->isOwner('documents', ['id'=> $id, 'user_owner_id' => $userId]);
                }
                return False;
            case 'meetings':
                if ($request['pass']){
                    $id = $request['pass'][0];
                    return $this->isOwner('meetings', ['id'=> $id, 'user_creator_id' => $userId]);    
                }
                return False;
            }
    }

}