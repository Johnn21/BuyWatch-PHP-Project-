<?php
  class Favorite{
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

    public function selectFavorite($userId, $productId){
      $result = $this->db->query("SELECT * FROM favoriteproduct
                                  WHERE idUser = :userId
                                  AND idProduct = :productId"
                                );

      $this->db->bind(':userId',$userId);

      $this->db->bind(':productId',$productId);

      $row = $this->db->single();

      return $row;

    }


    public function deleteFavorite($id){
      $this->db->query("DELETE FROM favoriteproduct
                        WHERE idFavorite = $id
                      ");

        if($this->db->execute()){
          return true;
        }else{
          return false;
        }
    }

    public function createFavorite($user_id, $product_id){
        $this->db->query("INSERT INTO favoriteproduct (idUser, idProduct)
        VALUES (:idUser, :idProduct)");

        $this->db->bind(':idUser', $user_id);
        $this->db->bind(':idProduct', $product_id);

        if($this->db->execute()){
          return true;
        }else{
          return false;
        }
      }

    public function checkIfExists($user_id, $product_id){
        $this->db->query("SELECT * FROM favoriteproduct
                          WHERE idUser = :user_id
                          AND idProduct = :product_id
                        ");

        $this->db->bind(':user_id', $user_id);
        $this->db->bind(':product_id', $product_id);

        $row = $this->db->single();

        return $row;

    }

}
