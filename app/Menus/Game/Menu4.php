<?php

namespace App\Menus\Game;

use App\Menus\Menu;

class Menu4 extends Menu
{
    public $opt_id;
    public $opt_points;
    public $answer;

    public function before(){
        $responses = $this->previousResponses();
        $this->answer = $responses->get('Game::Menu2');

        $question = $this->sessionGet('questions');
        $this->opt_id = $question['option_id'];
        $this->opt_points = $question['question_points'];

        try {
            // $this->respond(
            //     [
            //         "{$this->answer} is the correct",
            //         'answer.',
            //         'You have gained 20',
            //         'points.'
            //     ]
            // );
            $payload = array(
                "msisdn" => $this->tel(),
                "question_id" => $question['id'],
                "option_id" => $question['option_id'],
                "network" => mnc_name($this->network()),
                "point" => $question['question_points']
            );
    
                log_JSON_file($payload, 'Post-Payload');
            $payload = json_encode($payload);
            $req = post_data('post-answer', $payload);
                log_JSON_file($req, 'Success-Response');

        } catch (\Throwable $th) {
            $this->respond("Oops!. Unable to complete process this time.");
    
        }
    }

    public function message()
    {
        return ($this->answer[0]==$this->opt_id) ? [ "{$this->answer[1]} is the correct", "answer.", "You have gained {$this->opt_points}", "point(s)." ] : ["{$this->answer[1]} is the wrong", "answer.", "Try again at GHS0.50"];
    }

    public function actions()
    {
        $actions = ($this->answer[0]==$this->opt_id) ? ['1' => ['display' => 'End', 'next_menu' => '__end']] : ['1' => ['display' => 'Try again', 'next_menu' => 'Game::TryAgain'], '2' => ['display' => 'End', 'next_menu' => '__end']];

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
