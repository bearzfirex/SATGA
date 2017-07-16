<?php
session_start();
if(empty($_SESSION['login']) || $_SESSION['login']!=True)
{
  echo "<script>window.location='../'</script>";
}
elseif($_SESSION['login']==True) 
{
  echo "<script>window.location='../vista/inicio/'</script>";
}
?>