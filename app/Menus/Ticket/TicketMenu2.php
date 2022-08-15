<?php

namespace App\Menus\Ticket;


use App\Menus\Menu;

class TicketMenu2 extends Menu
{
    
    public function message()
    {
        return [
            '',
            'Enter code of the voice',
            'you want to support',
            'with your ticket'
        ];
    }

    public function defaultNextMenu()
    {
        return 'Ticket::TicketMenu3';
    }

    public function validate($response)
    {
        if (strlen($response) < 3 || strlen($response) > 3) {
              $this->setError('Invalid code, please retry again');
           return false;
        }
 
 
         $this->resp = get_data_id('contestants/',$response);
 
         log_JSON_file($this->resp['data'], 'Fetcing-Ticket-By-ID');
 
            if ($this->resp['data'] === null) {
                 $this->respond(
                     strtoupper('Invalid code, please retry again')
                 );
             }
 
            if (!(($this->resp['status'] === 200 && ($this->resp['data']['active'] === 1))) ) {
                 $this->setError(strtoupper('Invalid code, please retry again'));
             } else {
                 $this->sessionSave('contestant_details', $this->resp['data']);

             }
 
         return true;
 
     }
}

