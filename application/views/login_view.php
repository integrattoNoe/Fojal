<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if(isset($this->session->userdata["logged_in"])){
    //echo "SI HAY SESSIN";
    header("location: ".base_url()."login");
}else{
    //echo "NO HAY SESSION";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Fojal</title>
    <script src="<?php echo base_url().'assets/jquery/dist/jquery.min.js' ?>"></script>
    <script src="<?php echo base_url().'assets/bootstrap/dist/js/bootstrap.min.js' ?>"></script>
    <link rel="stylesheet" href="<?php echo base_url().'assets/bootstrap/dist/css/bootstrap.css' ?>">

    <script>
        $(document).ready(function(){
            $("#formLogin").on("submit",function(){
                $.ajax({
                    url:base_url,
                    type:"POST",
                    data: {"action":'guardarNuevosDestinos',"nuevos":nuevosDestinos},
                    beforeSend:function(){
                    },
                    success:function(data){
                    },
                    complete:function(){
                    },
                    error: function(x,e){
                        if (x.status==0) {
                            alert('Estás desconectado o se interrumpió la conexión!!\n Por favor verifica tu conexión a Internet.');
                        } else if(x.status==404) {
                            alert('URL no encontrada.');
                        } else if(x.status==500) {
                            alert('Error interno del servidor.');
                        } else if(e=='parsererror') {
                            alert('Error.\nRespuesta incorrecta (JSON).');
                        } else if(e=='timeout'){
                            alert('Se sobrepaso el tiempo de conexión.');
                        } else {
                            alert('Error indefinido.\n'+x.responseText);
                        }
                    }
                });
            });
        });
    </script>
</head>
<body>

    <?php echo form_open("login"); ?>
    <?php
     if(isset($msgError)){
    ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $msgError;?>
        </div>  
    <?php     
     }
     echo validation_errors();
    ?>
        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input name ="correo" type="email" class="form-control" id="correo" aria-describedby="emailHelp" placeholder="Enter email" >
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input name ="pass" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
        </div>
        <button type="submit" class="btn btn-primary">Ingresar</button>
    <!--</form>-->
    <?php echo form_close(); ?>
</body>
</html>