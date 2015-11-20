
<?php
/* Yiming ZHANG ITMO 544-01 MP-1
 * Gallery.php
 * Last updated: Nov 15,2015
 */

//session_start();

//$email = $_POST["email"];


?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Photo Gallery</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/thumbnail-gallery.css" rel="stylesheet">


 <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">
                    <?php 
                    //generate a random id for guest and display:
                    $randID = int rand(1000,2000);
                    print "Welcome, guest_" . $randID . " !";

                    ?>
                </a>
        
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <!--deleted additional useless button on Nov 18, 2015-->
                    <li>
                        <a href="Guest-index.php">INDEX</a>
                    </li>
                    <li>
                        <a href="Guest-profile.php">Designer PROFILE</a>
                    </li>
                    <li>
                        <a href="login.php"> Login, Subscribe! </a>
                    </li>
                </ul>
            </div>
           
        </div>
        
    </nav>
    
</head>

<body background = "bg.png">
    <font color = "#00FF00"> <h1 class="page-header">&nbsp;&nbsp;&nbsp;&nbsp; Photo Gallery </h1> </font>

    <p><font color = "white"><?php #print "Enter the php section . . . "; ?></font></p>
    
    <!-- Gallery display section-->
    <div class ="container">
        <div class = "row">
            
    <?php

    require 'vendor/autoload.php';

    use Aws\Rds\RdsClient;
    # updated Nov 15 for testing whether the frames are blocking php codes
    $client = RdsClient::factory(array(
    'version' => 'latest',
    'region'  => 'us-east-1'
    ));
    $result = $client->describeDBInstances(array(
        'DBInstanceIdentifier' => 'simmon-the-cat-db',
    ));

    $endpoint = $result['DBInstances'][0]['Endpoint']['Address'];
    //this line could be reached so far
   
    //error happens during db connection
    $link = mysqli_connect($endpoint,"LN1878","hesaysmeow","simmoncatdb") or die ("The link failed to connect to db" . mysqli_error($link));
    //check connection
    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }

    $link->real_query("SELECT * FROM CAT_TABLE WHERE EMAIL = '$email'");

    $res = $link->use_result();
    //echo "Result set order...\n";
    while ($row = $res->fetch_assoc()) {
        #adding effects here
    $urlINFO = "<img src =\" " . $row['RAWS3URL'] . "\" />";

    $imageSTR = "#UID-" . $row['ID'] . ": " . "Email: " . $row['EMAIL']; //to be used into CSS containers
 
	?>
  
            <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                <a class="thumbnail" href="#">
                    <?php echo $urlINFO; ?> 
                </a>
            </div>

<?php
//reopen the php tag to end the while loop

} 


    $link->close();
?>

    <!-- /.Page Content -->
  </div>

    <!-- /.container -->
</div>
    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
<br><br><br>
</body>

        <footer>
        <div class = "row">
            <div align = "center">
                <div class="col-lg-12">
                    <font color = "#00FF00" ><p>Copyright &copy; Yiming ZHANG ITMO 544 MP-1 2015</p></font>
                    
                </div>
            </div>
        </div>
        </footer>

</html>
