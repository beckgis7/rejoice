<?php

namespace App\Menus\Game;

use App\Menus\Menu;

class Opt1 extends Menu
{
    public $answer;
    public function before(){
        $responses = $this->previousResponses();
        $this->answer = $responses->get('Sub::Menu2');
    }
    public function message()
    {
        return [
            "{$this->answer}",
        ];
    }

    public function actions()
    {
        $actions = [
            '1' => [
                'display' => 'Confirm',
                'next_menu' => 'Sub::Menu4'
            ],
            '2' => [
                'display' => 'Decline',
                'next_menu' => '__end'
            ],
        ];

        return $actions;
    }
    
    public function validate($response)
    {
        if (strlen($response) < 1 || strlen($response) > 1) {
            $this->setError('Invalid code, please retry again');
         return false;
      }
    }

}
