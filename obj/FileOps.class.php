<?php
/*
filename: FileOps.class.php
author: Lerie Taylor
date: 2021
*/
class FileOps
{
	///readUTF8File
	///read a file with a UTF-8 charset
	function readUTF8File($file)
	{
		$handle = fopen($filename, "r");
		$contents = utf8_decode(fread($handle, filesize($filename)));
		fclose($handle);
		return $contents;
	}

	///getFileContents
	///return the contents of a file
	function getFileContents($file)
	{
		$handle = fopen($filename, "r");
		$contents = fread($handle, filesize($filename));
		fclose($handle);
		return $contents;
	}

	///bin2hex
	///binary file to hex output
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