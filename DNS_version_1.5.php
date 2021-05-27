  <!doctype html>
  <html lang="en">
    <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

      <title>DNS RECORD FINDER  </title>
    </head>

    <body>
      
    



<div class="card">
  <div class="card-header">
    <ul class="nav nav-tabs card-header-tabs">
      <li class="nav-item">
        <a class="nav-link active" href="#">DNS</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="https://merajjahir.glitch.me/" target="_blank">MY little <b>SITE</b> </a>
      </li>
    </ul>
  </div>

  <div class="card-body ">

    <h5 class="card-title mb-3">YOU CAN FIND THE AVAILABLE DNS RECORD'S</h5>

    <p class="card-text mb-5">THROUGH THE INPUT FIELD </p>
   
    <form method="POST">

      <?php

            //echo "<br>";
            //echo "<br>";

        if($_SERVER["REQUEST_METHOD"] == "POST")
        {

            $domain = $_REQUEST["domian_name"]; 

            $domain_regexp = (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $domain)) ? FALSE : TRUE;

            if($domain_regexp)
            {
              $good_domin = substr($domain, strpos($domain, '@')+1,strlen($domain) );
              $domain = $good_domin;
            }else{$domain;}

              $input = DNS_ALL;
              
              // get record 

              $dns_datas = dns_get_record($domain, $input);

              $dns_datas_length = count($dns_datas); 

              
                 // echo "<br>";
                 // echo "<br>";
                  
            
                
                     
            
        
        }
        else{
            //echo "can't get the info!!!";
        }
    

    ?>

    <fieldset>

      <div class="form-group">
        <input type="text" id="disabledTextInput" name="domian_name" class="form-control mb-5" placeholder="DOMIAN">
      </div>
     
      <div class="form-check mb-3 checkbox">
        
      
        <div class="checkbox">
          <label><input class="form-check-input " type="checkbox" id="MX" value='1'name='MX'>MX</label>
        </div>

        <div class="checkbox">
          <label><input class="form-check-input " type="checkbox" id="A" value='1'name='A'>A</label>
        </div>


       <div class="checkbox">
          <label><input class="form-check-input " type="checkbox" id="NS" value='1'name='NS'>NS</label>
        </div>

        <div class="checkbox">
          <label><input class="form-check-input " type="checkbox" id="ALIAS" value='1'name='ALIAS'>ALIAS</label>
        </div>

        <div class="checkbox">
          <label><input class="form-check-input " type="checkbox" id="CNAME" value='1'name='CNAME'>CNAME</label>
        </div>


       <div class="checkbox">
          <label><input class="form-check-input " type="checkbox" id="PTR" value='1'name='PTR'>PTR</label>
        </div>


        <div class="checkbox">
          <label><input class="form-check-input " type="checkbox" id="TXT" value='1'name='TXT'>TXT</label>
        </div>

        <div class="checkbox">
          <label><input class="form-check-input " type="checkbox" id="CAA" value='1'name='CAA'>CAA</label>
        </div>


       <div class="checkbox">
          <label><input class="form-check-input " type="checkbox" id="AAAA" value='1'name='AAAA'>AAAA</label>
        </div>



       <div class="checkbox">
          <label><input class="form-check-input " type="checkbox" id="A6" value='1'name='A6'>A6</label>
        </div>


        <div class="checkbox">
          <label><input class="form-check-input " type="checkbox" id="HINFO" value='1'name='HINFO'>HINFO</label>
        </div>

        <div class="checkbox">
          <label><input class="form-check-input " type="checkbox" id="SOA" value='1'name='SOA'>SOA</label>
        </div>


       <div class="checkbox">
          <label><input class="form-check-input " type="checkbox" id="NAPTR" value='1'name='NAPTR'>NAPTR</label>
        </div>


      
        
      </div>
      <button type="submit" class="btn btn-success">Submit</button>
  </fieldset>

</form>
  </div>


    <br>
<br><br>
  <table class="table table-striped table-hover">
  <thead>
    <tr>
      <!-- <th scope="col">#</th> -->
      <th scope="col">RECORD'S</th>
      <th scope="col">AVAILABLE VALUES </th>
    </tr>
  </thead>
  <tbody>
    <!-- <tr>
      <th scope="row">1</th>
      <td>Mark</td>
      <td>Otto</td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Jacob</td>
      <td>Thornton</td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td>Larry</td>
      <td>the Bird</td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>Jacob</td>
      <td>Thornton</td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td>Larry</td>
      <td>the Bird</td>
    </tr> -->

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


  </tbody>
</table>







      <!-- Optional JavaScript -->
      <!-- jQuery first, then Popper.js, then Bootstrap JS -->
      <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>
  </html>