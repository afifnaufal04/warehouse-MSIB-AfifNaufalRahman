<?php
class Gudang{
    private $conn;
    private $table_name = "gudang";

    public $id;
    public $name;
    public $location;
    public $capacity;
    public $status;
    public $opening_hour;
    public $closing_hour;

    public $message;
    public $type;

    public function __construct($db){
        $this->conn = $db;
    }

    public function tambah(){
        $stmt = $this->conn->prepare("INSERT INTO ".$this->table_name." (name, location, capacity, status, opening_hour, closing_hour) VALUES (:name, :location, :capacity, :status, :opening_hour, :closing_hour)");

        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":location", $this->location);
        $stmt->bindParam(":capacity", $this->capacity);
        $stmt->bindParam(":status", $this->status);
        $stmt->bindParam(":opening_hour", $this->opening_hour);
        $stmt->bindParam(":closing_hour", $this->closing_hour);

        if($stmt->execute()){
            return true;
        }
        else{
            return false;
        }
    }

    public function tampildata(){
        $stmt = $this->conn->prepare("SELECT id , name, location, capacity, status, opening_hour, closing_hour FROM ".$this->table_name);
        
        $stmt->execute();
        return $stmt;
    }

    public function ambildata($id){
        $stmt = $this->conn->prepare("SELECT id , name, location, capacity, status, opening_hour, closing_hour FROM ".$this->table_name. " WHERE id=:id");

        $stmt->bindParam(':id',$this->id);
        $stmt->execute();
        return $stmt;
    }

    public function update(){
        $stmt = $this->conn->prepare("UPDATE ".$this->table_name." SET name=:name, location=:location, capacity=:capacity, opening_hour=:opening_hour, closing_hour=:closing_hour WHERE id=:id");

        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":location", $this->location);
        $stmt->bindParam(":capacity", $this->capacity);
        $stmt->bindParam(":opening_hour", $this->opening_hour);
        $stmt->bindParam(":closing_hour", $this->closing_hour);
        $stmt->bindParam(":id",$this->id);

        if ($stmt->execute()) {
            return true;
        }else{
            return false;
        }
    }

    public function hapus(){
        $stmt = $this->conn->prepare("DELETE FROM ".$this->table_name." WHERE id=:id");

        $stmt->bindParam(":id", $this->id);
        if ($stmt->execute()) {
            return true;
        }else{
            return false;
        }

    }

    public function nonaktifkan(){
        $stmt = $this->conn->prepare("UPDATE ".$this->table_name." SET status='Tidak_Aktif' WHERE id=:id");
    
        $stmt->bindParam(":id",$this->id);
    
        if ($stmt->execute()) {
            $stmt->message = "Data berhasil Di Nonaktifkan.";
            $stmt->type = "success";
            return true;
        }else{
            $stmt->message = "Data gagal Di Nonaktifkan.";
            $stmt->type = "danger";
            return false;
        }
    }

    public function aktifkan(){
        $stmt = $this->conn->prepare("UPDATE ".$this->table_name." SET status='aktif' WHERE id=:id");

        $stmt->bindParam(":id",$this->id);
    
        if ($stmt->execute()) {
            $stmt->message = "Data berhasil Di Aktifkan.";
            $stmt->type = "success";
            return true; 
        }else{
            $stmt->message = "Data gagal Di Aktifkan.";
            $stmt->type = "danger";
            return false;
        }
    }
}

?>