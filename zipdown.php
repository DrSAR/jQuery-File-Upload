<?php

$dirname = $_SERVER['DOCUMENT_ROOT'].$_REQUEST['dir2zip'];
$files = scandir($dirname);
file_put_contents('/tmp/xxx2',$dirname.'  '.implode(' + ',$files));
$zip = new ZipArchive;
$zipfilename = tempnam("tmp", "zip");
$res = $zip->open($zipfilename, ZipArchive::CREATE);
$problem=0;
if ($res === TRUE) {
    foreach ($files as $file) {
        $chosen_file = $dirname. DIRECTORY_SEPARATOR .$file;
        if (is_file($chosen_file)){
            if (! $zip->addFile($chosen_file, 
                basename($dirname).DIRECTORY_SEPARATOR.$file)){
                    $problem += 1;
                    echo "could not zip ".$file.'<br/>';
                }
        }
    }
    $zip->close();
} else {
    echo 'failed, code:' . $res;
}

if ($problem > 0){
    echo '<br\>We had problems. Maybe permission problems?';
}
else {
    header('Content-Type: application/zip');
    header('Content-disposition: attachment; filename=file.zip');
    header('Content-Length: ' . filesize($zipfilename));
    readfile($zipfilename);
    //unlink($zipfilename);
}
?>

