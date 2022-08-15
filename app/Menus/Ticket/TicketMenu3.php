<?php

namespace App\Menus\Ticket;


use App\Menus\Menu;

class TicketMenu3 extends Menu
{
    public $cost;
    public $voice_code;
    public $voice_name;
    public $ticket;
    public $total;

    public function before(){
        $ticket_cost = $this->sessionGet('ticket_cost');
        $this->cost = $ticket_cost['cost_amount'];

        $contestant_details = $this->sessionGet('contestant_details');
        $this->voice_code = $contestant_details['code'];
        $this->voice_name = $contestant_details['name'];

        $this->ticket = $this->sessionGet('tickets_amount');

        $this->total = $this->cost * $this->ticket;
    }

    public function message()
    {
        return [
            // "Cost:{$this->cost}",
            // "ticket:{$this->ticket}",
            '',
            'Confirm payment of',
            "GHS{$this->total} in support of",
            "{$this->voice_name}"
        ];
    }

    public function actions()
    {
        $actions = [
            '1' => [
                'display' => 'Confirm',
                'next_menu' => 'Ticket::TicketMenu4'
            ],
            '2' => [
                'display' => 'Back',
                'next_menu' => 'Ticket::TicketMenu1'
            ],
        ];

    //     return $this->withBack($actions);
        return $actions;
    }

    public function validate($response)
    {
        return [
            'minLen:1', 
        ];

        // $this->resp = get_data_id('contestants/',$response);

        // log_JSON_file($this->resp['data'][0], 'REMOTE-STATE-data');

        //     if ($this->resp['data'] === null) {
        //         $this->respond(
        //             strtoupper('Invalid code, please retry again')
        //         );
        //     }

        // if (!(($this->resp['status'] === 200 && ($this->resp['data'][0]['active'] === 1))) ) {
        //         $this->setError(strtoupper('Invalid code, please retry again'));
        //     } else {
        //         $this->sessionSave('contestant_details', $this->resp['data'][0]);
        //         // $this->sessionSave('total', $this->total);

        //     }

        // return true;
    }
}

