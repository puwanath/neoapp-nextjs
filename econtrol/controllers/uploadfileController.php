<?php
header('Content-Type: application/json');
//$param = "upload";
//require "models/$param.php";

class uploadController
{
	public function index($get_part0='',$get_part1='',$get_part2='',$get_part3=''){
		$dir= curPageURL()."/assets/";
		$url = curPageURL();
		$urlweb = curPageURLweb();
		$pagename = "อัพโหลดไฟล์";
		$param = "upload file";
		$model = new uploadController;

		$select = isset($_REQUEST['select']) ? $_REQUEST['select'] : '';
			if($select!=''):
				switch($select){

					case 'upload' :
						$model->uploadImg();
						break;

					case 'readimg' :
						$model->readImg();
						break;

					default :
					$urlredirec = "../welcome";
					echo '<META HTTP-EQUIV=REFRESH CONTENT="0; '.$urlredirec.'">';
					exit();
				}

				endif;
	}


	public function uploadImg(){
		$base = 'images/';
		$root = realpath(dirname(__FILE__) .'/../../')."/images/";
		$relpath = isset($_REQUEST['path']) ?  $_REQUEST['path'] : ''; // Use options.uploader.pathVariableName

		$path = $root;
		//$path = "../../images/";
		// Do not give the file to load into the category that is lower than the root
		if (realpath($root.$relpath) && is_dir(realpath($root.$relpath)) && strpos(realpath($root.$relpath).'/', $root) !== false) {
		    $path = realpath($root.$relpath).'/';
		}

		$errors = array(
		    0 => 'There is no error, the file uploaded with success',
		    1 => 'The uploaded file exceeds the upload_max_filesize directive in php.ini',
		    2 => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
		    3 => 'The uploaded file was only partially uploaded',
		    4 => 'No file was uploaded',
		    6 => 'Missing a temporary folder',
		    7 => 'Failed to write file to disk.',
		    8 => 'A PHP extension stopped the file upload.',
		);

		// Black and white list
		$config = array(
		    'white_extensions' => array('png', 'jpeg', 'gif', 'jpg'),
		    'black_extensions' => array('php', 'exe', 'phtml'),
		);

		// function for creating safe name of file
		function makeSafe($file) {
		    $file = rtrim($file, '.');
		    //$regex = ['#(\.){2,}#', '#[^A-Za-z0-9\.\_\- ]#', '#^\.#'];
		    $regex = array('#(\.){2,}#', '#[^A-Za-z0-9\.\_\- ]#', '#^\.#');
		    return trim(preg_replace($regex, '', $file));
		}


		$result = (object)array('error'=> 0, 'msg'=>array(), 'files'=> array());
		//$result = (object)['error'=> 0, 'msg'=>[], 'files'=> []];

		function warning_handler($errno, $errstr) {
		    global $result;
		    $result->error = $errno;
		    $result->msg[] = $errstr;
		    exit(json_encode($result));
		}

		set_error_handler('warning_handler', E_ALL);

		//Here 'images' is options.uploader.filesVariableName
		if (isset($_FILES['images'])
		    and is_array($_FILES['images'])
		    and isset($_FILES['images']['name'])
		    and is_array($_FILES['images']['name'])
		    and count($_FILES['images']['name'])
		) {
		    foreach ($_FILES['images']['name'] as $i=>$file) {
		        if ($_FILES['images']['error'][$i]) {
		            trigger_error(isset($errors[$_FILES['images']['error'][$i]]) ? $errors[$_FILES['images']['error'][$i]] : 'Error', E_USER_WARNING);
		            continue;
		        }
		      	$tmp_name = $_FILES['images']['tmp_name'][$i];
		      	$filename = $_FILES['images']['name'][$i];
						//echo $path;
		        //if (move_uploaded_file($tmp_name, $file = $path.makeSafe($_FILES['images']['name'][$i]))) {
						//move_uploaded_file($_FILES['images']['tmp_name'][$i],$path.makeSafe($_FILES['images']['name'][$i]));
						//$pic = copy($tmp_name,$path.$filename);
		        //if ($pic>0) {
		        if (move_uploaded_file($tmp_name, $file = $path.makeSafe($_FILES['images']['name'][$i]))) {
								$file = $path.makeSafe($_FILES['images']['name'][$i]);
		            $info = pathinfo($file);
		            // check whether the file extension is included in the whitelist
		            if (isset($config['white_extensions']) and count($config['white_extensions'])) {
		                if (!in_array(strtolower($info['extension']), $config['white_extensions'])) {
		                    unlink($file);
		                    trigger_error('File type not in white list', E_USER_WARNING);
		                    continue;
		                }
		            }
		            //check whether the file extension is included in the black list
		            if (isset($config['black_extensions']) and count($config['black_extensions'])) {
		                if (in_array(strtolower($info['extension']), $config['black_extensions'])) {
		                    unlink($file);
		                    trigger_error('File type in black list', E_USER_WARNING);
		                    continue;
		                }
		            }
		            $result->msg[] = 'File '.$_FILES['images']['name'][$i].' was upload';
		            $result->images[] = $base.basename($file);
		        } else {
		            $result->error = 5;
		            if (!is_writable($path)) {
		                trigger_error('Destination directory is not writeble', E_USER_WARNING);
		            } else {
		                trigger_error('No images have been uploaded', E_USER_WARNING);
		            }
		        }
		    }
		};

		// if (!$result->error and !count($result->files)) {
		//     $result->error = 5;
		//     trigger_error('No files have been uploaded', E_USER_WARNING);
		// }

		exit(json_encode($result));
	}

	public function readImg(){

	function translit ($str) {
	    $str = (string)$str;

	    $repl = array(
	            'а'=>'a','б'=>'b','в'=>'v','г'=>'g','д'=>'d','е'=>'e','ё'=>'yo','ж'=>'zh','з'=>'z','и'=>'i','й'=>'y',
	            'к'=>'k','л'=>'l','м'=>'m','н'=>'n','о'=>'o','п'=>'p','р'=>'r','с'=>'s','т'=>'t','у'=>'u','ф'=>'f',
	            'х'=>'h','ц'=>'ts','ч'=>'ch','ш'=>'sh','щ'=>'shch','ъ'=>'','ы'=>'i','ь'=>'','э'=>'e','ю'=>'yu','я'=>'ya',
	            ' '=>'-',
	            'А'=>'A','Б'=>'B','В'=>'V','Г'=>'G','Д'=>'D','Е'=>'E','Ё'=>'Yo','Ж'=>'Zh','З'=>'Z','И'=>'I','Й'=>'Y',
	            'К'=>'K','Л'=>'L','М'=>'M','Н'=>'N','О'=>'O','П'=>'P','Р'=>'R','С'=>'S','Т'=>'T','У'=>'U','Ф'=>'F',
	            'Х'=>'H','Ц'=>'Ts','Ч'=>'CH','Ш'=>'Sh','Щ'=>'Shch','Ъ'=>'','Ы'=>'I','Ь'=>'','Э'=>'E','Ю'=>'Yu','Я'=>'Ya',
	        );

	        $str = strtr($str, $repl);

	        return $str;
		}

    function makeSafe($file) {
        $file = rtrim(translit($file), '.');
        $regex = array('#(\.){2,}#', '#[^A-Za-z0-9\.\_\- ]#', '#^\.#');
        return trim(preg_replace($regex, '', $file));
    }


		$root       = realpath(realpath(dirname(__FILE__).'/../../').'/images/'). DIRECTORY_SEPARATOR;
		$relpath    = isset($_REQUEST['path']) ?  $_REQUEST['path'] : '';
		$action     = isset($_REQUEST['action']) ?  $_REQUEST['action'] : 'items';
		$target     = isset($_REQUEST['target']) ?  $_REQUEST['target'] : '';
		//$foldername = isset($_REQUEST['name']) ?  $_REQUEST['name'] : '';

		// always check whether we are below the root category is not reached
		$path = $root;
		if (realpath($root.$relpath) && strpos(realpath($root.$relpath), $root) !== false) {
		    $path = realpath($root.$relpath).DIRECTORY_SEPARATOR;
		}

		$result = (object)array('error'=> 0, 'msg'=>array(), 'files'=> array(), 'path' => str_replace($root, '', $path));

		function warning_handler($errno, $errstr) {
		    global $result;
		    $result->error = $errno;
		    $result->msg = $errstr;
		    exit(json_encode($result));
		}

		set_error_handler('warning_handler', E_ALL);

		if (!$path) {
		   trigger_error('Need Path', E_USER_WARNING);
		}

		switch ($action) {
		    case 'items':
				$rooturl ='../images/';
				$dir = opendir($path);
				while ($file = readdir($dir)) {
		        if (is_file($path.$file) && preg_match('#\.(png|jpg|jpeg|jpg|gif)$#i', $file)) {
		            $result->files[] = $file;
		        }
		    }
			break;
		    case 'folder':
				$result->files[] = $path == $root ? '.' : '..';
				$dir = opendir($path);
				while ($file = readdir($dir)) {
					if ($file != '.' && $file != '..' && is_dir($path.$file)) {
						$result->files[] = $file;
					}
				}
			break;
			case 'remove':
				$imgs = realpath($path.$target);
				$dir = opendir($path);
				while ($file = readdir($dir)) {
					if ($file == $target && unlink($imgs) && is_dir($path.$file)) {
						$result->files[] = $file;
					}
				}
			break;
			case 'create':
				$foldername = makeSafe(isset($_REQUEST['name']) ?  $_REQUEST['name'] : '');
				$folder = realpath($path.$foldername);
				$dir = opendir($path);
				while ($file = readdir($dir)) {
					//if (is_dir($path.$foldername)) {
					if (!realpath($path.$foldername)) {
					mkdir($path.$foldername, 0777);
					$result->files[] = $file;
					$result->msg = 'Directory was created';
					}
				}
			break;
		    //...
		}

		exit(json_encode($result));
	}


}
?>
