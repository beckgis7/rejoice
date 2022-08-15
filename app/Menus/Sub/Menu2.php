<?php

namespace App\Menus\Sub;

use App\Menus\Menu;
use Illuminate\Database\Eloquent\Collection;

class Menu2 extends Menu
{
    public $questions;
    public $quesNumber;
    public $quesTotal;
    public $quesBody;

    public function before(){
        $this->questions = $this->sessionGet('questions');
            $this->quesNumber = $this->questions['id'];
            // $this->quesTotal = $this->questions['total'];
            $this->quesBody = $this->questions['question_tile'];
        // $this->options = $this->sessionGet('options');
    }

    public function message()
    {
        return [
            // "{$this->quesNumber} of {$this->quesTotal}",
            '',
            "{$this->quesBody}",
        ];
    }
    public function actions()
    {
        // $collect = collect($this->question);

        // $actions = $collect->map(function($entry){
        //         $entry['display'] = $entry['option_tile'];
        //         $entry['next_menu'] = $entry['Sub::opt1'];
        //         $entry['save_as'] = $entry['id'];
        //     return $entry;
        // });
        
        $actions = [
            '1' => [
                'display' => 'Doha',
                'next_menu' => 'Sub::opt1',
                'save_as' => '1',
            ],
            '2' => [
                'display' => 'Al Khor',
                'next_menu' => 'Sub::opt2',
                'save_as' => '2',
            ],
            '3' => [
                'display' => 'Dukhan',
                'next_menu' => 'Sub::opt3',
                'save_as' => '3'
            ],
        ];

        // return $this->withBack($actions);
        return $actions;
    }



    public function validate($response)
    {
        $this->sessionSave('answer', $response);
        return [
            'minLen:1',
        ];
    }
}
