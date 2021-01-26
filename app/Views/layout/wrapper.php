<?php
echo view('layout/head.php');
echo view('layout/header.php');
echo view('layout/nav.php');
//echo view('layout/content.php');

$this->renderSection('content');

echo view('layout/footer.php');
