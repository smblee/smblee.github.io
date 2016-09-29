<?php
		if (isset($_COOKIE['loginCookieUser']))
	{
		$outstr = $_COOKIE['loginCookieUser'];
	} else {
		header("Location: include/loginHandler.php");
		exit;
	}

?>


<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<title>Better YouTube Videos</title>
		<meta name="description" content="Better YouTube">
		<meta name="author" content="Seungmin Lee">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
		<link rel="stylesheet" href="css/main.css" />
		<link rel="stylesheet" href="css/videoPage.css" />
		<style>
		body{
 text-align:left;
}
</style>
<!--		<link rel="stylesheet" href="css/videoPage.css"> -->
		<script data-cfasync="false">
		  (function(a,b,c,d,e){var f=a+"Q";b[a]=b[a]||{};b[a][d]=b[a][d]||function(){
		  (b[f]=b[f]||[]).push(arguments)};a=c.getElementsByTagName(e)[0];c=c.createElement(e);c.async=1;
		  c.src="//static.reembed.com/data/scripts/g_6356_58f0daab6a34633708903d3faaa954af.js";
		  a.parentNode.insertBefore(c,a)})("reEmbed",window,document,"setupPlaylist","script");
		</script>
		
		
	</head>
	<body>
	
	<?php
	
	//Default interest will be entertainment
	$interest = isset( 	$_GET['op'] ) ? $_GET['op'] : 'entertainment'; 
	displayMain($interest);
	?>  
</html>
<?php
Function displayMain($interest) {
	API($interest);
	
}

Function API($interest) {
	//Dynamic PlaylistID's for each interests
	$interestURL = array (
	'entertainment' => 'PL6AvGVQTyD4pkvWg6M7Qhw4KDLAmrZhBM',
	'science' => 'PLtbKV3u_fpiQh9l5kjU3hwGo3Gx4a0VkH',
	'food' => 'PL48XRvWqT9sLMVkdisx27-li-Ov9Nmtcm',
	'music' => 'PLFgquLnL59alCl_2TQvOiD5Vgm1hCaGSI',
	'sports' => 'PL8fVUTBmJhHJDAtZwiIOooPRurN0hna-j',
	'popular' => 'PLrEnWoR732-BHrPp_Pm8_VleD68f9s14-'
	);
	
	$playlistID = $interestURL[$interest];
	$maxResults = 10;
	$key = "AIzaSyA5MBqoEn8yaaMVsMFzuzKwtIo671Aza6Y";
	$API_URL =  "https://www.googleapis.com/youtube/v3/playlistItems?part=snippet&maxResults=".$maxResults."&playlistId=".$playlistID."&key=".$key;
	$json = file_get_contents($API_URL);
	$obj = json_decode($json, true);
	//echo $API_URL;
	//echo "<pre>";
	//print_r($obj);
	//echo "</pre>";
	
	$videoInfoArray = ""; //initialize video array. All the video's info in the playlist will be extracted to here


    //put each video's info into the array.
	for ($i = 0 ; $i < $maxResults ; $i++)
	{
		$videoInfoArray[$i]['title'] = $obj['items'][$i]['snippet']['title'];
		$videoInfoArray[$i]['thumbnail'] = $obj['items'][$i]['snippet']['thumbnails']['default']['url'];
		$videoInfoArray[$i]['videoID'] = $obj['items'][$i]['snippet']['resourceId']['videoId'];
		$videoInfoArray[$i]['description'] = $obj['items'][$i]['snippet']['description'];
	// add more things here if I want to
	}
	
//https://www.googleapis.com/youtube/v3/videos?part=statistics&id=ciByeELNYpo&key={YOUR_API_KEY}	
//GET VIDEO INFOS. NOT USED YET. (CAN GET STAR RATING, DURATION, VIEWS ETC..)	

	?>

<header class="navbar navbar-inverse navbar-fixed-top bs-docs-nav" role="banner">
  <div class="container">
    <div class="navbar-header">
      <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a href="main.php" class="navbar-brand"><span class = "text-primary">BetterTube</span></a>
    </div>
    <nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
      <ul class="nav navbar-nav">
        <li>
          <a href="main.php">Main Page</a>
        </li>
        <li>
          <a href="firstSetup.php">Add/Modify Interests</a>
        </li>
		<li>
		</li>
		<li>
		 <div class="navbar-brand"> <span class = "text-success"> <?php echo $interest; ?> </span> category </div>
		 </li>
      </ul>
	  <ul class="nav navbar-nav navbar-right">
		<li>
			<span class="navbar-brand"> Hey there, <?php echo $_COOKIE['loginCookieUser']; ?> </span>
		</li> 
       <li>
          <a href="logout.php">Logout</a>
        </li>
	  </ul>
    </nav>
  </div>
</header>
	
	<div class="col-md-4" style="
	height: 600px;
	overflow: scroll;
	">

	<?php	
	//PRINT ALL THE VIDEOS
	for ($i = 0 ; $i < $maxResults ; $i++)
	{
		echo "<b>".($i+1)."</b>". ". <img src=".$videoInfoArray[$i]['thumbnail']." alt='thumbnail' />  \n";
		echo "<a href ='interestVideos.php?op=".$interest."&picked=".$i."'> ".$videoInfoArray[$i]['title']."</a> <br> \n";

	}
	echo "</div>";			
	echo "<div class='col-lg-4'>";
	$selectedIndex = (isset ($_GET['picked'])) ? $_GET['picked'] : 0;
	echo "<iframe width='640' height='400' src='http://www.youtube.com/embed/".$videoInfoArray[$selectedIndex]['videoID']."'> </iframe>";
	
	echo "</div>";		
}
?>
	<div class="col-md-1" style="
	height: 600px;
	overflow: scroll;
	">
dfdfdfdfdfdfdfdfdfdfdfdfdfdfdfdf

</div>
<?php
?>