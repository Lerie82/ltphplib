<?php
/*
filename: FileOps.class.php
author: Lerie Taylor
date: 2021
*/
class FileOps
{
	function readUTF8File($file)
	{
		$handle = fopen($filename, "r");
		$contents = utf8_decode(fread($handle, filesize($filename)));
		fclose($handle);
		return $contents;
	}

	function getFile($file)
	{
		$handle = fopen($filename, "r");
		$contents = fread($handle, filesize($filename));
		fclose($handle);
		return $contents;
	}

	function bin2Hex($file)
	{
	    $handle = @fopen($file);
	    $hex = "";
	    
	    if($handle)
	    {
	        while(!feof($handle))
	        {
	            $hex .= bin2hex(fread($handle, 4));
	        }
	        fclose($handle);
	    }

	    return $hex;
	}
}
?>