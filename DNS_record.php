
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>

    body{
        background-color: #bfcba8;
        height:150vh;
    }
    ::selection {

        color: #d8c292;
        background:#5b5b5b ;
    }
    div{
        position: absolute;
        top: 1000px;
        left:0px;

    }
    table {
        margin-top:70px;
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    td, th {
        border: 2px solid #5b5b5b;
        text-align: left;
        padding: 5px;
    }
    #btn {
        padding: 15px 10px;
        border-radius: 40%;
        background-color:#5b5b5b ;
        color: #d8c292;
    }
    body ul li{
        list-style-type: none;
        display: inline-block;
        border: 5px 5px solid black;
        position: relative;
        top:100px;
        left:00px;
        margin-left: 10px;
    }

    #rohim {
        background-color: red;
    }

    
    
    </style>
</head>
<body>



<div class="php">   
    <?php

echo "<br>";
    echo "<br>";

    if($_SERVER["REQUEST_METHOD"] == "POST")
    {

        $domain = $_REQUEST["domian_name"];
        $input = DNS_ALL;
        // get record 

        $dns_datas = dns_get_record($domain, $input);

        $dns_datas_length = count($dns_datas); 

        
            echo "<br>";
            echo "<br>";
            
            
                 
        

        // get specific mx record.
    
        // if(dns_get_mx($domain,$info)){
        //     foreach($info as $key=>$value){
        //         print_r("$key => $value <br>");
        //     }
        // }
        // print_r(gethostbyaddr("8.8.8.8"))//reverse dns lookup.

    
    }
    else{
        echo "can't get the info!!!";
    }
    

    ?>
 </div>

<form method="POST" >
    
    DOMAIN-NAME : <input type="text" name="domian_name">
    <br>
    <!-- DNS-RECORD : <input type="text" name="dns_record"> -->
    <br>
    <br>
    <input type="submit" id="btn">

    <br>

    <ul>

        <li>
        <input  type='checkbox' value='1'name='MX' ><span>MX</span> 
        </li>

        <li>
        <input  type='checkbox' value='1'name='A' ><span>A</span>
        </li>  
        <li>
        <input  type='checkbox' value='1'name='NS' ><span>NS</span>
        </li>       
      
        
        <li>
        <input  type='checkbox' value='1'name='ALIAS' ><span>ALIAS</span>  
          </li>
          <li>
        <input  type='checkbox' value='1'name='CNAME' ><span>CNAME</span>  
          </li>
        <li>
        <input  type='checkbox' value='1'name='PTR' ><span>PTR</span>    
        </li>
        <li>
        <input  type='checkbox' value='1'name='TXT' ><span>TXT</span>   
         </li>
        <li>
        <input  type='checkbox' value='1'name='CAA' ><span>CAA</span>    
        </li>
        <li>
        <input  type='checkbox' value='1'name='AAAA' ><span>AAAA</span>    
        </li>
        <li>
        <input  type='checkbox' value='1'name='A6' ><span>A6</span>   
         </li>
        <li>
        <input  type='checkbox' value='1'name='HINFO' ><span>HINFO</span>   
         </li>
         <li>
        <input  type='checkbox' value='1'name='SOA' ><span>SOA</span>   
         </li>
         <li>
        <input  type='checkbox' value='1'name='NAPTR' ><span>NAPTR</span>   
         </li>


    </ul>

    
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
    <table>
        <tr>
            <th> RECORD'S  </th>
            <th> AVAILABLE VALUES  </th>
        </tr>

    <?php

                
        for( $d = 0; $d < $dns_datas_length ; $d++)
        {          
            
            $new_dns_data = ($dns_datas[$d]);
            $new_dns_data_type = $new_dns_data['type'];
            
            
            $type = ["A","ALIAS","MX", "SOA","CNAME","NS","PTR","TXT","HINFO","CAA","AAAA","A6","NAPTR"];
            $type_length = count($type);

            for($t = 0 ; $t < $type_length ; $t++)
            {
                

                if($new_dns_data_type == $type[$t])
                {
                    foreach($new_dns_data as $value_KEY => $value_VALUE)
                    {
                        
                    
                        
                        if(!empty($_POST[$type[$t]]))
                        {
                            if(!empty(is_array($value_VALUE)))
                            {
                                

                                foreach($value_VALUE as $sub_key => $sub_value)
                                {
                                    
                                

                                    print_r("<tr>
                                        <th> $value_KEY </th>
                                        <th> $sub_value</th>
                                    </tr>");
                                }   
                            }else
                            {
                                    print_r("<tr>
                                    <th> $value_KEY  </th>
                                    <th>  $value_VALUE </th>
                                </tr>");

                            }

                        }else
                        {
                        //     print_r("<tr>
                        //     <th> TXT  </th>
                        //     <th> NO DATA'S ARE AVALILABLE   </th>
                        //   </tr>");
                        }
                    
                    }     
                } 
            }
            
            // "A","ALIAS" , "SOA","CNAME","NS","PTR","TXT","HINFO","CAA","SOA","AAAA","A6","NAPTR"
        }  

    ?>  

    </table>
</form>


</body>
</html>

