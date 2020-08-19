<?php
  class Admin{
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

    public function login($user,$pass){
      $result = $this->db->query("SELECT * FROM admin
                                  WHERE adminName = :user
                                  AND adminPassword = :pass"
                                );

      $this->db->bind(':user',$user);

      $this->db->bind(':pass',$pass);

      $row = $this->db->single();

      return $row;

    }



  }
