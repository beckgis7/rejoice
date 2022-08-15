<?php

namespace App\Menus\Ticket;


use App\Menus\Menu;

class TicketMenu4 extends Menu
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

        try {
            $this->respond(
                [
                    "You have successfully bought a ticket for {$this->voice_name} and the charge is GHS{$this->total}.",
                    "If you don't receive a prompt, you can go to approvals to complete it",
                    "Keep buying tickets for your favorite voice.",
                ]
            );
    
            $payload = array(
                "contestant_code" => $this->voice_code,
                "ticket_phone" => $this->tel(),
                "ticket_network" => mnc_name($this->network()),
                "ticket_name" => $this->voice_name,
                "ticket_qty" => $this->ticket,
                "ticket_cost" => $this->cost,
                "ticket_total_cost" => $this->total
            );
    
                log_JSON_file($payload, ' Ticket_Payload');
    
            $payload = json_encode($payload);
            $req = post_data('ticketing', $payload);
                log_JSON_file($req, 'Ticketing_Response');

        } catch (\Throwable $th) {
            $this->respond("Oops!. Unable to complete process this time.");
    
        }

    }

    // public function message(){

    //     return [
    //         '',
    //         'You have successfully',
    //         "purchased {$this->ticket} tickets for {$this->voice_name}.",
    //         '',
    //         "You were charged GHS{$this->total}. Keep voting for",
    //         'your favorite voice.',
    //         '',
    //         'Wait for a prompt'
    //     ];
    // }

    // public function actions(){
    //     $actions = [
    //         '0' => [
    //             'display' => 'End',
    //             'next_menu' => '__end'
    //         ],
    //         '00' => [
    //             'display' => 'Main menu',
    //             'next_menu' => '__welcome'
    //         ],
    //     ];

    // //     return $this->withBack($actions);
    //     return $actions;
    // }

    // public function validate($response)
    // {
    //     return [
    //         'maxLen:2', 
    //     ];
    // }
}

