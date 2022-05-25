<?php

declare(strict_types=1);
use Entity\Exception\EntityNotFoundException;
use Entity\Exception\ParameterException;
use Html\AppWebPage;

try {
    $cover = intval($_GET['coverId']);
    if ($cover) {
        header('Content-Type: image/jpeg');
        $web = new \Html\AppWebPage();
        $Cover= new \Entity\Cover();
        $stmt= $Cover->findById($cover);
        echo($stmt->getJpeg());
    } else {
        http_response_code(400);
    }
} catch (EntityNotFoundException) {
    http_response_code(404);
} catch (Exception) {
    http_response_code(500);
}
