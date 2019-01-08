<?php
    class Posts extends Controller {
        private $postsModel;
        private $usersModel;

        public function __construct() {
            if ( isLoggedIn() ) {
                $this->postsModel = $this->loadModel('post');
                $this->usersModel = $this->loadModel('user');
            }
            else {
                redirectTo('users/login');
            }
        }

        public function index() {

            $posts = $this->postsModel->getPosts();

            $data = [
                'page_title' => 'Posts',
                'posts' => $posts
            ];

            $this->loadView('posts/index', $data);
        }

        public function add() {

            if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
                //Sanitize POST Data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                //Process the Form data and save each in an array - TRIM
                $keys = ['post_title', 'post_body', 'uid'];
                $post_data = populateData($keys);

                //Initialize Error Data - Reset Value
                $keys = ['post_title_err', 'post_body_err', 'post_session_err'];
                $post_err = initData($keys);
                //Merge POST DATA AND INITIALIZED POST ERRORS
                $data = array_merge($post_data, $post_err);

                //Validate POST Data
                if ( empty($data['post_title']) ) {
                    $data['post_title_err'] = "Please enter a Post Title.";
                }
                if ( empty($data['post_body']) ) {
                    $data['post_body_err'] = "Please enter post content.";
                }
                if ( empty($data['uid']) &&  ($data['uid'] !== $_SESSION['user_id']) ) {
                    $data['post_session_err'] = "Invalid POST Data source.";
                    // redirectTo('users/logout');
                    die('Error: Invalid POST Data source.');
                }

                //Check if no Post Errors
                if ( empty($data['post_title_err']) && empty($data['post_body_err']) && empty($data['post_session_err']) ) {
                    //Insert New Post
                    if ( $this->postsModel->addPost($post_data) ) {
                        flash('post_success', 'Post has been added.');
                        redirectTo('posts/index');
                    }
                    else{
                        //Show error in adding post
                        die('Something went wrong in adding post...');
                    }
                }
                else {
                    //Show Post Error(s)
                    $this->loadView('posts/add', $data);
                }

            }
            else {
                $data = [
                    'post_author_id' => $_SESSION['user_id'],
                    'post_author_name' => $_SESSION['user_id'],
                    'post_title' => '',
                    'post_body' => '',
                    'post_title_err' => '',
                    'post_body_err' => '',
                    'post_session_err' => ''
                ];
    
                $this->loadView('posts/add', $data);
            }
            
        }

        public function show($post_id) {
            //Query the selected post with the given post id
            $post = $this->postsModel->getPostById($post_id);

            //Query the user record matching the user_id from the post record
            $user = $this->usersModel->getUserById($post->user_id);

            $data = [
                'post' => $post,
                'user' => $user
            ];

            $this->loadView('posts/show', $data);
        }

        public function edit($post_id) {
            if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
                //Sanitize POST Data
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                //Process the Form data and save each in an array - TRIM
                $keys = ['post_title', 'post_body', 'uid'];
                $post_data = populateData($keys);
                //Append post id to be used in views
                $post_data['post_id'] = $post_id;

                //Initialize Error Data - Reset Value
                $keys = ['post_title_err', 'post_body_err', 'post_session_err'];
                $post_err = initData($keys);
                //Merge POST DATA AND INITIALIZED POST ERRORS
                $data = array_merge($post_data, $post_err);

                //Validate POST Data
                if ( empty($data['post_title']) ) {
                    $data['post_title_err'] = "Please enter a Post Title.";
                }
                if ( empty($data['post_body']) ) {
                    $data['post_body_err'] = "Please enter post content.";
                }
                if ( empty($data['uid']) &&  ($data['uid'] !== $_SESSION['user_id']) ) {
                    $data['post_session_err'] = "Invalid POST Data source.";
                    // redirectTo('users/logout');
                    die('Error: Invalid POST Data source.');
                }

                //Check if no Post Errors
                if ( empty($data['post_title_err']) && empty($data['post_body_err']) && empty($data['post_session_err']) ) {
                    //Insert New Post
                    if ( $this->postsModel->updatePost($post_data) ) {
                        flash('post_success', 'Post has been edited.');
                        redirectTo('posts/index');
                    }
                    else{
                        //Show error in adding post
                        die('Something went wrong in editing the post...');
                    }
                }
                else {
                    //Show Post Error(s)
                    $this->loadView('posts/edit', $data);
                }

            }
            else {
                $post = $this->postsModel->getPostById($post_id);
                $user = $this->usersModel->getUserById($post->user_id);
                

                $data = [
                    'post_id' => $post_id,
                    'post_author_id' => $user->id,
                    'post_author_name' => $user->name,
                    'post_title' => $post->title,
                    'post_body' => $post->body,
                    'post_title_err' => '',
                    'post_body_err' => '',
                    'post_session_err' => ''
                ];
    
                $this->loadView('posts/edit', $data);
            }
        }

        public function delete($post_id) {
            if( $_SERVER['REQUEST_METHOD'] == 'POST' ){
                $post= $this->postsModel->getPostById($post_id);

                //Check if the current user is the owner of the post to be deleted
                if ( $post->user_id == $_SESSION['user_id'] ) {
                    //Delete post
                    if ( $this->postsModel->deletePost($post_id) ) {
                        redirectTo('posts/index');
                    }
                }
                else {
                    // redirectTo('posts/index');
                    die("Something went wrong in deleting the post...");
                }
            }
            else {
                $this->usersModel->logout();
            }
        }
    }
?>
