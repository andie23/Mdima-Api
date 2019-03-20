<?php
namespace App\Lib;
use Cake\Core\Configure;
use Cake\Network\Email\Email;
use Cake\Log\Log;
use Cake\ORM\TableRegistry;

class EmailNotifications
{
    public function sendEmail($subject, $content, $recipients, $template)
    {
         $from = Configure::read('DefaultEmailAddress.from');
         $email = new Email('default');
         $send = $email->template($template)
                ->subject($subject)
                ->emailFormat('text')
                ->addTo($recipients)
                ->viewVars(['data' => $content])
                ->from([$from => 'E-learning Malawi'])
                ->transport('default')
                ->send();
        Log::config('email');
        Log::write('info', $send);
    }
    
    public function buildEmailList($users)
    {
        $emails = [];
        foreach($users as $user){
            $emails[] = $user->email;
        }
        return $emails;
    }

    public function notifyNewUser($accountData, $accountCreator)
    {
        $subject = "E-learning Account Registration";
        $content = [
            'recipient_name' => __('{0} {1}', $accountData['first_name'], $accountData['last_name']), 
            'username' => $accountData['username'], 'password' => $accountData['password'],
            'account_creator' => $accountCreator
        ];
        $this->sendEmail($subject, $content, [$accountData['email']], 'account');
    }

    public function notifyNewAllocation($userIds, $tutorId)
    {
        $this->notifyTutorAllocation($userIds, $tutorId);
        $this->notifyStudentAllocation($userIds, $tutorId);
    }
    
    public function notifyStudentAllocation($userIds, $tutorId)
    {
        $usertb = TableRegistry::get('users');
        $users = $usertb->getUsers($userIds);
        $emailList = $this->buildEmailList($users);
        $subject = "New Tutor Allocation";
        $content = ['tutor' => $usertb->getFullname($tutorId)];
        $this->sendEmail($subject, $content, $emailList, 'student_allocations');
    }
    
    public function notifyTutorAllocation($students, $tutorId)
    {
        $user = TableRegistry::get('users')->get($tutorId);
        $subject = 'New students assignment';
        $content = ['tutor' => $user->username, 'students' => $students];
        $this->sendEmail($subject, $content, $user->email, 'tutor_allocation');
    }

    public function notifyNewMeeting($data, $creator)
    {
        $usertb = TableRegistry::get('users');
        $users = $usertb->getUsers($data['contacts']);
        $emailList = $this->buildEmailList($users);
        $subject = $data['title'];
        $content = [
            'creator' => $usertb->getFullName($creator),
            'title'=> $data['title'],
            'date' => __('{0}/{1}/{2}', $data['schedule_date']['day'], 
                $data['schedule_date']['month'], $data['schedule_date']['year']
            )
        ];

        $this->sendEmail($subject, $content, $emailList, 'meeting');
    }

    public function newBlog()
    {

    }

    public function newMessage()
    {

    }

}