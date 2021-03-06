<?php

###################################################################
# découpe un fichier contenant des génome en plusieur sous fichier ou les génome sont réunis par groupe et les met dans le dossier allGenomes/
# @path chemin vers le fichier
###################################################################
function fromArrayToFiles($path)
{
	
    	$file ="";
    	$handle = fopen($path , "r") or die("Couldn't get handle");
    	if ($handle) 
        {
        while (!feof($handle)) 
            {
                $buffer = fgets($handle, 4096);
                if (strpos($buffer , ">") !== FALSE) 
                {
                	$arrayTmp = explode(" ", $buffer);
                	$file = fopen("allGenomes/".$arrayTmp[1].".fasta", "a+") ;
                }
                fputs($file,$buffer);
            }
            fclose($handle);
        }
} #fin de fonction fromArrayToFiles

###################################################################
# découpe un fichier contenant des génome en plusieur sous fichier qui contient une seul et unique chaine fasta
# @path chemin vers le fichier
###################################################################
function fromAllGenomeToPalindromeFile($path)
{
    
    $file ="";
    $filleAllGenomes = fopen($path , "r") or die("File not found");
    if ($filleAllGenomes) 
    {
        while (!feof($filleAllGenomes)) 
        {
            $buffer = fgets($filleAllGenomes, 4096);
            if (strpos($buffer , ">") !== FALSE) 
            {
                $arrayTmp = explode(" ", $buffer);
                $arrayTmp2 = explode(">", $arrayTmp[0]);                
                $nameFile = $arrayTmp[1];
                for ($i=2; $i < count($arrayTmp) ; $i++) 
                { 
                    $nameFile .= " ".$arrayTmp[$i];
                }
                $nameFile = substr($nameFile, 0 , strlen($nameFile)-1);
                $nameFile = $nameFile.".fasta" ;
                echo $nameFile;
                echo "\n";
                $nameFile = mb_ereg_replace("([^\w\s\d\-_~,;\[\]\(\).])", '', $nameFile);
                $file = fopen("allGenomes/".$nameFile, "a+") ;
            }
            fputs($file,$buffer);
            if($file === false)
            {
                echo "probleme false ;";
            }
        }

        fclose($filleAllGenomes);
    }

} # fin de fonction fromAllGenomeToPalindromeFile

fromAllGenomeToPalindromeFile($argv[1]);


?>