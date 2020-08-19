<?php
  class Bank{
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

    public function validateCard($cardName, $cardPassword){
      $result = $this->db->query("SELECT * FROM bank
                                  WHERE cardName = :cardName
                                  AND cardPassword = :cardPassword"
                                );

      $this->db->bind(':cardName',$cardName);

      $this->db->bind(':cardPassword',$cardPassword);

      $row = $this->db->single();

      return $row;
    }

    public function validateCardId($cardName, $cardPassword, $idBank){
      $result = $this->db->query("SELECT * FROM bank
                                  WHERE cardName = :cardName
                                  AND cardPassword = :cardPassword
                                  AND cardId = :idBank"
                                );

      $this->db->bind(':cardName',$cardName);

      $this->db->bind(':cardPassword',$cardPassword);

      $this->db->bind(':idBank',$idBank);

      $row = $this->db->single();

      return $row;
    }


  }
