<?php

class AppModel extends Dbh {

    //To check if a user is admin
    public function isAdmin($userId){
        $sql = "SELECT role FROM users WHERE id = ?";
        $stmt = $this->conn()->prepare($sql);
        $stmt->execute([$userId]);
        $user = $stmt->fetchColumn();
        return  $user && $user === 'admin';
    }    
   
    //Reg Users To DB
    public function reg_user($username,$email,$password){
        $sql = "INSERT INTO users (username, email, password) VALUES (:username, :email, :password)";
        $stmt = $this->conn()->prepare($sql);
        return $stmt->execute([
            "username"=>$username,
            "email"=> $email,
            "password" => $password
        ]);
    }

    //user exist
    public function user_exist($email){
        $sql = "SELECT * FROM users WHERE email = :email LIMIT 1";
        $stmt = $this->conn()->prepare($sql);
        $stmt->execute(["email" => $email,]);
        return $stmt->fetch();

    }

    //login admin/users
    public function logIn($usernameOrEmail,$password){
        $sql = "SELECT * FROM users WHERE username = ? OR email = ? LIMIT 1";
        $stmt = $this->conn()->prepare($sql);
        $stmt->execute([$usernameOrEmail,$usernameOrEmail]);
        $user = $stmt->fetch();
        if ($user && password_verify($password,$user['password'])) {
            return $user;
        }
        return false;    
    }

    //Create Post
    public function createPost($userId,$title,$content){
        if (!$this->isAdmin($userId)) {
            return false;
        }
        //Insert Post If Validated To Admin
        $sql = "INSERT INTO post (user_id, title, content, created_at ) VALUES (?, ?, ?, NOW())";
        $stmt = $this->conn()->prepare($sql);
        return $stmt->execute([$userId,$title,$content]);
    }


    //Edit Post
    public function editPost($title,$content,$id,$userId){
        $post = $this->get_post($id);
        if (!$post) return false;
        $post_user_id = $post['user_id'];
        if(!$this->isAdmin($userId) && $post_user_id != $userId) return false;
        $sql = "UPDATE post SET title = ?, content = ?, updated_at = NOW() WHERE id = ?";
        $stmt = $this->conn()->prepare($sql);
        return $stmt->execute([$title,$content,$id]);
    }

    //Delete Post
    public function deletePost($id,$userId){
        $post = $this->get_post($id)['user_id'];
        if(!$this->isAdmin($userId) && $post != $userId) return false;
        $sql = "DELETE FROM post WHERE id = ?";
        $stmt = $this->conn()->prepare($sql);
        return $stmt->execute([$id]);
    }

    
    //Method to get all post
    public function get_posts(){
        $sql = "SELECT post.*, users.username FROM post JOIN users ON post.user_id = users.id ORDER BY created_at ASC";
        $stmt = $this->conn()->query($sql);
        return $stmt->fetchAll();
    }

    //Method to get a single post from Db
    public function get_post($id){
        $sql = "SELECT post.*, users.username FROM post JOIN users ON post.user_id = users.id WHERE post.id = ?";
        $stmt = $this->conn()->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    //search method
    public function searchPost($term){
        $term = "%$term%";
        $sql = "SELECT post.*, users.username FROM post JOIN users ON post.user_id = users.id WHERE post.title LIKE ? OR post.content LIKE ? ORDER BY post.created_at ASC";
        $stmt = $this->conn()->prepare($sql);
        $stmt->execute([$term, $term]);
        return $stmt->fetchAll();
    }


    //get all users
    public function get_users(){
        $sql = "SELECT * FROM users";
        $stmt = $this->conn()->query($sql);
        return $stmt->fetchAll();
    }

    //get single user
    public function get_user($id){
        $sql = "SELECT * FROM users WHERE id = ?";
        $stmt = $this->conn()->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }


    //Comments

    //Create a comment
    public function createComments($postId,$userId,$comment){
        $sql = "INSERT INTO comments (post_id,user_id,comment,date) VALUES (?, ?, ?, NOW())";
        $stmt = $this->conn()->prepare($sql);
        return $stmt->execute([$postId,$userId,$comment]);
    }
    
    //get comment by post
    public function getcommentByPost($postId){
        $sql = "SELECT comments.*, users.username FROM comments JOIN users ON comments.user_id = users.id WHERE comments.post_id = ? ORDER BY comments.date DESC";
        $stmt = $this->conn()->prepare($sql);
        $stmt->execute([$postId]);
        return $stmt->fetchAll();
    }

    //get single comment by id
    public function getCommentById($id){
        $sql = "SELECT comments.*, users.username FROM comments JOIN users ON comments.user_id = users.id WHERE comments.post_id = ?";
        $stmt = $this->conn()->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetchAll();
    }


    //likes
    public function likes_btn($userId,$postId,$type){
        $sql = "INSERT INTO  likes (user_id,post_id,type) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE type = VALUES(type)";
        $stmt = $this->conn()->prepare($sql);
        return $stmt->execute([$userId,$postId,$type]);
        
    }

    public function removeLike($userId,$postId){
        $sql = "DELETE FROM likes WHERE user_id = ? AND post_id = ?";
        $stmt = $this->conn()->prepare($sql);
        return $stmt->execute([$userId, $postId]);
    }

    //count likes
    public function countLikes($postId){
        $sql = "SELECT COUNT(*) FROM likes WHERE post_id = ? AND type = 'like'";
        $stmt = $this->conn()->prepare($sql);
        $stmt->execute([$postId]);
        return $stmt->fetchColumn();
    }

    public function countDisLikes($postId){
        $sql = "SELECT COUNT(*) FROM likes WHERE post_id = ? AND type = 'dislike'";
        $stmt = $this->conn()->prepare($sql);
        $stmt->execute([$postId]);
        return $stmt->fetchColumn();
    }    
    
    public function userlikes($userId,$postId){
        $sql = "SELECT type FROM likes WHERE user_id = ? AND post_id = ?";
        $stmt = $this->conn()->prepare($sql);
        $stmt->execute([$userId,$postId]);
        $row = $stmt->fetch();
        return $row ? $row['type'] : null;
    }
}

