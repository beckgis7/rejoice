<?php

namespace App\Menus\Sub;

use App\Menus\Menu;

class Menu3 extends Menu
{
    // public $cost;

    // public function before(){
    //     $vote_cost = $this->sessionGet('vote_cost');
    //     // log_JSON_file($vote_cost,'VOOOO');
    //     $this->cost = $vote_cost['cost_amount'];
    // }

    public function message()
    {
        return [
            '',
            "Enter PIN to confirm",
            "GHS1 payment",
        ];
    }

    public function defaultNextMenu()
    {
        return 'Sub::Menu4';
    }

    public function validate($response)
    {
        // $this->sessionSave('PIN', $response);
        return [
            'minLen:1', 
            'maxLen:4', 
        ];
    }
}
