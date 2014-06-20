<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Donate</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">
.lead { font-size: 33px;margin-bottom:0px; }
    </style>
  </head>
  <body>
    
   <div class="container">

<div class="page-header">
    <?php include('config.php');?>
  <h1><a href='<?php echo $communityurl;?>'><?php echo $communityname;?></a><small> Donation Packages</small><span class="pull-right"><img src='https://www.paypalobjects.com/webstatic/mktg/logo/bdg_payments_by_pp_2line.png'></span></h1>
</div>
<div class="alert alert-info"><h3>So how does this work?</h3>
You select your package and pay for it on paypal, once you have you should recieve an email stating your purchase from us, in that email you will be given a unique code.<br> 
Enter the server and type /redeem into the chat and enter your code!<br>
<b>All codes are one time use.</b>
</div>
<?php
if ($payPalURL != "https://www.paypal.com/cgi-bin/webscr") {
    echo '
<div class="alert alert-danger"><h3>Warning!</h3>
We are currently testing our donation system. Please do not buy anything.<br> 

</div>
    ';
}
?>
        <div class="row">
  


    <?php
    foreach($config_options as $option){

            $currency = $config_USD ? "USD" : "GBP";
            $currency_sign = $config_USD ? "&#36;" : "&pound;";

            echo'
            <div class="col-md-4">
            <div class="panel panel-'.$option["color"].'">
                <div class="panel-heading"><h3 class="panel-title">'.$option["title"].'</h3></div>
                <div class="panel-body">
                    '.$option["description"].'
                </div>
                <div class="panel-footer">';
                echo    "<form action=\"".$payPalURL ."\" method=\"post\" target=\"_top\">
                            <input type=\"hidden\" name=\"cmd\" value=\"_xclick\">
                            <input type=\"hidden\" name=\"business\" value=\"" . $config_merchant_email . "\">
                            <input type=\"hidden\" name=\"lc\" value=\"GB\">
                            <input type=\"hidden\" name=\"item_name\" value=\"" . $option["title"] . "\">
                            <input type=\"hidden\" name=\"item_number\" value=\"" . $option["number"] . "\">
                            <input type=\"hidden\" name=\"amount\" value=\"". $option["price"] . "\">
                            <input type=\"hidden\" name=\"currency_code\" value=\"". $currency . "\">
                            <input type=\"hidden\" name=\"button_subtype\" value=\"services\">
                            <input type=\"hidden\" name=\"no_note\" value=\"0\">
                            <input type=\"hidden\" name=\"bn\" value=\"PP-BuyNowBF:btn_buynowCC_LG.gif:NonHostedGuest\">
                            <button type=\"submit\" value=\"\" class=\"btn btn-".$option["color"]."\" name=\"submit\" alt=\"PayPal – The safer, easier way to pay online.\" ><span class='glyphicon glyphicon-shopping-cart'/> ". $currency_sign . $option['price'] . "</button>
                            </form>";
            echo '</div></div></div>';
        }
    ?>
    </div>
</div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>