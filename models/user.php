<?php

class User {
    // ตัวแปรที่เก็บการติดต่อฐานข้อมูล
    private $connDB;
    // ตัวแปรที่ทำงานกับคอลัมน์ในตาราง 
    public $userId;//primary key
    public $userFullName;
    public $userBirthDate;
    public $userName;
    public $userPassword;
    public $userImage;
      //ตัวแปรสารพัดประโยชน์
      public $message;

    //constructor
    public function __construct($connDB)
    {
        $this->connDB = $connDB;
    }
   //------------------------------------------------------------------------------------------------
   //สร้างfunction การทำงานที่ล้อกับส่วนของ apis
   
   //checkPassAPI Function===========================================================================
   public function checkPassAPI(){
    $strSQL = "SELECT * FROM user_tb WHERE userName = :userName AND userPassword = :userPassword";

    $this->userName = htmlspecialchars(strip_tags($this->userName));
    $this->userPassword = htmlspecialchars(strip_tags($this->userPassword));

    //สร้างตัวแปรสที่ใช้ทำงานกับคำสั่งsql
    $stmt = $this->connDB->prepare($strSQL);

    //เอาที่ผ่านตรวจสอบแล้วไปกำหนดให้กับ parameter 

    $stmt->bindParam(":userName", $this->userName);
    $stmt->bindParam(":userPassword", $this->userPassword);

    //สั่งsqlให้ทำงาน
    $stmt->execute();
    //ส่งค่าการทำงานกลับไปยังจุดเรียกใช้งานฟังก์ชั่น 
    return $stmt;
    }

    //registerAPI Function===========================================================================

    public function registerAPI(){
      //ตัวแปรคำสั่งsql
      $strSQL = "INSERT INTO user_tb
      (userFullName,userBirthDate,userName,userPassword,userImage) 
      VALUES
      (:userFullName,:userBirthDate,:userName,:userPassword,:userImage)";
          
      $this->userFullName = htmlspecialchars(strip_tags($this->userFullName));
      $this->userBirthDate = htmlspecialchars(strip_tags($this->userBirthDate));
      $this->userName = htmlspecialchars(strip_tags($this->userName));
      $this->userPassword = htmlspecialchars(strip_tags($this->userPassword));
      $this->userImage = htmlspecialchars(strip_tags($this->userImage));
      
      
  
      //สร้างตัวแปรสที่ใช้ทำงานกับคำสั่งsql
      $stmt = $this->connDB->prepare($strSQL);
  
      //เอาที่ผ่านตรวจสอบแล้วไปกำหนดให้กับ parameter 
      $stmt->bindParam(":userFullName", $this->userFullName);
      $stmt->bindParam(":userBirthDate", $this->userBirthDate);
      $stmt->bindParam(":userName", $this->userName);
      $stmt->bindParam(":userPassword", $this->userPassword);
      $stmt->bindParam(":userImage", $this->userImage);
      
  
      //สั่งsqlให้ทำงาน
      if ($stmt->execute()) {
          return true;
      } else {
          return false;
      }
  
      }
}