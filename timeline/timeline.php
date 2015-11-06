<?php
    class TimeLine {
        # Ex 2 : Fill out the methods
        private $db;
        function __construct()
        {
            # You can change mysql username or password
            $this->db = new PDO("mysql:host=localhost;dbname=timeline", "root", "root");
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        public function add($tweet) // This function inserts a tweet
        {
            $sql = "INSERT INTO tweets(author, contents, time) VALUES(':author', ':contents', ':time')";
            $stmt = $db->prepare($sql);
            $stmt->execute(array('author'=>$author,
                'contents'=>$tweet,
                'time'=>now()));
        }
        public function delete($no) // This function deletes a tweet
        {
            //Fill out here
            $sql = "DELETE FROM tweets WHERE no = :no";
            $stmt = $db->prepare($sql);
            $stmt->execute('no'=>$no);
        }
        # Ex 6: hash tag
        # Find has tag from the contents, add <a> tag using preg_replace() or preg_replace_callback()
        public function loadTweets() // This function load all tweets

            //Fill out here
            $sql = "SELECT author, time, contents FROM tweets ORDER BY time DESC";
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $rows = $stmt->fetchAll();

            return $rows;
        }
        public function searchTweets($type, $query) // This function load tweets meeting conditions
        {
            //Fill out here
            if ($type == "Author") {
                $sql = "SELECT author, time, contents FROM tweets WHERE author = :query ORDER BY time DESC ";
            } else if ($type == "Content") {
                $sql = "SELECT author, time, contents FROM tweets WHERE content LIKE %:query% ORDER BY time DESC";
            }
            $stmt = $db->prepare($sql);
            $stmt->execute(array('query'=>$query));
            $rows=$stmt->fetchAll();
            
            return $rows;   
        }
    }
?>