  <?php
  class Product{
    private $db;

    public function __construct(){
      $this->db = new Database;
    }



    public function selectFavoriteProduct($userId){


        $this->db->query("SELECT favoriteproduct.*, product.*
                          FROM favoriteproduct
                          INNER JOIN product
                          ON favoriteproduct.idProduct = product.productId
                          WHERE favoriteproduct.idUser = $userId
                          ");

        $this->db->bind(':userId', $userId);

        $results = $this->db->resultSet();

        return $results;


    }

    public function getProductByName($prodName){
      $this->db->query("SELECT * from product
                        WHERE productName = :prodName
                        ");

      $this->db->bind(':prodName', $prodName);

      $results = $this->db->resultSet();

      return $results;
    }

    public function updateCount($id, $productCount){
        $this->db->query("UPDATE product
                          SET
                              productCount = :productCount

                          WHERE productId = $id
                        ");

        $this->db->bind(':productCount',$productCount);


        if($this->db->execute()){
          return true;
        }else{
          return false;
        }

      }

      public function updateStock($id, $stock){
          $this->db->query("UPDATE product
                            SET
                                productStock = :stock

                            WHERE productId = $id
                          ");

          $this->db->bind(':stock', $stock);


          if($this->db->execute()){
            return true;
          }else{
            return false;
          }

        }

    public function createProduct($data){
        $this->db->query("INSERT INTO product (categoryId, productName,
        productDescription, productSpecs, productPrice, productCount, productStock, productProvider, deliveryMethod)
        VALUES (:categoryId, :productName,
        :productDescription, :productSpecs, :productPrice, :productCount, :productStock, :productProvider, :deliveryMethod)");

        $this->db->bind(':categoryId', $data['categoryId']);
        $this->db->bind(':productName', $data['productName']);
        $this->db->bind(':productDescription', $data['productDescription']);
        $this->db->bind(':productSpecs', $data['productSpecs']);
        $this->db->bind(':productPrice', $data['productPrice']);
        $this->db->bind(':productCount', $data['productCount']);
        $this->db->bind(':productStock', $data['productStock']);
        $this->db->bind(':productProvider', $data['productProvider']);
        $this->db->bind(':deliveryMethod', $data['deliveryMethod']);

        if($this->db->execute()){
          return true;
        }else{
          return false;
        }
      }

      public function editProduct($id, $data){
          $this->db->query("UPDATE product
                            SET categoryId = :categoryId,
                                productName = :productName,
                                productDescription = :productDescription,
                                productSpecs = :productSpecs,
                                productPrice = :productPrice,
                                productCount = :productCount,
                                productStock = :productStock,
                                productProvider = :productProvider,
                                deliveryMethod = :deliveryMethod
                            WHERE productId = $id
                          ");

          $this->db->bind(':categoryId', $data['categoryId']);
          $this->db->bind(':productName', $data['productName']);
          $this->db->bind(':productDescription', $data['productDescription']);
          $this->db->bind(':productSpecs', $data['productSpecs']);
          $this->db->bind(':productPrice', $data['productPrice']);
          $this->db->bind(':productCount', $data['productCount']);
          $this->db->bind(':productStock', $data['productStock']);
          $this->db->bind(':productProvider', $data['productProvider']);
          $this->db->bind(':deliveryMethod', $data['deliveryMethod']);

          if($this->db->execute()){
            return true;
          }else{
            return false;
          }

        }

        public function deleteProduct($id){
          $this->db->query("DELETE FROM product
                            WHERE productId = $id
                          ");

            if($this->db->execute()){
              return true;
            }else{
              return false;
            }
        }

      public function getByCategory($category, $deliveryMethod){

        if($deliveryMethod == "Nothing"){
          $this->db->query("SELECT product.*, category.categoryName AS cname
                        FROM product
                        INNER JOIN category
                        ON product.categoryId = category.categoryId
                        WHERE product.categoryId = $category
                        ORDER BY productDate DESC
                      ");

          $results = $this->db->resultSet();

        }else{
          $this->db->query("SELECT product.*, category.categoryName AS cname
                        FROM product
                        INNER JOIN category
                        ON product.categoryId = category.categoryId
                        WHERE product.categoryId = $category
                        AND product.deliveryMethod = :deliveryMethod
                        ORDER BY productDate DESC
                      ");

            $this->db->bind(':deliveryMethod', $deliveryMethod);

            $results = $this->db->resultSet();
        }

        return $results;
      }

      public function getByProvider($provider, $deliveryMethod){

        if($deliveryMethod == "Nothing"){
          $this->db->query("SELECT * FROM product
                            WHERE productProvider = :provider
                            ");

          $this->db->bind(':provider', $provider);

          $results = $this->db->resultSet();
        }else{
          $this->db->query("SELECT * FROM product
                            WHERE productProvider = :provider
                            AND deliveryMethod = :deliveryMethod
                            ");

          $this->db->bind(':provider', $provider);
          $this->db->bind(':deliveryMethod', $deliveryMethod);

          $results = $this->db->resultSet();
        }



        return $results;
      }

      public function getByProviderInStock($provider, $deliveryMethod, $stock){

        if($deliveryMethod == "Nothing"){
          $this->db->query("SELECT * FROM product
                            WHERE productProvider = :provider
                            AND productStock = :stock
                            ");

          $this->db->bind(':provider', $provider);
          $this->db->bind(':stock', $stock);

          $results = $this->db->resultSet();
        }else{
          $this->db->query("SELECT * FROM product
                            WHERE productProvider = :provider
                            AND deliveryMethod = :deliveryMethod
                            AND productStock = :stock
                            ");

          $this->db->bind(':provider', $provider);
          $this->db->bind(':deliveryMethod', $deliveryMethod);
          $this->db->bind(':stock', $stock);

          $results = $this->db->resultSet();
        }



        return $results;
      }

      public function getByCategoryAndProvider($category, $productProvider, $deliveryMethod){

        if($deliveryMethod == "Nothing"){
          $this->db->query("SELECT product.*, category.categoryName AS cname
                        FROM product
                        INNER JOIN category
                        ON product.categoryId = category.categoryId
                        WHERE product.categoryId = $category
                        AND product.productProvider = :productProvider
                        ORDER BY productDate DESC
                      ");

                      $this->db->bind(':productProvider', $productProvider);

                      $results = $this->db->resultSet();
        }else{
          $this->db->query("SELECT product.*, category.categoryName AS cname
                        FROM product
                        INNER JOIN category
                        ON product.categoryId = category.categoryId
                        WHERE product.categoryId = $category
                        AND product.productProvider = :productProvider
                        AND product.deliveryMethod = :deliveryMethod
                        ORDER BY productDate DESC
                      ");

                      $this->db->bind(':productProvider', $productProvider);
                      $this->db->bind(':deliveryMethod', $deliveryMethod);

                      $results = $this->db->resultSet();
        }

        return $results;
      }

      public function getByCategoryInStock($category, $inStock, $deliveryMethod){

      if($deliveryMethod == "Nothing"){
        $this->db->query("SELECT product.*, category.categoryName AS cname
                      FROM product
                      INNER JOIN category
                      ON product.categoryId = category.categoryId
                      WHERE product.categoryId = $category
                      AND product.productStock = :inStock
                      ORDER BY productDate DESC
                    ");

                    $this->db->bind(':inStock', $inStock);

                    $results = $this->db->resultSet();
      }else{
        $this->db->query("SELECT product.*, category.categoryName AS cname
                      FROM product
                      INNER JOIN category
                      ON product.categoryId = category.categoryId
                      WHERE product.categoryId = $category
                      AND product.productStock = :inStock
                      AND product.deliveryMethod = :deliveryMethod
                      ORDER BY productDate DESC
                    ");

                    $this->db->bind(':inStock', $inStock);
                    $this->db->bind(':deliveryMethod', $deliveryMethod);

                    $results = $this->db->resultSet();
      }

        return $results;
      }

      public function getByCategoryInStockAndProvider($category, $inStock, $productProvider, $deliveryMethod){

        if($deliveryMethod == "Nothing"){
          $this->db->query("SELECT product.*, category.categoryName AS cname
                        FROM product
                        INNER JOIN category
                        ON product.categoryId = category.categoryId
                        WHERE product.categoryId = $category
                        AND product.productStock = :inStock
                        AND product.productProvider = :productProvider
                        ORDER BY productDate DESC
                      ");


          $this->db->bind(':productProvider', $productProvider);
          $this->db->bind(':inStock', $inStock);

          $results = $this->db->resultSet();
        }else{
          $this->db->query("SELECT product.*, category.categoryName AS cname
                        FROM product
                        INNER JOIN category
                        ON product.categoryId = category.categoryId
                        WHERE product.categoryId = $category
                        AND product.productStock = :inStock
                        AND product.productProvider = :productProvider
                        AND product.deliveryMethod = :deliveryMethod
                        ORDER BY productDate DESC
                      ");


          $this->db->bind(':productProvider', $productProvider);
          $this->db->bind(':inStock', $inStock);
          $this->db->bind(':deliveryMethod', $deliveryMethod);

          $results = $this->db->resultSet();
        }



        return $results;
      }

      public function getByCategoryAscendingAndProvider($category, $productProvider, $deliveryMethod){


        if($deliveryMethod == "Nothing"){
          $this->db->query("SELECT product.*, category.categoryName AS cname
                        FROM product
                        INNER JOIN category
                        ON product.categoryId = category.categoryId
                        WHERE product.categoryId = $category
                        AND product.productProvider = :productProvider
                        ORDER BY productPrice ASC
                      ");

          $this->db->bind(':productProvider', $productProvider);

          $results = $this->db->resultSet();
        }else{
          $this->db->query("SELECT product.*, category.categoryName AS cname
                        FROM product
                        INNER JOIN category
                        ON product.categoryId = category.categoryId
                        WHERE product.categoryId = $category
                        AND product.productProvider = :productProvider
                        AND product.deliveryMethod = :deliveryMethod
                        ORDER BY productPrice ASC
                      ");

          $this->db->bind(':productProvider', $productProvider);
          $this->db->bind(':deliveryMethod', $deliveryMethod);

          $results = $this->db->resultSet();
        }

        return $results;
      }

      public function getByCategoryDescendingAndProvider($category, $provider, $deliveryMethod){

        if($deliveryMethod == "Nothing"){
          $this->db->query("SELECT product.*, category.categoryName AS cname
                        FROM product
                        INNER JOIN category
                        ON product.categoryId = category.categoryId
                        WHERE product.categoryId = $category
                        AND product.productProvider = :provider
                        ORDER BY productPrice DESC
                      ");

          $this->db->bind(':provider', $provider);

          $results = $this->db->resultSet();
        }else{
          $this->db->query("SELECT product.*, category.categoryName AS cname
                        FROM product
                        INNER JOIN category
                        ON product.categoryId = category.categoryId
                        WHERE product.categoryId = $category
                        AND product.productProvider = :provider
                        AND product.deliveryMethod = :deliveryMethod
                        ORDER BY productPrice DESC
                      ");

          $this->db->bind(':provider', $provider);
          $this->db->bind(':deliveryMethod', $deliveryMethod);

          $results = $this->db->resultSet();
        }

        return $results;
      }


      public function getByCategoryAscending($category, $deliveryMethod){

        if($deliveryMethod == "Nothing"){
          $this->db->query("SELECT product.*, category.categoryName AS cname
                        FROM product
                        INNER JOIN category
                        ON product.categoryId = category.categoryId
                        WHERE product.categoryId = $category
                        ORDER BY productPrice ASC
                      ");

          $results = $this->db->resultSet();
        }else{
          $this->db->query("SELECT product.*, category.categoryName AS cname
                        FROM product
                        INNER JOIN category
                        ON product.categoryId = category.categoryId
                        WHERE product.categoryId = $category
                        AND product.deliveryMethod = :deliveryMethod
                        ORDER BY productPrice ASC
                      ");

          $this->db->bind(':deliveryMethod', $deliveryMethod);

          $results = $this->db->resultSet();
        }



        return $results;
      }

      public function getByCategoryDescending($category, $deliveryMethod){

        if($deliveryMethod == "Nothing"){
          $this->db->query("SELECT product.*, category.categoryName AS cname
                        FROM product
                        INNER JOIN category
                        ON product.categoryId = category.categoryId
                        WHERE product.categoryId = $category
                        ORDER BY productPrice DESC
                      ");

          $results = $this->db->resultSet();
        }else{
          $this->db->query("SELECT product.*, category.categoryName AS cname
                        FROM product
                        INNER JOIN category
                        ON product.categoryId = category.categoryId
                        WHERE product.categoryId = $category
                        AND product.deliveryMethod = :deliveryMethod
                        ORDER BY productPrice DESC
                      ");

          $this->db->bind(':deliveryMethod', $deliveryMethod);

          $results = $this->db->resultSet();
        }

        return $results;
      }

      public function getByCategoryAscendingInStockAndProvider($category, $inStock, $provider, $deliveryMethod){

        if($deliveryMethod == "Nothing"){
          $this->db->query("SELECT product.*, category.categoryName AS cname
                        FROM product
                        INNER JOIN category
                        ON product.categoryId = category.categoryId
                        WHERE product.categoryId = $category
                        AND product.productStock = :inStock
                        AND product.productProvider = :provider
                        ORDER BY productPrice ASC
                      ");

          $this->db->bind(':inStock', $inStock);
          $this->db->bind(':provider', $provider);

          $results = $this->db->resultSet();
        }else{
          $this->db->query("SELECT product.*, category.categoryName AS cname
                        FROM product
                        INNER JOIN category
                        ON product.categoryId = category.categoryId
                        WHERE product.categoryId = $category
                        AND product.productStock = :inStock
                        AND product.productProvider = :provider
                        AND product.deliveryMethod = :deliveryMethod
                        ORDER BY productPrice ASC
                      ");

          $this->db->bind(':inStock', $inStock);
          $this->db->bind(':provider', $provider);
          $this->db->bind(':deliveryMethod', $deliveryMethod);

          $results = $this->db->resultSet();
        }

        return $results;
      }

      public function getByCategoryDescendingInStockAndProvider($category, $inStock, $provider, $deliveryMethod){

        if($deliveryMethod == "Nothing"){
          $this->db->query("SELECT product.*, category.categoryName AS cname
                        FROM product
                        INNER JOIN category
                        ON product.categoryId = category.categoryId
                        WHERE product.categoryId = $category
                        AND product.productStock = :inStock
                        AND product.productProvider = :provider
                        ORDER BY productPrice DESC
                      ");

          $this->db->bind(':inStock', $inStock);
          $this->db->bind(':provider', $provider);

          $results = $this->db->resultSet();
        }else{
          $this->db->query("SELECT product.*, category.categoryName AS cname
                        FROM product
                        INNER JOIN category
                        ON product.categoryId = category.categoryId
                        WHERE product.categoryId = $category
                        AND product.productStock = :inStock
                        AND product.productProvider = :provider
                        AND product.deliveryMethod = :deliveryMethod
                        ORDER BY productPrice DESC
                      ");

          $this->db->bind(':inStock', $inStock);
          $this->db->bind(':provider', $provider);
          $this->db->bind(':$deliveryMethod', $deliveryMethod);

          $results = $this->db->resultSet();
        }

        return $results;
      }

      public function getByCategoryAscendingInStock($category, $inStock, $deliveryMethod){

        if($deliveryMethod == "Nothing"){
          $this->db->query("SELECT product.*, category.categoryName AS cname
                        FROM product
                        INNER JOIN category
                        ON product.categoryId = category.categoryId
                        WHERE product.categoryId = $category
                        AND product.productStock = :inStock
                        ORDER BY productPrice ASC
                      ");

          $this->db->bind(':inStock', $inStock);

          $results = $this->db->resultSet();
        }else{
          $this->db->query("SELECT product.*, category.categoryName AS cname
                        FROM product
                        INNER JOIN category
                        ON product.categoryId = category.categoryId
                        WHERE product.categoryId = $category
                        AND product.productStock = :inStock
                        AND product.deliveryMethod = :deliveryMethod
                        ORDER BY productPrice ASC
                      ");

          $this->db->bind(':inStock', $inStock);
          $this->db->bind(':deliveryMethod', $deliveryMethod);

          $results = $this->db->resultSet();
        }

        return $results;
      }

      public function getByCategoryDescendingInStock($category, $inStock, $deliveryMethod){


        if($deliveryMethod == "Nothing"){
          $this->db->query("SELECT product.*, category.categoryName AS cname
                        FROM product
                        INNER JOIN category
                        ON product.categoryId = category.categoryId
                        WHERE product.categoryId = $category
                        AND product.productStock = :inStock
                        ORDER BY productPrice DESC
                      ");

          $this->db->bind(':inStock', $inStock);

          $results = $this->db->resultSet();
        }else{
          $this->db->query("SELECT product.*, category.categoryName AS cname
                        FROM product
                        INNER JOIN category
                        ON product.categoryId = category.categoryId
                        WHERE product.categoryId = $category
                        AND product.productStock = :inStock
                        AND product.deliveryMethod = :deliveryMethod
                        ORDER BY productPrice DESC
                      ");

          $this->db->bind(':inStock', $inStock);
          $this->db->bind(':deliveryMethod', $deliveryMethod);

          $results = $this->db->resultSet();
        }

        return $results;
      }

    public function getAllProducts(){
        $this->db->query("SELECT * FROM product
                          ORDER BY productDate DESC
                          ");

        $results = $this->db->resultSet();

        return $results;

      }

      public function getAllProductsInStock($inStock){
          $this->db->query("SELECT * FROM product
                            WHERE productStock = :inStock
                            ORDER BY productDate DESC
                            ");

          $this->db->bind(':inStock', $inStock);

          $results = $this->db->resultSet();

          return $results;

        }

      public function getAllProductsByAscendingPrice($deliveryMethod){

        if($deliveryMethod == "Nothing"){
          $this->db->query("SELECT * FROM product
                            ORDER BY productPrice ASC
                            ");

          $results = $this->db->resultSet();
        }else{
          $this->db->query("SELECT * FROM product
                            WHERE deliveryMethod = :deliveryMethod
                            ORDER BY productPrice ASC
                            ");

          $this->db->bind(':deliveryMethod', $deliveryMethod);

          $results = $this->db->resultSet();
        }

          return $results;
        }

        public function getAllProductsByAscendingPriceAndProvider($provider, $deliveryMethod){

            if($deliveryMethod == "Nothing"){
              $this->db->query("SELECT * FROM product
                                WHERE productProvider = :provider
                                ORDER BY productPrice ASC
                                ");

              $this->db->bind(':provider', $provider);

              $results = $this->db->resultSet();
            }else{
              $this->db->query("SELECT * FROM product
                                WHERE productProvider = :provider
                                AND deliveryMethod = :deliveryMethod
                                ORDER BY productPrice ASC
                                ");

              $this->db->bind(':provider', $provider);
              $this->db->bind(':deliveryMethod', $deliveryMethod);

              $results = $this->db->resultSet();
            }



            return $results;
          }

          public function getAllProductsByDescendingPriceAndProvider($provider, $deliveryMethod){

              if($deliveryMethod == "Nothing"){
                $this->db->query("SELECT * FROM product
                                  WHERE productProvider = :provider
                                  ORDER BY productPrice DESC
                                  ");

                $this->db->bind(':provider', $provider);

                $results = $this->db->resultSet();
              }else{
                $this->db->query("SELECT * FROM product
                                  WHERE productProvider = :provider
                                  AND deliveryMethod = :deliveryMethod
                                  ORDER BY productPrice DESC
                                  ");

                $this->db->bind(':provider', $provider);
                $this->db->bind(':deliveryMethod', $deliveryMethod);

                $results = $this->db->resultSet();
              }

              return $results;
            }

        public function getAllProductsByDescendingPrice($deliveryMethod){

          if($deliveryMethod == "Nothing"){
            $this->db->query("SELECT * FROM product
                              ORDER BY productPrice DESC
                              ");

            $results = $this->db->resultSet();
          }else{
            $this->db->query("SELECT * FROM product
                              WHERE deliveryMethod = :deliveryMethod
                              ORDER BY productPrice DESC
                              ");

            $this->db->bind(':deliveryMethod', $deliveryMethod);

            $results = $this->db->resultSet();
          }
            return $results;
          }

        public function getAllProductsByAscendingPriceInStock($inStock, $deliveryMethod){

            if($deliveryMethod == "Nothing"){
              $this->db->query("SELECT * FROM product
                                WHERE productStock = :inStock
                                ORDER BY productPrice ASC
                                ");

              $this->db->bind(':inStock', $inStock);

              $results = $this->db->resultSet();
            }else{
              $this->db->query("SELECT * FROM product
                                WHERE productStock = :inStock
                                AND deliveryMethod = :deliveryMethod
                                ORDER BY productPrice ASC
                                ");


              $this->db->bind(':deliveryMethod', $deliveryMethod);
              $this->db->bind(':inStock', $inStock);

              $results = $this->db->resultSet();
            }

            return $results;
          }

          public function getAllProductsByDescendingPriceInStock($inStock, $deliveryMethod){

              if($deliveryMethod == "Nothing"){
                $this->db->query("SELECT * FROM product
                                  WHERE productStock = :inStock
                                  ORDER BY productPrice DESC
                                  ");

                $this->db->bind(':inStock', $inStock);

                $results = $this->db->resultSet();
              }else{
                $this->db->query("SELECT * FROM product
                                  WHERE productStock = :inStock
                                  AND deliveryMethod = :deliveryMethod
                                  ORDER BY productPrice DESC
                                  ");

                $this->db->bind(':inStock', $inStock);
                $this->db->bind(':deliveryMethod', $deliveryMethod);

                $results = $this->db->resultSet();
              }

              return $results;
            }

            public function getAllProductsByAscendingPriceInStockAndProvider($inStock, $provider, $deliveryMethod){


                if($deliveryMethod == "Nothing"){
                  $this->db->query("SELECT * FROM product
                                    WHERE productStock = :inStock
                                    AND productProvider = :provider
                                    ORDER BY productPrice ASC
                                    ");

                  $this->db->bind(':inStock', $inStock);
                  $this->db->bind(':provider', $provider);

                  $results = $this->db->resultSet();
                }else{
                  $this->db->query("SELECT * FROM product
                                    WHERE productStock = :inStock
                                    AND productProvider = :provider
                                    AND deliveryMethod = :deliveryMethod
                                    ORDER BY productPrice ASC
                                    ");

                  $this->db->bind(':inStock', $inStock);
                  $this->db->bind(':provider', $provider);
                  $this->db->bind(':deliveryMethod', $deliveryMethod);

                  $results = $this->db->resultSet();
                }

                return $results;
              }

              public function getAllProductsByDescendingPriceInStockAndProvider($inStock, $provider, $deliveryMethod){

                if($deliveryMethod == "Nothing"){
                  $this->db->query("SELECT * FROM product
                                    WHERE productStock = :inStock
                                    AND productProvider = :provider
                                    ORDER BY productPrice DESC
                                    ");

                  $this->db->bind(':inStock', $inStock);
                  $this->db->bind(':provider', $provider);

                  $results = $this->db->resultSet();
                }else{
                  $this->db->query("SELECT * FROM product
                                    WHERE productStock = :inStock
                                    AND productProvider = :provider
                                    AND deliveryMethod = :deliveryMethod
                                    ORDER BY productPrice DESC
                                    ");

                  $this->db->bind(':inStock', $inStock);
                  $this->db->bind(':provider', $provider);
                  $this->db->bind(':deliveryMethod', $deliveryMethod);

                  $results = $this->db->resultSet();
                }

                  return $results;
                }



      public function getProduct($id){
        $this->db->query("SELECT * FROM product
                        WHERE productId = :id
                      ");


        $this->db->bind(':id', $id);

        $row = $this->db->single();

        return $row;
      }

      public function getByName($search){
        $this->db->query("SELECT * FROM product
                        WHERE productName = :search
                      ");


        $this->db->bind(':search', $search);

        $row = $this->db->single();

        return $row;
      }







  }
