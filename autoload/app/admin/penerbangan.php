<?php 
namespace admin;
/**
 * 
 */
use app\Server;
class Penerbangan extends Jadwal
{

	public function main_menu()
    {
        echo "\nMenu Admin";
        echo "\n========================";
        echo "\n1. Data Maskapai";
        echo "\n2. Data Airport";
        echo "\n3. Jadwal Penerbangan";
        echo "\nMasukkan Nomor : ";
        $userInput1 = trim(fgets(STDIN));
        return $userInput1;
    }

    public function menu_data_maskapai()
    {
        echo "\nMenu Data Maskapai";
        echo "\n========================";
        echo "\n1. Create Data Maskapai";
        echo "\n2. Update Data Maskapai";
        echo "\n3. Delete Data Maskapai";
        echo "\nMasukkan Nomor : ";
        $userInput1 = trim(fgets(STDIN));
        return $userInput1;
    }

    public function menu_data_airport(){
        echo "\nMenu Data Airport";
        echo "\n========================";
        echo "\n1. Create Data Airport";
        echo "\n2. Update Data Airport";
        echo "\n3. Delete Data Airport";
        echo "\nMasukkan Nomor : ";
        $userInput1 = trim(fgets(STDIN));
        if($userInput1 == "1"){
            return "create";
        }elseif($userInput1 == "2"){
            return "update";
        }elseif($userInput1 == "3"){
            return "delete";
        }else{
            $this->menu_data_airport();
        }
        
    }

    public function menu_jadwal_penerbangan(){
        echo "\nMenu Jadwal Penerbangan";
        echo "\n========================";
        echo "\n1. Create Jadwal Penerbangan";
        echo "\n2. Update Jadwal Penerbangan";
        echo "\n3. Delete Jadwal Penerbangan";
        echo "\nMasukkan Nomor : ";
        $userInput1 = trim(fgets(STDIN));
        if($userInput1 == "1"){
            $this->create_data_maskapai();
        }elseif($userInput1 == "2"){
            $this->update_data_maskapai();
        }elseif($userInput1 == "3"){
            $this->delete_data_maskapai();
        }else{
            echo "Masukkan Nomor Menu Dengan Benar!";
        }
        
    }


    public function create_data_maskapai(Server $server)
    {;
        $data = $server->get_data("database/code_maskapai.json");

        $addData = array();
        echo "Kode Penerbangan : ";
        $inputKodePenerbangan= trim(fgets(STDIN));
        $addData['flight_code'] = $inputKodePenerbangan;
        echo "Nama Penerbangan : ";
        $inputNamaMaskapai = trim(fgets(STDIN));
        $addData['flight_name'] = $inputNamaMaskapai;

        array_push($data, $addData);
        $createUpload = json_encode($data, JSON_PRETTY_PRINT);
        if(file_put_contents("database/code_maskapai.json", $createUpload))
        {
            return true;
        }
        else
        {
            return false;
        }

    }

    public function update_data_maskapai(Server $server){
        $data = $server->get_data("database/code_maskapai.json");
        echo "Update Maskapai By Id : ";
        $code = trim(fgets(STDIN));
        echo "Update nama : ";
        $change = trim(fgets(STDIN));

        $updateData = array_filter($data, function($v) use($code){return $v['flight_code']==$code;});
        if(count($updateData) > 0){
            for($i=0; $i<count($data); $i++){
                if($data[$i]['flight_code'] == $code)
                {
                    $data[$i]['flight_name'] =  $change;
                    $data = json_encode($data, JSON_PRETTY_PRINT);
                    if(file_put_contents("database/code_maskapai.json", $data))
                    {
                        return true;
                    }
                    else
                    {
                        return false;
                    }
                }
             }
        }
    }

    public function delete_data_maskapai(Server $server){
        $data = $server->get_data("database/code_maskapai.json");
        echo "Delete Maskapai By Id : ";
        $code = trim(fgets(STDIN));
        $deleteData = array_filter($data, function($v) use($code){return $v['flight_code']==$code;});
        if(count($deleteData) > 0){
            for($i=0; $i<count($data); $i++){
                if($data[$i]['flight_code'] == $code){
                    unset($data[$i]);
                    array_splice($data, 1);
                    $data = json_encode($data, JSON_PRETTY_PRINT);
                    if(file_put_contents("database/code_maskapai.json", $data))
                    {
                        return true;
                    }
                    else
                    {
                        return false;
                    }
                }
             }
        }
    }

    public function create_data_airport(Server $server)
    {
        $data = $server->get_data("database/code_area.json");
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

        array_push($data, $addData);
        $createAirport = json_encode($data, JSON_PRETTY_PRINT);
        if(file_put_contents("database/code_area.json",$createAirport))
        {
            return true;
        }
        else
        {
            return false;
        }

    }

    public function update_data_airport(Server $server)
    {
        $data = $server->get_data("database/code_area.json");
        echo "\nMenu Update";
        echo "Update data Airport By Code : ";
        $code = trim(fgets(STDIN));
        echo "========================";
        echo "\n1. City";
        echo "\n2. Airport";
        echo "\n3. Grup";
        echo "\n4. Status";
        echo "\nPilih data yang ingin diupdate :";
        $chooseUpdate = trim(fgets(STDIN));
        switch($chooseUpdate){
            case "1":
                echo "Update City : ";
                $city = trim(fgets(STDIN));
                $this->processUpdate($code, $city, $data,$chooseUpdate);
            break;
            case "2":
                echo "Update Airport : ";
                $airport = trim(fgets(STDIN));
                $this->processUpdate($code, $airport, $data,$chooseUpdate);
            break;
            case "3":
                echo "Update Grup : ";
                $grup = trim(fgets(STDIN));
                $this->processUpdate($code, $grup, $data,$chooseUpdate);
            break;
            case "4":
                echo "Update Status : ";
                $status = trim(fgets(STDIN));
                $this->processUpdate($code, $status, $data,$chooseUpdate);
            break;

        }
    }

    public function processUpdate($code,$value, $data,$chooseUpdate){
        $updateData = array_filter($data, function($v) use($code){return $v['code']==$code;});
        if(count($updateData) > 0){
            for($i=0; $i<count($data); $i++){
                if($data[$i]['code'] == $code){
                    switch($chooseUpdate){
                        case "1":
                            $data[$i]['city'] =  $value;
                            $data = json_encode($data, JSON_PRETTY_PRINT);
                            if (file_put_contents("database/code_area.json", $data)) 
                            {
                                return true;
                            }
                        break;
                        case "2":
                            $data[$i]['airport'] =  $value;
                            $data = json_encode($data, JSON_PRETTY_PRINT);
                            if (file_put_contents("database/code_area.json", $data)) 
                            {
                                return true;
                            }
                        break;
                        case "3":
                            $data[$i]['grup'] =  $value;
                            $data = json_encode($data, JSON_PRETTY_PRINT);
                            if (file_put_contents("database/code_area.json", $data)) 
                            {
                                return true;
                            }
                        break;
                        case "4":
                            $data[$i]['status'] =  $value;
                            $data = json_encode($data, JSON_PRETTY_PRINT);
                            if (file_put_contents("database/code_area.json", $data)) 
                            {
                                return true;
                            }
                        break;
                        default :
                            return false;
                            break;
                    }
                }
            }
        }else{
            $this->update_data_airport();
        }
    }

    public function delete_data_airport(Server $server)
    {
        $data = $server->get_data("database/code_area.json");
        echo "Delete Maskapai By Id : ";
        $code = trim(fgets(STDIN));
        $updateData = array_filter($data, function($v) use($code){return $v['code']==$code;});
        if(count($updateData) > 0){
            for($i=0; $i<count($data); $i++){
                if($data[$i]['code'] == $code){
                    unset($data[$i]);
                    array_splice($data, 1);
                    $data = json_encode($data, JSON_PRETTY_PRINT);
                    if (file_put_contents("database/code_area.json", $data)) 
                    {
                        return true;
                    }
                }
             }
        }else{
            echo "Update Maskapai By Id : ";
            $code = trim(fgets(STDIN));
        }
    }
}

 ?>