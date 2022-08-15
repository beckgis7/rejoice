<?php

namespace App\Menus\Sub;

use App\Helpers\https_utils;
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
        return [
            'minLen:1',
        ];

        $this->resp = get_data('questions-with-options/');
 
         log_JSON_file($this->resp['data'], 'Fetcing-Questions-With-Options');
 
            if ($this->resp['data'] === null) {
                 $this->respond(
                     strtoupper('Invalid code, please retry again')
                 );
             }
 
            if (!(($this->resp['status'] === 200 && ($this->resp['data']['questions']))) ) {
                 $this->setError(strtoupper('Invalid code, please retry again'));
             } else {
                 $this->sessionSave('questions', $this->resp['data']['questions']);
                 $this->sessionSave('options', $this->resp['data']['options']);
             }
 
         return true;
    }

}
