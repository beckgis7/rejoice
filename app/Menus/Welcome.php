<?php

namespace App\Menus;

    use App\Helpers\https_utils;

    class Welcome extends Menu
    {   
        public $vote_cost;

        // public function before()
        // {
        //     $this->resp = get_data('costing');
        //     $this->sessionSave('vote_cost', $this->resp['data'][0]);
        //     $this->sessionSave('ticket_cost', $this->resp['data'][1]);
     
        //     log_JSON_file($this->resp['data'][0], 'Welcome--vote-cost');
        //     log_JSON_file($this->resp['data'][1], 'Welcome--ticket-cost');

        // }
        
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
                    'display' => 'Subscribe',
                    'next_menu' => 'Sub::Menu1'
                ],
                '2' => [
                    'display' => 'Check points',
                    'next_menu' => 'Points::Menu1'
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
