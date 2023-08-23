<?php

        include_once("conn.php");


        $method = $_SERVER['REQUEST_METHOD'];

        if( $method === 'GET')
        {
                $bordasQuery = $conn->query("SELECT * FROM bordas;");
                $bordas = $bordasQuery->fetchAll();

                $massasQuery = $conn->query("SELECT * FROM massas;");
                $massas = $massasQuery->fetchAll();

                $saboresQuery = $conn->query("SELECT * FROM sabores;");
                $sabores = $saboresQuery->fetchAll();



        }
        else if ($method === 'POST') {
                
                $data = $_POST;

                $borda = $data[ 'borda'];
                $massa = $data[ 'massa'];
                $sabores = $data[ 'sabores'];

                if(count($sabores) > 3){
                        $_SESSION['msg'] = 'selecione no maximo 3 sabores';
                        $_SESSION['status'] = 'warning';

                }
                else {

                        $stmt = $conn->prepare("INSERT INTO pizzas(borda_id, massa_id) VALUES (:borda, :massa)");
                        $stmt->bindParam("borda:",$borda, PDO::PARAM_INT);
                        $stmt->bindParam("massa:",$massa, PDO::PARAM_INT);
                        
                        $stmt->execute();
                }

                header("Location: ..");

        }

?>