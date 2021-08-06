<?php
echo view('layout/head.php');
echo view('layout/header.php');
if (!session('role')) {
    echo view('layout/nav.php');
} elseif (true) {
    echo view('layout/navAdmin.php');
};

//echo view('layout/content.php');

$this->renderSection('content');

echo view('layout/footer.php');
