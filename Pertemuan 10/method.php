<?php 
require_once "koneksi.php"; 

class Car 
{ 
    public function get_cars() 
    { 
        global $koneksi; 
        $query = "SELECT * FROM cars"; 
        $data = array(); 
        $result = $koneksi->query($query); 
        while ($row = mysqli_fetch_object($result)) { 
            $row->price = (float) $row->price; 
            $data[] = $row; 
        } 
        $response = array( 
            'status' => 1, 
            'message' => 'Get List Car Successfully.', 
            'data' => $data 
        ); 
        header('Content-Type: application/json'); 
        echo json_encode($response); 
    } 

    public function get_car($id = 0) 
    { 
        global $koneksi; 
        $query = "SELECT * FROM cars"; 
        if ($id != 0) { 
            $query .= " WHERE id=" . $id . " LIMIT 1"; 
        } 
        $data = array(); 
        $result = $koneksi->query($query); 
        while ($row = mysqli_fetch_object($result)) { 
            $row->price = (float) $row->price; 
            $data[] = $row; 
        } 
        $response = array( 
            'status' => 1, 
            'message' => 'Get Car Successfully.', 
            'data' => $data 
        ); 
        header('Content-Type: application/json'); 
        echo json_encode($response); 
    } 

    public function insert_car() 
    { 
        global $koneksi; 
        $arrcheckpost = array( 
            'name' => '', 
            'price' => '', 
            'qty' => '', 
            'brand' => '', 
            'owner' => '' 
        ); 
        $hitung = count(array_intersect_key($_POST, $arrcheckpost)); 

        if ($hitung == count($arrcheckpost)) { 
            $result = mysqli_query($koneksi, "INSERT INTO cars SET  
                name = '$_POST[name]',  
                price = '$_POST[price]',  
                qty = '$_POST[qty]',  
                brand = '$_POST[brand]',  
                owner = '$_POST[owner]'"); 

            if ($result) { 
                $response = array( 
                    'status' => 1, 
                    'message' => 'Car Added Successfully.' 
                ); 
            } else { 
                $response = array( 
                    'status' => 0, 
                    'message' => 'Car Addition Failed.' 
                ); 
            } 
        } else { 
            $response = array( 
                'status' => 0, 
                'message' => 'Parameter Do Not Match' 
            ); 
        } 
        header('Content-Type: application/json'); 
        echo json_encode($response); 
    } 

    public function update_car($id) 
    { 
        global $koneksi; 
        $arrcheckpost = array( 
            'name' => '', 
            'price' => '', 
            'qty' => '', 
            'brand' => '', 
            'owner' => '' 
        ); 
        $hitung = count(array_intersect_key($_POST, $arrcheckpost)); 

        if ($hitung == count($arrcheckpost)) { 
            $result = mysqli_query($koneksi, "UPDATE cars SET  
                name = '$_POST[name]',  
                price = '$_POST[price]',  
                qty = '$_POST[qty]',  
                brand = '$_POST[brand]',  
                owner = '$_POST[owner]'  
                WHERE id='$id'"); 

            if ($result) { 
                $response = array( 
                    'status' => 1, 
                    'message' => 'Car Updated Successfully.' 
                ); 
            } else { 
                $response = array( 
                    'status' => 0, 
                    'message' => 'Car Updation Failed.' 
                ); 
            } 
        } else { 
            $response = array( 
                'status' => 0, 
                'message' => 'Parameter Do Not Match' 
            ); 
        } 
        header('Content-Type: application/json'); 
        echo json_encode($response); 
    } 

    public function delete_car($id) 
    { 
        global $koneksi; 
        $query = "DELETE FROM cars WHERE id=" . $id; 

        if (mysqli_query($koneksi, $query)) { 
            $response = array( 
                'status' => 1, 
                'message' => 'Car Deleted Successfully.' 
            ); 
        } else { 
            $response = array( 
                'status' => 0, 
                'message' => 'Car Deletion Failed.' 
            ); 
        } 
        header('Content-Type: application/json'); 
        echo json_encode($response); 
    } 
}
