<?php

namespace App\Menus\Points;


use App\Menus\Menu;

class Menu1 extends Menu
{
    public $point;

        public function before(){
            $this->resp = get_data_id('point/', $this->tel());
            $this->point = $this->resp['data']['point'];

            log_JSON_file("{$this->tel()} has {$this->point} point(s)", 'Check-point');
        }

    public function message()
    {
        return [
            "Total Points",
            "accumulated",
            "{$this->point} point(s).",
            "Answer more to build",
            "more points",
            ""
        ];
    }

    public function actions()
    {
        $actions = [
            '1' => [
                'display' => 'End',
                'next_menu' => '__end'
            ],
        ];

        return $actions;
    }

    public function validate($response)
    {
        $this->sessionSave('tickets_amount', $response);
        return [
            'minLen:1', 
            'maxLen:3', 
        ];
    }
}

