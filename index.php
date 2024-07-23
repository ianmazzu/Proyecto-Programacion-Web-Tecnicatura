<?php
        include 'class/autoload.php';
        
        $lp = Productos::listar();
        
        include './views/home.html';
?>