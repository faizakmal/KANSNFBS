<?php

 include '../../database/connect.php';
 $sql = "SELECT nama, email, angkatan, lulusan FROM `datadiri_alumni` ORDER BY datadiri_alumni.nama";
 $result = mysqli_query($conn, $sql);
 $id = 0;
 while ($data = mysqli_fetch_array ($result)){  
 $id++; 
 echo "   
 	<tr>  
    	<td>".$id."</td>
        <td>".$data[0]."</td>   
        <td>".$data[1]."</td>
        <td>".$data[2]."</td>
        <td>".$data[3]."</td>
        <td><a href=\"../../view/user/detailPage.php?id=".$data[1]."\">See Details</a>"."</td>
    </tr>   
                  ";    
                  }  