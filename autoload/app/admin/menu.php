<?php 
namespace admin;
/**
 * 
 */
use app\Server;

class Menu
{
	protected $koneksi;
	function __construct(Server $server)
	{
		$this->koneksi = $server;
	}

	public function main_menu(){
        echo "\nMenu Admin";
        echo "\n========================";
        echo "\n1. Data Maskapai";
        echo "\n2. Data Airport";
        echo "\n3. Jadwal Penerbangan";
        echo "\nMasukkan Nomor : ";
        $userInput1 = trim(fgets(STDIN));
        if($userInput1 == "1"){
            $this->menu_data_maskapai();
        }elseif($userInput1 == "2"){
            $this->menu_data_airport();
        }elseif($userInput1 == "3"){
            $this->menu_jadwal_penerbangan();
        }else{
            echo "Masukkan Nomor Menu Dengan Benar!";
        }
    }

    public function menu_data_maskapai(){
        echo "\nMenu Data Maskapai";
        echo "\n========================";
        echo "\n1. Create Data Maskapai";
        echo "\n2. Update Data Maskapai";
        echo "\n3. Delete Data Maskapai";
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
        echo "\n";
        echo "Kembali ke menu sebelumnya?(Y/n) : ";
        $userInput2 = trim(fgets(STDIN));
        if(strtolower($userInput2) == "y" ){
            $this->main_menu();
        }elseif(strtolower($userInput2) == "n"){
            $this->menu_data_maskapai();
        }else{
            echo "Masukkan huruf 'y' atau 'n' saja!";
        }
        
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
            $this->create_data_airport();
        }elseif($userInput1 == "2"){
            $this->update_data_airport();
        }elseif($userInput1 == "3"){
            $this->delete_data_airport();
        }else{
            echo "Masukkan Nomor Menu Dengan Benar!";
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


    public function create_data_maskapai(){
        $addData = array();
        echo "Kode Penerbangan : ";
        $inputKodePenerbangan= trim(fgets(STDIN));
        $addData['flight_code'] = $inputKodePenerbangan;
        echo "Nama Penerbangan : ";
        $inputNamaMaskapai = trim(fgets(STDIN));
        $addData['flight_name'] = $inputNamaMaskapai;

        array_push($this->codeMaskapai, $addData);
        $createUpload = json_encode($this->codeMaskapai, JSON_PRETTY_PRINT);
        file_put_contents("database/code_maskapai.json",$createUpload);
        print_r($this->codeMaskapai);

    }

    public function update_data_maskapai(){
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

    public function delete_data_maskapai(){
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

    public function create_data_airport(){
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

    public function update_data_airport(){
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

    public function delete_data_airport(){
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

 ?>