<?php
function pegahora(){
$h = date('h');
$h -=3; 
$nh = $h.':'.date('i:s');
return($nh);}

//cria-se uma matriz para cada dia, posteriormente uma para cada semana contendo as somas dos dias, e por fim uma mensal.

