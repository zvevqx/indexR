
 <!DOCTYPE html>
 <html>
 <head>
 	<title>INDEXR</title>
 	<link rel="stylesheet" type="text/css" href="style.css">
 	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,400,300,700,800' rel='stylesheet' type='text/css'>
 </head>
	 <body>
		 <header>
		 <span class="rtnBtn"><a href="#"></a></span>
		 	<h1>HELLO SICK SAD WORLD</h1> 
		 	<h2>LE TITRE DU PROJET </h2>
		 </header>
		 <div class="spacer"></div>
		 <div class="container">
			 <div class="pageDesc">
				 <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				 tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
				 quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
				 consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
				 cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
				 proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
			 </div>
		 	<div class="spacer"></div>
		 	<?php 
			$dir = $base_dir  = __DIR__ ;
			$files1 = scandir($dir);

			$content = '<ul class="items">';
			foreach ($files1 as  $file) {
				$fileTypeIcon = rand(0,2);
					if($fileTypeIcon==0){
						$fileTypeIcon = 'typeImg';
					}else if($fileTypeIcon==1){
						$fileTypeIcon = 'typeVid';
					}else if($fileTypeIcon==2){
						$fileTypeIcon= 'typeSrc';
					}
				$content .= '<li class="item"><a href="'.'"><span class="'.$fileTypeIcon.' fileType "></span>'.$file.'</a><div class="downloadBtn"><a href="#"></a></div></li>';
			}
			$content .= '</ul>';
			echo $content;
	 		?>

	 	</div>
 	</body>
 </html>
