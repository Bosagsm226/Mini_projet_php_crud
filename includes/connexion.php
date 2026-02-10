<?php 
  $host="localhost";
  $user="root";
  $password="";
  $base_de_donnne="mini_projet_php";

  $connexion = new mysqli($host,$user,$password,$base_de_donnne);
    
  if($connexion->connect_error){
    die("Error de connexion : ".$connexion->connect_error);
  }