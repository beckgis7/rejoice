<?php

namespace App\Menus\Game;

use App\Menus\Menu;

class Menu1 extends Menu
{
    public function message()
    {
        return [
            'Subscription successful.',
            'You will be required to',
            'answer 12 questions',
            'each week for 7 weeks.',
            'You will be charged',
            'GHS1 for each answer',
        ];
    }

    public function actions()
    {
        $actions = [
            '1' => [
                'display' => 'Confirm',
                'next_menu' => 'Sub::Menu2'
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
