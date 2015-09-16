<?php

namespace PRIME\Controllers;
use PRIME\Models\Ticket;

class SupportController extends ControllerBase
{
    public function initialize()
    {
        
        $this->assets->addJs("assets/plugins/jquery-ui/jquery-ui-1.10.1.custom.min.js");
        $this->assets->addJs("assets/plugins/jquery-block-ui/jqueryblockui.js");
        
        $this->assets->addJs("assets/plugins/jquery-validation/js/jquery.validate.min.js");
        
        $this->assets->addJs("assets/js/support_ticket.js");
        
        $this->assets->addJs("assets/js/demo.js");
        
        $this->assets->addCss('assets/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css');
          
        $this->view->setTemplateAfter('main');
        \Phalcon\Tag::setTitle('Support');
        parent::initialize();
    }

    public function indexAction()
    {
            $auth = $this->session->get("auth");
            $user_role= $auth['role'];
            if($user_role=='Admin')
            {
            $open_tickets = Ticket::find(
            "status = 'open'"
            );
            
            $closed_tickets = Ticket::find(
            "status = 'closed'"
            );
            }
            else
            {
            $email=$auth['email'];
            
            $open_tickets = Ticket::find(
            "status = 'open' AND users_email = '$email'"
            );
            
            $closed_tickets = Ticket::find(
            "status = 'closed' AND users_email = '$email'"
            );
            
            }
            
            $this->view->setVar("open_tickets",$open_tickets);
            $this->view->setVar("closed_tickets",$closed_tickets);

    }

    public function sendAction()
    {
        if ($this->request->isPost() == true) {
        
            $auth = $this->session->get("auth");
            $user_role= $auth['role'];

            $ticket = new Ticket();
            $ticket->users_email = $auth['email'];
            $ticket->subject = $this->request->getPost('subject', array('striptags', 'string'));
            $ticket->priority = $this->request->getPost('priority', array('striptags', 'string'));
            $ticket->status = 'open';

            if ($ticket->save() == false) {
                foreach ($ticket->getMessages() as $message) {
                    $this->flash->error((string) $message);
                }

            } else {
            
            $comment = new Comment();
            if($user_role=='Admin')
            {
            $comment->from = 'admin';
            }
            else
            {
            $comment->from = 'user';
            }
            $comment->ticket_id =$ticket->id;
            $comment->content = $this->request->getPost('comment', array('striptags', 'string'));
            $comment->created_at = new Phalcon\Db\RawValue('now()');
                        if ($comment->save() == false) {
                foreach ($comment->getMessages() as $message) {
                    $this->flash->error((string) $message);
                }

            } else {
            
                $this->flash->success('Thanks, We will contact you in the next few hours');
                return $this->forward('support/index');
            }
            }
        }
        return $this->forward('support/index');
    }
    
    
     public function deleteAction($ticket_id)
    {
        
     $ticket = Ticket::findFirstById($ticket_id);
            
            $ticket->status ='closed';
            
                        if ($ticket->save() == false) {
                foreach ($ticket->getMessages() as $message) {
                    $this->flash->error((string) $message);
                }

            } else {
            
                $this->flash->success('The ticket was successfully closed');
                return $this->forward('support/index');
            }
        return $this->forward('support/index');
    }
    
    
     public function commentAction($ticket_id)
    {
        if ($this->request->isPost() == true) {
        
            $auth = $this->session->get("auth");
            $user_role= $auth['role'];
            
            $comment = new Comment();
            if($user_role=='Admin')
            {
            $comment->from = 'admin';
            }
            else
            {
            $comment->from = 'user';
            }
            $comment->ticket_id =$ticket_id;
            $comment->content = $this->request->getPost('comment', array('striptags', 'string'));
            $comment->created_at = new Phalcon\Db\RawValue('now()');
                        if ($comment->save() == false) {
                foreach ($comment->getMessages() as $message) {
                    $this->flash->error((string) $message);
                }

            } else {
            
                $this->flash->success('Thanks, We will contact you in the next few hours');
                return $this->forward('support/index');
            }
            }
        return $this->forward('support/index');
    }
}
