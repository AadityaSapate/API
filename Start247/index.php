<?php

$error = "";

if($_GET){
 
 
 



  if(!$_GET["email"])
  {
       $error .= "An email address is required.<br>";
      
  }
    if(!$_GET["sub"])
  {
     $error .= "The subject is required.<br>";
      
  }
  
    if(!$_GET["content"])
  {
      $error .= "The content field is required.<br>";
      
  }
  
   if ($_GET['email'] && filter_var($_GET["email"], FILTER_VALIDATE_EMAIL) === false) {
            
            $error .= "The email address is invalid.<br>";
            
        }  
  
   if($error != "")
   {  
       echo '<div class="alert alert-danger" role="alert"><p>There were error(s) in your form:</p>' . $error . '</div>';

   }
   else
   {
       $to = "adisaps8@gmail.com";
       $sub = $_GET['sub'];
       $message = $_GET['content'];
       
        $upload_name=$_FILES["file"]["name"];
        $upload_type=$_FILES["file"]["type"];
         $upload_size=$_FILES["file"]["size"];
          $upload_temp=$_FILES["file"]["tmp_name"];

$fp = fopen($upload_temp, "rb");
$file = fread($fp, $upload_size);

$file = chunk_split(base64_encode($file));
$num = md5(time());
    
       
       
       
     
$headers  = "From: Info Mail<example@example.com>\r\n";
$headers  .= "MIME-Version: 1.0\r\n";
$headers  .= "Content-Type: multipart/mixed; ";
$headers  .= "boundary=".$num."\r\n";
$headers  .= "--$num\r\n";

// This two steps to help avoid spam

// With message

$headers .= "Content-Type: text/html; charset=iso-8859-1\r\n";
$headers .= "Content-Transfer-Encoding: 8bit\r\n";
$headers .= "".$message."\n";
$headers .= "--".$num."\n";

// Attachment headers

$headers  .= "Content-Type: application/".$upload_type." ";
$headers  .= "name=\"".$upload_name."\"r\n";
$headers  .= "Content-Transfer-Encoding: base64\r\n";
$headers  .= "Content-Disposition: attachment; ";
$headers  .= "filename=\"".$upload_name."\"\r\n\n";
$headers  .= "".$file."\r\n";
$headers  .= "--".$num."--";

       
       // $header =  "From: ".$_GET['email'];
         
         if(mail($to,$sub,$message,$headers))
         {
             echo "Successfully sent";
             
         }
         else
         {
             echo "Not Sent";
             
         }
   }
}
?>


<html>
  <head>
    <title>Hello, world!</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
  </head>
  <body>
    
   
    
            <form id="myform" method="GET" enctype="multipart/formdata">
  <div class="form-group">
    <label for="exampleFormControlInput1">Email address</label>
    <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com">
  </div>
  
 <div class="form-group">
    <label for="exampleFormControlInput1">subject</label>
    <input type="text" class="form-control" name="sub" id="subject" >
  </div>
 
  <div class="form-group">
    <label for="exampleFormControlTextarea1">Example textarea</label>
    <textarea class="form-control" id="Textarea1" name="content" rows="3"></textarea>
  </div>
   <div class="form-group">

    <input type="file" class="form-control" name="file" id="file" >
  </div>
  
  <button type="submit" class="btn btn-primary" id="submit">Submit</button>
</form>
     
     

     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
    
    
    
  </body>
</html>