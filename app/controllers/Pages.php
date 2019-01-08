<?php
    class Pages extends Controller{
        private $postModel;

        public function __construct() {
            //Load Models here
        }

        public function index() {
            $data = [
                'title' => 'DigiBoard v1.0.0',
                'description' => 'Online Digital Board built on cmd_mvc.'
            ];

            $this->loadView('pages/index', $data);
        }

        public function about() {
            $data = [
                'title' => 'About Me',
                'developer' => 'Christian Dimayacyac'
            ];
            $this->loadView('pages/about', $data);
        }
    }
?>