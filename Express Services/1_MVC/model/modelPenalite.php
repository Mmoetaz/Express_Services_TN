<?php
//using "model.php" file 
	require_once "model.php";
	class ModelPenal extends Model{
    public $citizen_id;
    public $Reason;
    public $prix;

    protected $table = "penalite";
    protected $clePrimaire = "code";
    
	}




?>