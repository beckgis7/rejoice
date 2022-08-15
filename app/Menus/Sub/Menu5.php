<?php

namespace App\Menus\Sub;

use App\Menus\Menu;

class Menu5 extends Menu
{
    public $answer;

    public function before(){;

        $this->answer = $this->sessionGet('answer');

        try {
            $this->respond(
                [
                    "{$this->answer} is the correct",
                    'answer.',
                    'You have gained 20',
                    'points.'
                ]
            );
            $payload = array(
                "contestant_code" => $this->voice_code,
                "voter_phone" => $this->tel(),
                "voter_network" => mnc_name($this->network()),
                "voter_name" => $this->voice_name,
                "voter_qty" => $this->votes,
                "voter_cost" => $this->cost,
                "total_cost" => $this->total,
            );
    
                log_JSON_file($payload, ' Vote_Payload');
    
            $payload = json_encode($payload);
            $req = post_data('voting', $payload);
                log_JSON_file($req, 'Voting_Response');

        } catch (\Throwable $th) {
            $this->respond("Oops!. Unable to complete process this time.");
    
        }

    }

    // public function message(){

    //     return [
    //         "You have successfully",
    //         "voted for {$this->voice_name}.",
    //         "",
    //         "You were charged, GHS{$this->total}.",
    //         "Keep voting for your",
    //         "favorite voice.",
    //         '',
    //         'Wait for a prompt!'
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
    //     return $actions;
    // }

     // public function validate($response)
    // {
    //     return [
    //         'maxLen:2', 
    //     ];
    // }
}
