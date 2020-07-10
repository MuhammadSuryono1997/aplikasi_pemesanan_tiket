<?php 
namespace admin;
/**
 * 
 */
class Maskapai
{

	public function menu_maskapai()
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

	public function create_maskapai($server)
	{
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

	public function update_maskapai($server)
	{
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

	public function delete_maskapai($server)
	{
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
}

 ?>