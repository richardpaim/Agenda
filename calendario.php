
<?php
include ('ConexaoBD.php');
        if(isset($_POST['acao'])){
            $nguerra = $_POST['nguerra'];
            $bloco = $_POST['bloco'];
            $apt = $_POST['apt'];
            $evento = $_POST['evento'];
            $date = $_POST['data'];
            $sql = Mysql::conectar()->prepare("INSERT INTO `tb_agenda` VALUES (null,?,?,?,?,?)");
            $sql->execute(array($nguerra,$bloco,$apt,$evento,$date));
        }else if(isset($_POST['acao']) && $_POST['acao'] == 'puxar'){
            $data = $_POST['data'];
            $sql = MySql::conectar()->prepare("SELECT * FROM `tb_agenda` WHERE data = '$data' ORDER BY id ASC");
            $sql->execute();
            $info = $sql->fetchAll();
            $box = "";
            foreach ($info as $key => $value2) {
                /*
            <div class="box-tarefas-single">
                <h2><i class="fa fa-pencil"></i> <?php echo $value['tarefa']; ?></h2>
            </div>
            */
                $box.='<div class="eventos-agendados">';
                $box.='<h2>'.$value2['evento'].'</h2>';
                $box.="</div>";
            }
            die($box);
        }
    ?>