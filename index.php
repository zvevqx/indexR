<!--
phpIndxer v0.1
a replacement for apache MOD_AUTOINDEX
julien dutertre / playground84 / 
2014
-->
	<?php 
	//$iterator = new DirectoryIterator(dirname('.'));
	
	if(empty($base_url)){
		$base_url=getcwd();
	}

	//$dir = $iterator->getPath();
	
	if(isset($_GET['o'])){
		
		if(!empty($_GET['o'])){
			$base_url = $base_url.'/'.$_GET['o'];
		}

	} else {
		//$dir=dirname('localhost');
		$base_url=getcwd();
	}
	$dir = $base_url;
	$AllFiles = scandir($dir);
	$exclude = array('.','..','icons','');
	
	echo $parent = $_SERVER['REQUEST_URI'];

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
			 <span class="rtnBtn"><a href="<?php echo $parent; ?>"></a></span>
		 	<h1>HELLO SICK SAD WORLD</h1> 
		 	<h2><?php  echo $parent  ?></h2>
		 </header>


		 <div class="spacer"></div>
		 <div class="container">
			 <div class="pageDesc">
				 <p>
				 Lorem ipsum dolor sit amet, 
				 </p>
			 </div>
		 	<div class="spacer"></div>
		 <?php  indxerFileTable($AllFiles,$exclude,$base_url); ?>

		 <?php function indxerFileTable($filesArray,$exculeFiles,$path){

			$Files = $filesArray;

			?>
		 	<table class="fileList">
		 		<thead>
		 			<th class="titleFirst">file</th>
		 			<th>date</th>
		 			<th>size</th>
		 			<th>d/l</th>
		 		</thead>
		 	<?php

		 	if(!empty($Files)){
			foreach ($Files as $file){
				$content='<tr class="tableRow">';
				$fileAbsolutPath = $path.'/'.$file;

				if(isset($_GET['o'])){
					if(!empty($_GET['o'])){
						$actualFolder = $_GET['o'];
					}
				} else {
					//$dir=dirname('localhost');
					$actualFolder='';
				}



				if (in_array($file,$exculeFiles)){
					continue;
				}

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
					$content.='<td class="name"><span class="'.$fileTypeIcon.' fileType "></span> <a href="'.$actualFolder.'/'.$file.'">'.$file.'</a></td>';
				}

				$content.='<td class="date">'.$lastMod.'</td>';
				$content.='<td class="size">'.$fileSize.'</td>';
				
				if ($isFolder==TRUE){
					$content.='<td class="dl"></td>';
				} else {
					$content.='<td class="dl"><div class="downloadBtn"><a href="'.$file.'"></a></div> </td>';
				}

				// $content.='<td class="dl"><div class="downloadBtn"><a href="'.$file.'"></a></div> </td>';
				$content.='</tr>';
				echo $content;
			}
		}else{
			echo "SORRY EMPTY FOLDER";
		}

		// $dir_iterator = new RecursiveDirectoryIterator(dirname(__FILE__));
		// $iterator = new RecursiveIteratorIterator($dir_iterator);
		// foreach ($iterator as $file) {
		//     echo $file."<br>";
		// }
		?>
	 	<thead>
	 		<th class="titleFirst">file</th>
	 		<th>date</th>
	 		<th>size</th>
	 		<th>d/l</th>
	 	</thead>
	 </table>
	 <?php  } ?>	
	 	</div>
 	</body>
 </html>
 <?php
	
	function human_filesize($bytes, $decimals = 2) {
		$sz = 'BKMGTP';
		$factor = floor((strlen($bytes) - 1) / 3);
		return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$sz[$factor];
}

?>