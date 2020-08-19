<?php
  class Category{
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

    public function getCategories(){
      $this->db->query("SELECT * FROM category ");

      $results = $this->db->resultSet();

      return $results;
    }

    public function getCategory($id){
      $this->db->query("SELECT * FROM category
                      WHERE categoryId = :id
                    ");


      $this->db->bind(':id', $id);

      $row = $this->db->single();

      return $row;
    }




  }
