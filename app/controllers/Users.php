<?php
    class Users extends Controller {
        private $userModel;

        public function __construct() {
            // Load the User Model
            $this->userModel = $this->loadModel('user');
        }

        public function index() {
            
        }

        public function logout() {
            unset($_SESSION['user_id']);
            unset($_SESSION['user_name']);
            unset($_SESSION['user_email']);
            session_destroy();

            redirectTo('pages/login');
        }

        
        
        

        public function createUserSession($user) {
            $_SESSION['user_id'] = $user->id;
            $_SESSION['user_email'] = $user->email;
            $_SESSION['user_name'] = $user->name;
        }



        public function register() {
            //Check for POST
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                
                // Sanitize all the POST data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                //Process the Form data - TRIM
                $keys = ['name', 'email', 'password', 'confirm_pass'];
                $post_data = populateData($keys);
                // print_r($data);

                //Initialize Error Data - Reset Value
                $keys = ['name_err', 'email_err', 'password_err', 'confirm_pass_err'];
                $post_err = initData($keys);
                //Merge POST DATA AND INITIALIZED POST ERRORS
                $data = array_merge($post_data, $post_err);
                
                // Validate Post data
                if ( empty($_POST['name']) ) {
                    $data['name_err'] = "Please enter your name.";
                }
                if ( empty($_POST['email']) ) {
                    $data['email_err'] = "Please enter your email.";
                }
                elseif ( $this->userModel->getUserByEmail($_POST['email']) ) {
                    $data['email_err'] = "Email is already taken.";
                }
                if ( empty($_POST['password']) ) {
                    $data['password_err'] = "Please enter a password.";
                }
                elseif ( strlen($_POST ['password']) <= 7 ) {
                    $data['password_err'] = "Password must be atleast 8 characters long.";
                }
                if ( empty($_POST['confirm_pass']) ) {
                    $data['confirm_pass_err'] = "Please confirm your password.";
                }
                elseif ( $_POST['confirm_pass'] != $_POST['password'] ) {
                    $data['confirm_pass_err'] = "Passwords do not match.";
                }


                // Check for any Post Data Errors
                if ( empty($data['name_err']) && empty($data['email_err']) && empty($data['password_err']) && empty($data['name_err']) ) {
                    
                    // Hash the password
                    $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                    // Insert New User to the Database
                    if ( $this->userModel->register($data) ) {
                        flash('register-success','You have successfully registered an account and can log in.');
                        redirectTo('users/login');
                    }
                    else {
                        // Something went wrong with saving
                        die('Something went wrong...');
                    }
                }
                else {
                    // Load register view with error(s)
                    $this->loadView('users/register', $data);
                }
                

            }
            else {
                //Initialize Data
                $keys = ['name', 'email', 'password', 'confirm_pass', 'name_err', 'email_err', 'password_err', 'confirm_pass_err'];
                $data = initData($keys);

                //Load the View
                $this->loadView('users/register', $data);
            }
        }

        public function login() {

            //Initialize Data
            $keys = ['email', 'password','email_err', 'password_err'];
            $data = initData($keys);

            //Check for POST
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                // Sanitize all the POST data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                // Validate form email
                if ( empty($_POST['email']) ) {
                    $data['email_err'] = 'Please enter an email.';
                }

                // Validate form password
                if ( empty($_POST['password']) ) {
                    $data['password_err'] = 'Please enter your password.';
                }

                //Check for Email existence
                if ( !$this->userModel->getUserByEmail($_POST['email']) ) {
                    //User Not Found
                    $data['email_err'] = "User with this email is not found.";
                }

                // Check if no Post Data error
                if ( empty($data['email_err']) && empty($data['password_err']) ) {
                    // Verify User credentials
                    $loggedInUser = $this->userModel->login($_POST['email'], $_POST['password']);

                    if ( $loggedInUser ) {
                        // Login Successful
                        // Create Session Variables
                        $this->createUserSession($loggedInUser);
                        // var_dump($loggedInUser);

                        redirectTo('pages/index');
                    }
                    else {
                        // Login Failed
                        $data['password_err'] = 'Incorrect password.';
                        $this->loadView('users/login', $data);
                    }
                    
                }
                else {
                    $this->loadView('users/login', $data);
                }
            }
            else {
                //Initialize Data
                // $keys = ['email', 'password','email_err', 'password_err'];
                // $data = $this->initData($keys);

                //Load the View
                $this->loadView('users/login', $data);
            }
        }
    }
?>