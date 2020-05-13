<?php
ob_start();
function video ($sala, $pagina){
    include('conexao.php');
    $cmd = "SELECT * FROM videos WHERE sala = '$sala'"; 
    $result = mysqli_query($conn, $cmd);
    $total = mysqli_num_rows($result);
    $registros = 1;
    $numPaginas = ceil($total/$registros);?>
    <div class=" collapse navbar-collapse navbar navbar-dark bg-secondary" id="navbarSupportedContent"><?php
    for($i = 1; $i < $numPaginas + 1; $i++) {
        ?>
        
        <div class='btn-group-vertical '
            ><button type='button' class='btn btn-info '>
                <a class='nav-link text-decoration-none text-reset pb-1' href='<?php echo$sala;?>.php?pagina=<?php echo$i;?>'><?php echo $i;?></a></button>
        </div>
    <?php }?>
    </div>

    <?php
    $cmd = "SELECT * FROM videos WHERE sala = '$sala' AND num_fila = $pagina";
    $produto = mysqli_query($conn, $cmd);
    while ($row = mysqli_fetch_array($produto)){
            ?><div class="container-fluid mx-auto mt-4 mb-4" id="ytplayer"> <script>
            var tag = document.createElement('script');
            tag.src = "https://www.youtube.com/player_api";
            var firstScriptTag = document.getElementsByTagName('script')[0];
            firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
            var player;
            function onYouTubePlayerAPIReady() {
                player = new YT.Player('ytplayer', {
                height: '621px',
                width: '100%',
                videoId: '<?php echo$row['link'];?>'
                });
            }
            </script>
            </div>
    <?php 
    return($produto);    
    }
}

function msg_sistem ($msg){
        echo "<div class='alert alert-danger' role='alert'>";
        echo$msg;
        echo"</div>";
        }     
ob_end_flush();