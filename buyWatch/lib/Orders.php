<?php
  class Orders{
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

    public function createOrder($data){
        $this->db->query("INSERT INTO orders (customerName, customerAddress, customerPhone, customerNumberWatches,
          deliveryMethod, userId, productId, totalPayment)
        VALUES (:customerName, :customerAddress, :customerPhone, :customerNumberWatches,
          :deliveryMethod, :userId, :productId, :totalPayment)");

        $this->db->bind(':customerName', $data['customerName']);
        $this->db->bind(':customerAddress', $data['customerAddress']);
        $this->db->bind(':customerPhone', $data['customerPhone']);
        $this->db->bind(':customerNumberWatches', $data['customerNumberWatches']);
        $this->db->bind(':deliveryMethod', $data['deliveryMethod']);
        $this->db->bind(':userId', $data['userId']);
        $this->db->bind(':productId', $data['productId']);
        $this->db->bind(':totalPayment', $data['totalPayment']);


        if($this->db->execute()){
          return true;
        }else{
          return false;
        }
      }

      public function getOrderForUser($userId){

        $this->db->query("SELECT orders.*, product.*
                          FROM orders
                          INNER JOIN product
                          ON orders.productId = product.productId
                          WHERE orders.userId = $userId
                          ORDER BY orderDate DESC
                          ");

        $this->db->bind(':userId', $userId);

        $results = $this->db->resultSet();

        return $results;

      }


  }
