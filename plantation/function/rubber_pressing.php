<?php
  include('db.php');
    

    // UPDATE PRESSING

    if (isset($_POST['pressing_update'])) {
        
        
        $id = $_POST['recording_id'];

        $rubberTypes = array(
            'Manhattan' => array(
                'kilo_bale' => $_POST['kilo_bale_manhattan'],
                'weight' => $_POST['weight_manhattan'],
                'bale_num' => $_POST['bale_num_manhattan'],
                'excess' => $_POST['excess_manhattan']
            ),
            'Showa' => array(
                'kilo_bale' => isset($_POST['kilo_bale_showa']) ? $_POST['kilo_bale_showa'] : '',
                'weight' => isset($_POST['weight_showa']) ? $_POST['weight_showa'] : '',
                'bale_num' => isset($_POST['bale_num_showa']) ? $_POST['bale_num_showa'] : '',
                'excess' => isset($_POST['excess_showa']) ? $_POST['excess_showa'] : ''
            ),
            'Dunlop' => array(
                'kilo_bale' => isset($_POST['kilo_bale_dunlop']) ? $_POST['kilo_bale_dunlop'] : '',
                'weight' => isset($_POST['weight_dunlop']) ? $_POST['weight_dunlop'] : '',
                'bale_num' => isset($_POST['bale_num_dunlop']) ? $_POST['bale_num_dunlop'] : '',
                'excess' => isset($_POST['excess_dunlop']) ? $_POST['excess_dunlop'] : ''
            ),
            'Crown' => array(
                'kilo_bale' => isset($_POST['kilo_bale_crown']) ? $_POST['kilo_bale_crown'] : '',
                'weight' => isset($_POST['weight_crown']) ? $_POST['weight_crown'] : '',
                'bale_num' => isset($_POST['bale_num_crown']) ? $_POST['bale_num_crown'] : '',
                'excess' => isset($_POST['excess_crown']) ? $_POST['excess_crown'] : ''
            ),
            'SPR' => array(
                'kilo_bale' => isset($_POST['kilo_bale_spr']) ? $_POST['kilo_bale_spr'] : '',
                'weight' => isset($_POST['weight_spr']) ? $_POST['weight_spr'] : '',
                'bale_num' => isset($_POST['bale_num_spr']) ? $_POST['bale_num_spr'] : '',
                'excess' => isset($_POST['excess_spr']) ? $_POST['excess_spr'] : ''
            )
        );

    // loop through the rubber types and insert them into the database

    foreach ($rubberTypes as $rubberType => $rubberData) {
        $kilo_bale = $rubberData['kilo_bale'];
        $weight = $rubberData['weight'];
        $bale_num = $rubberData['bale_num'];
        $excess = $rubberData['excess'];

        // insert the data into the database using the appropriate SQL statement
        $sql = "INSERT INTO planta_bales_production (recording_id, bales_type, kilo_per_bale, rubber_weight, number_bales, bales_excess, status) 
                VALUES ('$id', '$rubberType', '$kilo_bale', '$weight', '$bale_num', '$excess', 'Production')";
        // execute the SQL statement
        $result = mysqli_query($con, $sql);
        if (!$result) {
            die('Error inserting data: ' . mysqli_error($con));
        }
    }


    //     // $bale_num_spr = $_POST['bale_num_spr'];
    //     // $excess_spr = $_POST['excess_spr'];


            
        // // loop through the array and display the data
        // foreach ($rubberTypes as $type => $data) {
        //     echo $type . '<br>';
        //     echo 'Kilo per bale: ' . $data['kilo_bale'] . '<br>';
        //     echo 'Weight: ' . $data['weight'] . '<br>';
        //     echo 'No. of bale: ' . $data['bale_num'] . '<br>';
        //     echo 'Excess: ' . $data['excess'] . '<br>';
        //     echo '<br>';
        // }

                             
    //     if(mysqli_query($con, $sql)) {  
    //         header("Location: ../recording.php?tab=4");
    //         exit();
    //     } else {  
    //         echo "ERROR: Could not execute $query. " . mysqli_error($con); 
    //     }  
    }




?>