<?php
    include ('ConexaoBD.php')

?>

<!DOCTYPE html>
<html >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Agendar Salão</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php
        $mes = date('n',time()); // retorna Mês
        $ano = date('Y',time()); // retorna o ANO;
        if($mes > 12)
            $mes = 12;
        if($mes < 1)
            $mes =1;

            $numeroDias = cal_days_in_month(CAL_GREGORIAN,$mes,$ano); //retorna total de dias do Mês
            
            $diaInicialdoMes = date('N', strtotime("$ano-$mes-01")); // Iniciando cada Mês
            
            
            
            $diaDeHoje = date('d',time());//variavel para pegar o dia de hoje
            $diaDeHoje = "$ano-$mes-$diaDeHoje"; //formatando o Data
            
          

            $meses = array('Janeiro', 'Fevereiro','Março','Abril','Maio', 'Junho', 'Julho','Agosto','Setembro','Outubro','Novembro','Dezembro');
            $nomeMes = $meses[(int)$mes-1]; // relacionando o Mes com o Nome do Mes
        ?>
    <div class="container">
    <table class="calendario-table">
        <h2>Calendário e Agenda | <u> <?php echo $nomeMes; ?>/<?php echo $ano;?></u></h2>
        <tr>
        <td>Domingo</td>
        <td>Segunda</td>
        <td>Terça</td>
        <td>Quarta</td>
        <td>Quinta</td>
        <td>Sexta</td>
        <td>Sábado</td>
        </tr>
        <?php
        $n = 1;
        $z = 0;
        $numeroDias+=$diaInicialdoMes;
        while ($n <= $numeroDias){
               
            if($n % 7 == 1){
                echo '<tr>';
            }
            if ($z >= $diaInicialdoMes) {
                $dia = $n - $diaInicialdoMes;
                if($dia < 10){
                    $dia = str_pad($dia, strlen($dia)+1,"0",STR_PAD_LEFT);
                }
                $atual = "$ano-$mes-$dia"; //
                if ($atual != $diaDeHoje) {
                    echo "<td dia=\"$atual\">$dia</td>";
                }else{
                    echo '<td dia="'.$atual.'"class="data-select">'.$dia.'</td>';
                }
                
            }else{
                echo "<td></td>";
                $z++;
            }
            if ($n % 7 ==0) {
                echo '</tr>';
                
            }
            $n++;
        }
        
        ?>
    </table>
    
    <form action ="calendario.php" method=post >

    <h2>Adicionar Tarefa</h2>
    <input type="text" name="nguerra" placeholder="Digite seu Nome de Guerra "/>
    <input type="text" name="bloco"/>
    <input type="text" name="apt"/>
    <input type="text" name="evento"/>
    <input type="hidden" name="data" value="<?php echo $diaDeHoje ?>">
    <input type="submit" name="acao" value="Cadastrar">

    
           
    <div class="eventos-agendados">
        <div class="card-title">
        Eventos de <?php echo date('d/m/Y',time());?>
        </div><!--card-title-->
        
        <?php 
              $tarefa = Mysql::conectar()->prepare("SELECT * FROM `tb_agenda` WHERE data = '$diaDeHoje'");
              $tarefa->execute();
              $tarefa = $tarefa->fetchAll();
              foreach ($tarefa as $key => $value) {
                ?>  
            <div class="evento">
            <a <h2><?php echo $value['evento'];?></a>
            </div>  
            <?php }?>
        
    </div><!--eventos-agendados-->
    </form>
</body>
</html>
<script
  src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script>
    $(function(){
            $('td[dia]').click(function(){
                $('td').removeClass('data-select');
                $(this).addClass('data-select');
                var novoDia = $(this).attr('dia').split('-');
               var novoDia = novoDia[2]+'/'+novoDia[1]+'/'+novoDia[0];               
                trocarDatas($(this).attr('dia'),novoDia);
                buscarEvento($(this).attr('dia'));
            })
        
                          
            
         function trocarDatas(nformatado,formatado){
        $('input[type=hidden]').attr('value',nformatado);
        $('form .card-title').html('Adicionar Evento para:'+ formatado);
        } 
        
    
        
        
        
        function buscarEvento(data){
            $('.evento').remove();
              (function(data){
                    $('.eventos-agendados .evento ').after(data);
                })
        }
    })
    
</script>
    </div><!--container-->
   