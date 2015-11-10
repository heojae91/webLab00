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
            $sql = "INSERT INTO tweets(author, contents, time) VALUES(:author, :contents, :time)";
            $stmt = $this->db->prepare($sql);
            date_default_timezone_set('Asia/Seoul');
            $stmt->execute(array('author'=>$tweet[0],
                'contents'=>$tweet[1],
                'time'=>date("Y-m-d H:i:s")));
        }
        public function delete($no) // This function deletes a tweet
        {
            //Fill out here
            $sql = "DELETE FROM tweets WHERE no = :no";
            $stmt = $this->db->prepare($sql);
            $stmt->execute(array('no'=>$no));
        }
        # Ex 6: hash tag
        # Find has tag from the contents, add <a> tag using preg_replace() or preg_replace_callback()
        public function loadTweets() // This function load all tweets
        {
            //Fill out here
            $sql = "SELECT author, time, contents, no FROM tweets ORDER BY time DESC";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            $rows = $stmt->fetchAll();
            foreach($rows as $row) {
                $row['contents'] = preg_replace("/#([ㄱ-ㅎ가-힣A-Za-z0-9\/\_]*)/", "<a href=\"/index.php?contents=$1&type=Content\">#$1</a>", $row['contents']);
            }   
            return $rows;
        }
        public function searchTweets($type, $query) // This function load tweets meeting conditions
        {
            //Fill out here
            if ($type == "Author") {
                $sql = "SELECT no, author, time, contents FROM tweets WHERE author = '$query' ORDER BY time DESC ";
            } else if ($type == "Content") {
                $sql = "SELECT no, author, time, contents FROM tweets WHERE contents LIKE '%$query%' ORDER BY time DESC";
            }
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            $rows=$stmt->fetchAll();
            
            return $rows;   
        }
    }
?>