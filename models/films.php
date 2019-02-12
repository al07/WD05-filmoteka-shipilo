<?php 


    function films_all($link) {

        $query = "SELECT *FROM `films`";
        $films = array();
        $result = mysqli_query($link, $query);

        if( $result = mysqli_query($link, $query) ) {
            while( $row = mysqli_fetch_array($result) ) {
                $films[] = $row;
            }
        }    
        return $films;
    }
	function process_photo_if_required() {
		$db_file_name = "";
		if( isset( $_FILES['photo']['name'] ) && $_FILES['photo']['tmp_name'] != '' ) {
			$fileName = $_FILES['photo']['name'];
			$fileTmpLoc = $_FILES['photo']['tmp_name'];
			$fileType = $_FILES['photo']['type'];
			$fileSize = $_FILES['photo']['size'];
			$fileErrorMsg = $_FILES['photo']['error'];
			
			$kaboom = explode('.', $fileName);
			$fileExt = end($kaboom);
			
			list($width, $height) = getimagesize($fileTmpLoc);
			
			if( $width < 10 || $height < 10 ) {
				$errors[] = 'That image hos no dimensions';
			}
			
			$db_file_name = rand(1000000000000, 9999999999999) . "." . $fileExt;
			
			
			if( $fileSize > 1048576 ) {
				$errors[] = 'Your image file was larger than 1mb';
			} else if( !preg_match("/\.(gif|jpg|png|jpeg)/i", $fileName) ) {
				$errors[] = "Your image wasn't jpg,jpeg,png,gif";
			} else if($fileErrorMsg == 1) {
				
			}
			
			$photoFolderLocationMin = ROOT . 'data/films/min/';
			$photoFolderLocationFull = ROOT . 'data/films/full/';
			
			$uploadfile = $photoFolderLocationFull.$db_file_name;
			
			$moveResult = move_uploaded_file($fileTmpLoc, $uploadfile);
			
			if($moveResult != true) {
				$errors[] = 'File upload failed'; 
			}
			
			require_once( ROOT."functions/image_resize_imagic.php" );
			
			$target_file = $photoFolderLocationFull . $db_file_name;
			$resize_file = $photoFolderLocationMin . $db_file_name;
			
			$wmax = 137;
			$hmax = 200;
			
			$img = createThumbNail($target_file, $wmax, $hmax);
			$img->writeImage($resize_file);
			
		}
		return $db_file_name;
	}
    function film_new($link, $title, $genre, $year, $description="") {
        	$db_file_name = process_photo_if_required();
            $query = "INSERT into `films` (`title`, `genre`, `year`, `description`, `photo`) VALUES ('".
				mysqli_real_escape_string($link, trim($title))."', '".
				mysqli_real_escape_string($link, trim($genre))."', '".
				mysqli_real_escape_string($link, trim($year))."', '".
				mysqli_real_escape_string($link, trim($description))."', '".
				mysqli_real_escape_string($link, trim($db_file_name))."')";
            
            $result = false;
            if( mysqli_query($link, $query) ) {
                $result = true;
            }
			
            return $result;
    }
	
	function film_update($link, $id, $title, $genre, $year, $description) {
		
		$db_file_name = process_photo_if_required();
		$query = "UPDATE `films` SET title = '".mysqli_real_escape_string($link, $title). 
								  "',genre = '".mysqli_real_escape_string($link, $genre). 
								  "',year = '".mysqli_real_escape_string($link, $year).
								  "',description = '".mysqli_real_escape_string($link, $description).
								  "',photo = '".mysqli_real_escape_string($link, $db_file_name). 
								  "'WHERE id = ".mysqli_real_escape_string($link, $id)." LIMIT 1";
		if ( mysqli_query($link, $query) ) {
			$result = true;
		} else { 
			$result = false;
		}

		return $result;
	}
	function get_film($link, $id) {
		$query = "SELECT * FROM `films` where id = '".mysqli_real_escape_string($link, $id)."' LIMIT 1";
        $result = mysqli_query($link, $query);
		if ( $result = mysqli_query($link, $query) ) {
			$film = mysqli_fetch_array($result);
		}
		return $film;
	}
	function delete_film($link, $id) {
		$query = "DELETE FROM `films` where id = '".mysqli_real_escape_string($link, $id)."' LIMIT 1";
		mysqli_query($link, $query);

		if ( mysqli_affected_rows($link) > 0 ) {
			$result = true;
		} else {
			$result = false;
		}
		return $result;
	}
?>
