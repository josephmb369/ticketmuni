<?php if($_SESSION['nombre']!="" && $_SESSION['tipo']=="admin"){ 

/* Guardar nuevo admin */
if(isset($_POST['nom_admin_reg']) && isset($_POST['admin_reg']) && isset($_POST['admin_clave_reg'])){

    $nom_complete_save=MysqlQuery::RequestPost('nom_admin_reg');
    $nom_admin_save=MysqlQuery::RequestPost('admin_reg');
    $pass_save=md5(MysqlQuery::RequestPost('admin_clave_reg'));
    $email_save=MysqlQuery::RequestPost('admin_email_reg');
    $cargo_save=MysqlQuery::RequestPost('admin_cargo_reg');

   if(MysqlQuery::Guardar("administrador", "nombre_completo, nombre_admin, clave, email_admin,cargo", "'$nom_complete_save', '$nom_admin_save', '$pass_save', '$email_save','$cargo_save'")){
       echo '
            <div class="alert alert-info alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="text-center">ADMINISTRADOR REGISTRADO</h4>
                <p class="text-center">
                    El administrador se registro con exito en el sistema
                </p>
            </div>
        ';
   }else{
       echo '
            <div class="alert alert-info alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="text-center">ADMINISTRADOR REGISTRADO</h4>
                <p class="text-center">
                    El administrador se registro con exito en el sistema
                </p>
            </div>
        ';
   } 
}


    
    
   /* Actualizar cuenta admin */
    
    if(isset($_POST['nom_admin_up']) && isset($_POST['admin_up']) && isset($_POST['old_nom_admin_up'])){
        $nom_complete_update=MysqlQuery::RequestPost('nom_admin_up');
        $nom_admin_update=MysqlQuery::RequestPost('admin_up');
        $old_nom_admin_update=MysqlQuery::RequestPost('old_nom_admin_up');
        $pass_admin_update=md5(MysqlQuery::RequestPost('admin_clave_up'));
        $old_pass_admin_uptade=md5(MysqlQuery::RequestPost('old_admin_clave_up'));
        $email_admin_update=MysqlQuery::RequestPost('admin_email_up');

        $sql=Mysql::consulta("SELECT * FROM tecnico WHERE id_tecnico=".$_GET['id']);
        if(mysqli_num_rows($sql)>=1){
          try{
            //if(MysqlQuery::Actualizar("tecnico", "nombres_tecnico='$nom_complete_update', nombre_tecnico='$nom_admin_update', clave='$pass_admin_update', email_tecnico='$email_admin_update'")){
              if(Mysql::consulta("UPDATE tecnico SET nombres_tecnico='$nom_complete_update', nombre_tecnico='$nom_admin_update', clave='$pass_admin_update', email_tecnico='$email_admin_update'  WHERE id_tecnico=".$_GET['id'])){
                echo '
                    <div class="alert alert-info alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <h4 class="text-center">ADMINISTRADOR ACTUALIZADO</h4>
                        <p class="text-center">
                            El administrador se actualizo con exito
                        </p>
                    </div>
                ';
              
              
            }else{
                echo '
                    <div class="alert alert-danger alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <h4 class="text-center">OCURRIÓ UN ERROR</h4>
                        <p class="text-center">
                            No hemos podido actualizar el administrador
                        </p>
                    </div>
                ';
            }
          }
          catch( Exception $e){
            echo var_dump($e);
          }
        }else{
            echo '
                <div class="alert alert-danger alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="text-center">OCURRIÓ UN ERROR</h4>
                    <p class="text-center">
                        Usuario y clave incorrectos
                    </p>
                </div>
            ';
       }
    }
    
    /*Script para eliminar cuenta*/
     if(isset($_POST['nom_admin_delete']) && isset($_POST['admin_clave__delete'])){
         $nom_admin_delete=MysqlQuery::RequestPost('nom_admin_delete');
         $clave_admin_delete=md5(MysqlQuery::RequestPost('admin_clave__delete'));
         $sql=Mysql::consulta("SELECT * FROM administrador WHERE nombre_admin= '$nom_admin_delete' AND clave='$clave_admin_delete'");
         if(mysqli_num_rows($sql)>=1){
            if(MysqlQuery::Eliminar("administrador", "nombre_admin='$nom_admin_delete' and clave='$clave_admin_delete'")){
                echo '<script type="text/javascript"> window.location="eliminar.php"; </script>';
            }else{
                echo '
                    <div class="alert alert-danger alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <h4 class="text-center">OCURRIÓ UN ERROR</h4>
                        <p class="text-center">
                            No hemos podido eliminar el administrador
                        </p>
                    </div>
                ';
            }
         }else{
            echo '
                <div class="alert alert-danger alert-dismissible fade in col-sm-3 animated bounceInDown" role="alert" style="position:fixed; top:70px; right:10px; z-index:10;"> 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="text-center">OCURRIÓ UN ERROR</h4>
                    <p class="text-center">
                        Usuario y clave incorrectos
                    </p>
                </div>
            ';
         }
     }
    ?>
    <div class="container">
      <br><br>        
      
      <div class="flex">
          <div class="col-sm-8">
              <div class="row">
                  <div class="col-sm-12">
                    <div class="panel panel-info">
                     <div class="panel-heading text-center"><i class="fa fa-refresh"></i>&nbsp;<strong>Actualizar datos de cuenta</strong></div>
                     <div class="panel-body">
                        <?php
                            $idad=$_GET['id'];
                            $sql1=Mysql::consulta("SELECT * FROM tecnico WHERE id_tecnico=".$_GET['id']);
                            $reg1=mysqli_fetch_array($sql1, MYSQLI_ASSOC);
                            
                        ?>
                         <form role="form" action="" method="POST">
                         <div class="form-group">
                           <label><i class="fa fa-male"></i>&nbsp;Nombre completo</label>
                           <input type="text" class="form-control" value="<?php echo $reg1['nombres_tecnico']; ?>" name="nom_admin_up" placeholder="Nombre completo" title="Nombre Apellido" maxlength="40">
                         </div>
                         <div class="form-group">
                           <label><i class="fa fa-user"></i>&nbsp;Nombre de administrador anterior</label>
                           <input type="text" class="form-control" value="<?php echo $reg1['nombre_tecnico']; ?>" name="old_nom_admin_up" placeholder="Nombre anterior de administrador" title="Ejemplo7 maximo 15 caracteres" maxlength="15">
                         </div>
                         <div class="form-group has-success has-feedback">
                           <label class="control-label"><i class="fa fa-user"></i>&nbsp;Nuevo nombre de administrador</label>
                           <input type="text" id="input_user2" class="form-control" name="admin_up" placeholder="Nombre de administrador" pattern="[a-zA-Z0-9]{1,15}" title="Ejemplo7 maximo 15 caracteres" maxlength="15">
                           <div id="com_form2"></div>
                         </div>
                         <div class="form-group">
                           <label><i class="fa fa-shield"></i>&nbsp;Contraseña anterior</label>
                           <input type="password" class="form-control" name="old_admin_clave_up" placeholder="Contraseña anterior" required="">
                         </div>
                             <div class="form-group">
                           <label><i class="fa fa-shield"></i>&nbsp;Nueva contraseña</label>
                           <input type="password" class="form-control" name="admin_clave_up" placeholder="Nueva contraseña">
                         </div>
                         <div class="form-group">
                           <label><i class="fa fa-envelope"></i>&nbsp;Email</label>
                           <input type="email" class="form-control" value="<?php echo $reg1['email_tecnico']; ?>" name="admin_email_up"  placeholder="Email administrador" required="">
                         </div><button type="submit" class="btn btn-info">Actualizar datos</button>
                       </form>
                     </div>
                   </div>
                   </div>
              </div><!--Fin row-->
          </div><!--Fin class col-md-4-->
      </div><!-- Fin row-->
      
    </div>
<?php
}else{
?>
<div class="container">
    <div class="row">
        <div class="col-sm-4">
            <img src="./img/Stop.png" alt="Image" class="img-responsive animated slideInDown"/><br>
            <img src="./img/SadTux.png" alt="Image" class="img-responsive"/>
            
        </div>
        <div class="col-sm-7 animated flip">
            <h1 class="text-danger">Lo sentimos esta página es solamente para administradores de LinuxStore</h1>
            <h3 class="text-info text-center">Inicia sesión como administrador para poder acceder</h3>
        </div>
        <div class="col-sm-1">&nbsp;</div>
    </div>
</div>
<?php
}
?>