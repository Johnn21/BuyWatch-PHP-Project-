<?php
  class User{
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

    public function updateMoney($id, $moneyCount){
        $this->db->query("UPDATE user
                          SET
                              userMoney = :moneyCount

                          WHERE userId = $id
                        ");

        $this->db->bind(':moneyCount',$moneyCount);


        if($this->db->execute()){
          return true;
        }else{
          return false;
        }

      }

    public function getUser($id){
      $this->db->query("SELECT * FROM user
                      WHERE userId = :id
                    ");


      $this->db->bind(':id', $id);

      $row = $this->db->single();

      return $row;
    }

    public function createUser($data){
        $this->db->query("INSERT INTO user (userName, userPassword,
        userAddress, userCardName, userCardPassword, userMoney, bankId)
        VALUES (:userName, :userPassword,
        :userAddress, :userCardName, :userCardPassword, :userMoney, :bankId)");

        $this->db->bind(':userName', $data['userName']);
        $this->db->bind(':bankId', $data['bankId']);
        $this->db->bind(':userPassword', $data['userPassword']);
        $this->db->bind(':userAddress', $data['userAddress']);
        $this->db->bind(':userCardName', $data['userCardName']);
        $this->db->bind(':userCardPassword', $data['userCardPassword']);
        $this->db->bind(':userMoney', $data['userMoney']);

        if($this->db->execute()){
          return true;
        }else{
          return false;
        }
      }

    public function loginUser($user,$pass){
      $result = $this->db->query("SELECT * FROM user
                                  WHERE userName = :user
                                  AND userPassword = :pass"
                                );

      $this->db->bind(':user',$user);

      $this->db->bind(':pass',$pass);

      $row = $this->db->single();

      return $row;

    }

  }
