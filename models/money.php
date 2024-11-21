<?php

class Money {
    // ตัวแปรที่เก็บการติดต่อฐานข้อมูล
    private $connDB;
    // ตัวแปรที่ทำงานกับคอลัมน์ในตาราง 
    public $moneyId; //primary key
    public $moneyDetail;
    public $moneyDate;
    public $moneyInOut;
    public $moneyType;
    public $userId; //foriegn key
    //ตัวแปรสารพัดประโยชน์
    public $message;
     //constructor
     public function __construct($connDB)
     {
         $this->connDB = $connDB;
     }
    //----------------------------------------------------------
    //function การทำงานที่ล้อกับส่วนของ apis
    
    //getAllDataByuserId Function===========================================================================
    public function getAllMoneyByuserId()
    {
        $strSQL = "SELECT * FROM money_tb WHERE userId = :userId";
        $this->userId = intval(htmlspecialchars(strip_tags($this->userId)));
        $stmt = $this->connDB->prepare($strSQL);
        $stmt->bindParam(":userId", $this->userId);
        $stmt->execute();
        return $stmt;
    }
    //insertInOutcomeAPI Function===========================================================================
    public function insertInOutComeAPI()
    {
        //ตัวแปรคำสั่งsql
        $strSQL = "INSERT INTO money_tb 
        (moneyDetail,moneyDate,moneyInOut,moneyType,userId)
        VALUES
        (:moneyDetail,:moneyDate,:moneyInOut,:moneyType,:userId);";
            
        $this->moneyDetail = htmlspecialchars(strip_tags($this->moneyDetail));
        $this->moneyDate = htmlspecialchars(strip_tags($this->moneyDate));
        $this->moneyInOut = htmlspecialchars(strip_tags($this->moneyInOut));
        $this->moneyType = htmlspecialchars(strip_tags($this->moneyType));
        $this->userId = htmlspecialchars(strip_tags($this->userId));
        
        //สร้างตัวแปรสที่ใช้ทำงานกับคำสั่งsql
        $stmt = $this->connDB->prepare($strSQL);
        //เอาที่ผ่านตรวจสอบแล้วไปกำหนดให้กับ parameter 
        $stmt->bindParam(":moneyDetail", $this->moneyDetail);
        $stmt->bindParam(":moneyDate", $this->moneyDate);
        $stmt->bindParam(":moneyInOut", $this->moneyInOut);
        $stmt->bindParam(":moneyType", $this->moneyType);
        $stmt->bindParam(":userId", $this->userId);
        //สั่งsqlให้ทำงาน
        if ($stmt->execute()) {
        return true;
        } else {
        return false;
        }
    }
}