
<div class="masthead">
        <h3 class="muted"><?php define('CHANGEME', TRUE); include('CCA-config.php');include('globalconfig.php'); include('func.php'); 

		echo "<a href='$website'>$site's </a>";

		echo $game;
		echo " ";
		echo $productname;?> </h3>
        <div class="navbar">
          <div class="navbar-inner">
            <div class="container">
              <ul class="nav"><?php
               if(basename($_SERVER['PHP_SELF']) == 'index.php?id=all') 
			   {echo '<li class="active"><a href="#">All</a></li> <title>Dashboard</title>';} 
			   else {echo '<li><a href="index.php?id=all">All</a></li>';}
			   if(basename($_SERVER['PHP_SELF']) == 'index.php?id='.$general.'') 
			   {echo '<li class="active"><a href="#">'.$general.'</a></li> <title>'.$general.'</title>';} 
			   else {echo '<li><a href="index.php?id='.$general.'">'.$general.'</a></li>';}
			   if(basename($_SERVER['PHP_SELF']) == 'index.php?id='.$court.'') 
			   {echo '<li class="active"><a href="#">'.$court.'</a></li> <title>'.$court.'</title>';} 
			   else {echo '<li><a href="index.php?id='.$court.'">'.$court.'</a></li>';}
			   if(basename($_SERVER['PHP_SELF']) == 'index.php?id='.$medic.'') 
			   {echo '<li class="active"><a href="#">'.$medic.'</a></li> <title>'.$medic.'</title>';} 
			   else {echo '<li><a href="index.php?id='.$medic.'">'.$medic.'</a></li>';}
			   if(basename($_SERVER['PHP_SELF']) == 'index.php?id='.$engineer.'') 
			   {echo '<li class="active"><a href="#">'.$engineer.'</a></li> <title>'.$engineer.'</title>';} 
			   else {echo '<li><a href="index.php?id='.$engineer.'">'.$engineer.'</a></li>';}
			   if(basename($_SERVER['PHP_SELF']) == 'index.php?id='.$scanner.'') 
			   {echo '<li class="active"><a href="#">'.$scanner.'</a></li> <title>'.$scanner.'</title>';} 
			   else {echo '<li><a href="index.php?id='.$scanner.'">'.$scanner.'</a></li>';}
			   if(basename($_SERVER['PHP_SELF']) == 'index.php?id='.$recruit.'') 
			   {echo '<li class="active"><a href="#">'.$recruit.'</a></li> <title>'.$recruit.'</title>';} 
			   else {echo '<li><a href="index.php?id='.$recruit.'">'.$recruit.'</a></li>';}
                if($enableextra1==1){
								   if(basename($_SERVER['PHP_SELF']) == 'index.php?id='.$extra1.'') 
			   {echo '<li class="active"><a href="#">'.$extra1.'</a></li> <title>'.$extra1.'</title>';} 
			   else {echo '<li><a href="index.php?id='.$extra1.'">'.$extra1.'</a></li>';}
				}
				if($enableextra2==1){
								   if(basename($_SERVER['PHP_SELF']) == 'index.php?id='.$extra2.'') 
			   {echo '<li class="active"><a href="#">'.$extra2.'</a></li> <title>'.$extra2.'</title>';} 
			   else {echo '<li><a href="index.php?id='.$extra2.'">'.$extra2.'</a></li>';}
				}
				?>
              </ul>
             
            </div>

          </div>

          
        </div><!-- /.navbar -->
        <center></center>
      </div>