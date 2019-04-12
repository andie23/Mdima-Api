<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use App\Lib\AuthorisationCheck;
use Cake\Controller\Controller;
use Cake\Event\Event;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */

class AppController extends Controller
{

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public $helpers = [
        'Paginator' => [
            'templates' => [ 
                'number' => '<li class="page-item"><a class="page-link" href="{{url}}">{{text}}</a></li>',
                'nextDisabled' => '<li class="page-item disabled" ><a class="page-link" href="{{url}}">Next</a></li>',
                'prevDisabled' => '<li class="page-item disabled" ><a class="page-link" href="{{url}}">Previous</a></li>',
                'nextActive' => '<li class="page-item" ><a class="page-link" href="{{url}}">Next</a></li>',
                'prevActive' => '<li class="page-item" ><a class="page-link" href="{{url}}">Previous</a></li>',
                'current' =>  '<li class="page-item active" > <a class="page-link " href="#">{{text}}<span class="sr-only">(current)</span></a> </li>', 
                'counterPages' => ''
            ]
        ]
    ];
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
 
        $this->loadComponent('Auth', [
            'loginAction'=>[
                 'controller' => 'Users',
                 'action' => 'login'
             ],
            'loginRedirect' => [
                'controller' => 'Dashboard',
                'action' => 'index'
            ]
        ]); 
    }

    public function beforeFilter(Event $event)
    {

       if($this->Auth){
           $this->set('user', $this->Auth->User());
        }else{
            $this->set('user', []);
       }
    }
    /**
     * Before render callback.
     *
     * @param \Cake\Event\Event $event The beforeRender event.
     * @return void
     */
    public function beforeRender(Event $event)
    {
        if (!array_key_exists('_serialize', $this->viewVars) &&
            in_array($this->response->type(), ['application/json', 'application/xml'])
        ) {
            $this->set('_serialize', true);
        }
    }
}
