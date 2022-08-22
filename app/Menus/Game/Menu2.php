<?php

namespace App\Menus\Game;

use App\Menus\Menu;

class Menu2 extends Menu
{
    public $questions;
    public $options;

    public function before(){
        // $this->resp = get_data('questions-with-options');
        log_JSON_file($this->tel(), 'Fetching-Mobile-Number');
        $this->resp = get_data_id('questions-with-options/', $this->tel());

        // $this->questions = $this->resp['data']['questions']['question_tile'];
        $this->sessionSave('questions', $this->resp['data']['questions']);
        $this->sessionSave('options', $this->resp['data']['options']);
    
        log_JSON_file($this->resp['data']['questions'], 'Fetching-Questions');
        log_JSON_file($this->resp['data']['options'], 'Fetching-Options');

        $this->questions = $this->sessionGet('questions');
        $this->options = $this->sessionGet('options');
    }

    public function message()
    {
        return ["Try Again for {$this->questions['question_points']}","","{$this->questions['question_tile']}",''];
        // return ($this->answer) ? ["Try Again for {$this->questions['question_points']}","","{$this->questions['question_tile']}",''] : ["{$this->questions['question_tile']}",'',];
    }
    public function actions()
    {
        // $actions = function() {
        //    collect($this->options)->map(function ($opt) {
        //       [
        //         'display' => $opt->option_tile,
        //         'next_menu' => 'Sub::opt1',
        //         'save_as' => $opt->id
        //       ];
        //     }
        //   );
        // }

        $actions = [
            '1' => [
                'display' => $this->options[0]['option_tile'],
                'next_menu' => 'Game::Menu4',
                'save_as' => [$this->options[0]['id'],$this->options[0]['option_tile']],
            ],
            '2' => [
                'display' => $this->options[1]['option_tile'],
                'next_menu' => 'Game::Menu4',
                'save_as' => [$this->options[1]['id'],$this->options[1]['option_tile']],
            ],
            '3' => [
                'display' => $this->options[2]['option_tile'],
                'next_menu' => 'Game::Menu4',
                'save_as' => [$this->options[2]['id'],$this->options[2]['option_tile']]
            ],
        ];

        // return $this->withBack($actions);
        return $actions;
    }



    public function validate($response)
    {
        return [
            'minLen:1',
        ];
    }
}
