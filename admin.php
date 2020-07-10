<?php 
class admin{
    public $chooseUpdate;
    public $maskapai;
    public $codeMaskapai;
    public $airport;
    public $codeAiport;
    function __construct()
    {
        $this->maskapai = file_get_contents("database/code_maskapai.json");
        $this->codeMaskapai = json_decode($this->maskapai, true);
        $this->airport = file_get_contents("database/code_area.json");
        $this->codeAiport = json_decode($this->airport, true);
        $this->codeAirport = json_decode($this->airport, true);
        // print_r($this->codeAiport);
        // $this->create();
        // $this->update();
        $this->main_menu();
    }

    // function deleteDataMaskapai(){
    //     $updateData = $this->codeMaskapai;
    //     echo "Delete Maskapai By Id : ";
    //     $code = trim(fgets(STDIN));
    //     $updateData = array_filter($updateData, function($v) use($code){return $v['flight_code']==$code;});
    //     if(count($updateData) > 0){
    //         for($i=0; $i<count($this->codeMaskapai); $i++){
    //             if($this->codeMaskapai[$i]['flight_code'] == $code){
    //                 unset($this->codeMaskapai[$i]);
    //                 array_values($this->codeMaskapai);
    //             }
    //          }
    //     }else{
    //         echo "Update Maskapai By Id : ";
    //         $code = trim(fgets(STDIN));
    //     }
    //     print_r($this->codeMaskapai);
    // }
    function createDataAirport(){
        $addData = array();
        echo "Kode Airport : ";
        $inputKodeAirport= trim(fgets(STDIN));
        $addData['code'] = $inputKodeAirport;
        echo "City : ";
        $inputCity = trim(fgets(STDIN));
        $addData['city'] = $inputCity;
        echo "Nama Airport : ";
        $inputNamaAirport = trim(fgets(STDIN));
        $addData['airport'] = $inputNamaAirport;
        echo "Grup : ";
        $inputGrup = trim(fgets(STDIN));
        $addData['grup'] = $inputGrup;
        echo "Status : ";
        $inputStatus = trim(fgets(STDIN));
        $addData['status'] = $inputStatus;

        array_push($this->codeAirport, $addData);
        $createUpload = json_encode($this->codeAirport, JSON_PRETTY_PRINT);
        file_put_contents("database/code_area.json",$createUpload);
        print_r($this->codeAirport);

    }
    function updateDataAirport(){
        $updateData = $this->codeMaskapai;
        echo "Update Maskapai By Id : ";
        $code = trim(fgets(STDIN));
        echo "Update nama : ";
        $change = trim(fgets(STDIN));
        $updateData = array_filter($updateData, function($v) use($code){return $v['flight_code']==$code;});
        if(count($updateData) > 0){
            for($i=0; $i<count($this->codeMaskapai); $i++){
                if($this->codeMaskapai[$i]['flight_code'] == $code){
                     $this->codeMaskapai[$i]['flight_name'] =  $change;
                }
             }
        }else{
            echo "Update Maskapai By Id : ";
            $code = trim(fgets(STDIN));
        }
        print_r($this->codeMaskapai);
    }

        $updateData = $this->codeAirport;
        echo "\nMenu Update";
        print_r($updateData);
        echo "Update data Airport By Code : ";
        $code = trim(fgets(STDIN));
        echo "========================";
        echo "\n1. City";
        echo "\n2. Airport";
        echo "\n3. Grup";
        echo "\n4. Status";
        echo "\nPilih data yang ingin diupdate :";
        $this->chooseUpdate = trim(fgets(STDIN));
        switch($this->chooseUpdate){
            case "1":
                echo "Update City : ";
                $city = trim(fgets(STDIN));
                $this->processUpdate($code, $city);
            break;
            case "2":
                echo "Update Airport : ";
                $airport = trim(fgets(STDIN));
                $this->processUpdate($code, $airport);
            break;
            case "3":
                echo "Update Grup : ";
                $grup = trim(fgets(STDIN));
                $this->processUpdate($code, $grup);
            break;
            case "4":
                echo "Update Status : ";
                $status = trim(fgets(STDIN));
                $this->processUpdate($code, $status);
            break;

        }
    }

    function processUpdate($code,$value){
        $updateData = $this->codeAirport;
        $updateData = array_filter($updateData, function($v) use($code){return $v['code']==$code;});
        if(count($updateData) > 0){
            for($i=0; $i<count($this->codeAirport); $i++){
                if($this->codeAirport[$i]['code'] == $code){
                    switch($this->chooseUpdate){
                        case "1":
                            $this->codeAirport[$i]['city'] =  $value;
                            print_r($this->codeAirport);
                        break;
                        case "2":
                            $this->codeAirport[$i]['airport'] =  $value;
                            print_r($this->codeAirport);
                        break;
                        case "3":
                            $this->codeAirport[$i]['grup'] =  $value;
                            print_r($this->codeAirport);
                        break;
                        case "4":
                            $this->codeAirport[$i]['status'] =  $value;
                            print_r($this->codeAirport);
                        break;
                        default :
                            echo "Data tidak ditemukan";
                            break;
                    }
                }
            }
        }else{
            $this->updateDataAirport();
        }
    }


    function deleteDataAirport(){
        $updateData = $this->codeMaskapai;
        echo "Delete Maskapai By Id : ";
        $code = trim(fgets(STDIN));
        $updateData = array_filter($updateData, function($v) use($code){return $v['flight_code']==$code;});
        if(count($updateData) > 0){
            for($i=0; $i<count($this->codeMaskapai); $i++){
                if($this->codeMaskapai[$i]['flight_code'] == $code){
                    unset($this->codeMaskapai[$i]);
                    array_values($this->codeMaskapai);
                }
             }
        }else{
            echo "Update Maskapai By Id : ";
            $code = trim(fgets(STDIN));
        }
        print_r($this->codeMaskapai);
    }
}
$Admin = new admin();
?>