<!--
phpIndxer v0.1
a light PHP remplacement for apache MOD_AUTOINDEX
julien dutertre / playground84 / 
2014
-->
<?php 
$rootFolderUrl ="crashTest/phpIndexr/"; // SET ROOT URL ( root folder of indxer index.php)
$exclude = array('.','..','icons','style.css','index.php','indexrAdmin'); // list of hidden folder and file	


$baseUrl='.';
if(isset($_GET['o'])){
	if(!empty($_GET['o'])){
		$baseUrl = $baseUrl.'/'.$_GET['o'];
	}
}else {

}

$path = $baseUrl;
?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>INDEXR</title>
 	<link rel="stylesheet" type="text/css" href="style.css">
 	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,400,300,700,800' rel='stylesheet' type='text/css'>
 </head>

	 <body>
		 <header>
			 <span class="rtnBtn"><a href="javascript:history.go(-1)"></a></span>
		 	<h1>HELLO SICK SAD WORLD</h1> 
		 	<h2><?php  echo $path  ?></h2>
		 </header>


		 <div class="spacer"></div>
		 <div class="container">
			 <div class="pageDesc">
				 <p>
				 Lorem ipsum dolor sit amet, 
				 </p>
			 </div>
		 	<div class="spacer"></div>

		 	<?php
		 		fileIndexr( $path , $exclude, $rootFolderUrl)
		 	?>

 	</body>
 </html>


<?php 
function fileIndexr( $pathToScan , $excludeList , $rootFolder){

		$Files = scandir($pathToScan);

		if(isset($_GET['o'])){
			if(!empty($_GET['o'])){
				$actualFolder = $newFolder.$_GET['o'];
			} else {
			$actualFolder= NULL;
			}
		} else {
			$actualFolder= NULL;
		}


	 	if(count($Files)<3){
			echo "<span class='empty'>YOU COME TO FAR</span>";
	 	}else{
 				$content='	<table class="fileList">
					 			<thead>
					 			<th class="titleFirst">file</th>
					 			<th>date</th>
					 			<th>size</th>
					 			<th>d/l</th>
					 		</thead>';

			foreach ($Files as $file){
				//skip file and folder from exclude list 
				if (in_array($file,$excludeList)){
					continue;
				}


				$fileAbsolutPath = $pathToScan.'/'.$file;

				$lastMod = date("M d Y H:i:s", filemtime($fileAbsolutPath));
				$fileSize = human_filesize(filesize($fileAbsolutPath),2);

				$fileTypeIcon = 'typeImg';
				$fileTypeIcon = 'typeVid';
				$fileTypeIcon= 'typeSrc';

				
				if(is_dir($fileAbsolutPath) == FALSE){
					$ext = explode('.', $file);
					$ext = end($ext);
					$isFolder=FALSE;
				} else {
					$fileTypeIcon = 'folder';
					$dirVal ="$file";
					$isFolder=TRUE;
				};
				if ($isFolder==TRUE){
					$content.='<td class="name"><span class="'.$fileTypeIcon.' fileType "></span> <a href="?o='.$actualFolder.'/'.$file.'">'.$file.'</a></td>';
				} else {
					$content.='<td class="name"><span class="'.$fileTypeIcon.' fileType "></span> <a href="'.$fileAbsolutPath.'">'.$file.'</a></td>';
				}

				$content.='<td class="date">'.$lastMod.'</td>';
				$content.='<td class="size">'.$fileSize.'</td>';
				
				if ($isFolder==TRUE){
					$content.='<td class="dl"></td>';
				} else {
					$content.='<td class="dl"><div class="downloadBtn"><a href="'.$fileAbsolutPath.'"></a></div> </td>';
				}
				$content.='</tr>';
			}
			$content .= '		<thead>
									<th class="titleFirst">file</th>
								 	<th>date</th>
								 	<th>size</th>
								 	<th>d/l</th>
								 <thead>
							 	</table>';
			echo $content;
	}
} 
?>


<?php	
function human_filesize($bytes, $decimals = 2) {
	$sz = 'BKMGTP';
	$factor = floor((strlen($bytes) - 1) / 3);
	return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$sz[$factor];
}

?>
