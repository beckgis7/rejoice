<?php

namespace App\Menus\Ticket;


use App\Menus\Menu;

class TicketMenu1 extends Menu
{
    // public $resp;
    public $cost;
    
    public function before()
    {
        $ticket_cost = $this->sessionGet('ticket_cost');
        $this->cost = $ticket_cost['cost_amount'];

    }

    public function message()
    {
        return [
            '',
            'Enter number of',
            'tickets you want to',
            'buy. A ticket costs',
            "GHS{$this->cost}"
        ];
    }

    public function defaultNextMenu()
    {
        return 'Ticket::TicketMenu2';
    }

    public function validate($response)
    {
        $this->sessionSave('tickets_amount', $response);
        return [
            'minLen:1', 
            'maxLen:3', 
        ];
    }
}

