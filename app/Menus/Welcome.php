<?php

namespace App\Menus;

    class Welcome extends Menu
    {   
        public $subscribe;

        public function before(){
            $this->resp = get_data_id('subscribe/', $this->tel());
            $this->subscribe = $this->resp['data']['active'];
            $active = $this->subscribe ? 'Subscribed' : 'Not Subscribed';
            
            log_JSON_file("{$this->tel()} - {$active}", 'Check-Subscribe');
        }
        
        public function message()
        {

            return [
                'Welcome to MyBet',
                "Africa’s “Play Ghana",
                'Cheer Ghana” trivia',
            ];
        }
        public function actions()
        {
            $actions = [
                '1' => [
                    'display' => $this->subscribe ? 'Play Game' : 'Subscribe',
                    'next_menu' => $this->subscribe ? 'Game::Menu2' : 'Game::Menu1'
                ],
                '2' => [
                    'display' => 'Check points',
                    'next_menu' => 'Points::Menu1'
                ],
                '3' => [
                    'display' => 'Buy Credit/ Check Balance',
                    'next_menu' => 'Credit::Menu1'
                ],
            ];

            return $actions;
        }


    

        //  public function validate11($response)
        // {
            
        //      $this->resp = get_data('costing/');
     
        //      log_JSON_file($this->resp['data'][0], 'REMOTE-STATE-data');
     
        //          if ($this->resp['data'] === null) {
        //              $this->respond(
        //                  strtoupper('Invalid code, please retry again')
        //              );
        //          }
     
        //          if($response===1){
        //             if (!(($this->resp['status'] === 200 && ($this->resp['data'][0]['cost_type']==='voting'))) ) {
        //              $this->setError(strtoupper('Invalid code, please retry again'));
        //             } else {
        //                 $this->sessionSave('vote_cost', $this->resp['data'][0]);
        //             }
        //         } else if ($response===1){
        //             if (!(($this->resp['status'] === 200 && ($this->resp['data'][0]['cost_type']==='voting'))) ) {
        //              $this->setError(strtoupper('Invalid code, please retry again'));
        //             } else {
        //                 $this->sessionSave('vote_cost', $this->resp['data'][0]);
        //             }
        //         }
     
        //     //  return true;
        //      return [
        //         'maxLen:1',
        //     ];
        //  }
    }
