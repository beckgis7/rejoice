<?php

namespace App\Menus\Sub;

use App\Menus\Menu;

class Menu4 extends Menu
{
    public $voice_name;
    public $cost;
    public $votes;
    public $total;

    // public function before(){
    //     $contestant_details = $this->sessionGet('contestant_details');
    //     $this->voice_name = $contestant_details['name'];

    //     $vote_cost = $this->sessionGet('vote_cost');
    //     $this->cost = $vote_cost['cost_amount'];

    //     $this->votes = $this->sessionGet('votes');
    //     $this->total = $this->cost * $this->votes;

    // }
    public function message()
    {
        return [
            'Doha is the correct',
            'answer.',
            'You have gained 20',
            'points.'
        ];
    }

    public function actions()
    {
        $actions = [
            '1' => [
                'display' => 'Next',
                'next_menu' => 'Sub::Menu5'
            ],
            '2' => [
                'display' => 'End',
                'next_menu' => '__end'
            ],
        ];

    //     return $this->withBack($actions);
        return $actions;
    }

    // public function defaultNextMenu()
    // {
    //     return 'Customer::PostName';
    // }

    public function validate($response)
    {
        return [
            'minLen:5', 
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
        //         $this->sessionSave('voting', $this->resp['data'][0]);

        //     }

        // return true;
    }
}
