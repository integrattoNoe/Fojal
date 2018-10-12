<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="<?= base_url() ?>assets/jquery/dist/jquery.min.js"></script>
    <script src="<?= base_url() ?>assets/bootstrap/dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="<?= base_url() ?>assets/bootstrap/dist/css/bootstrap.css">
</head>
<body>
    <h1>Hola mundo prueba</h1>
    <?= $this->session->userdata["logged_in"]["usuario"];?>

</body>
</html>