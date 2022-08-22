<?php

namespace App\Menus\Game;

use App\Menus\Menu;

class TryAgain extends Menu
{
    public $questions;
    public $options;
    public $menu;
    public $tryAgain;

    public function before(){
        $menuresp = $this->previousResponses();
        $this->menu = $menuresp->get('Game::Menu2');

        $this->questions = $this->sessionGet('questions');
        $this->options = $this->sessionGet('options');
    }

    public function message()
    {
        return [
            "Try Again for {$this->questions['question_points']} point(s).",
            // "{$this->questions['id']} of {$this->questions['total']}",
            '',
            "{$this->questions['question_tile']}",
            // '',
        ];
    }
    public function actions()
    {
        $actions = [
            '1' => [
                'display' => $this->options[0]['option_tile'],
                'next_menu' => 'Game::Menu3',
                'save_as' => [$this->options[0]['id'],$this->options[0]['option_tile']],
            ],
            '2' => [
                'display' => $this->options[1]['option_tile'],
                'next_menu' => 'Game::Menu3',
                'save_as' => [$this->options[1]['id'],$this->options[1]['option_tile']],
            ],
            '3' => [
                'display' => $this->options[2]['option_tile'],
                'next_menu' => 'Game::Menu3',
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
