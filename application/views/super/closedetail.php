<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
        <link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

        <title>Rodada</title>

        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <meta name="viewport" content="width=device-width" />
        <link href="<?= base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet" />
        <link href="<?= base_url('assets/css/animate.min.css'); ?>" rel="stylesheet"/>
        <link href="<?= base_url('assets/css/paper-dashboard.css'); ?>" rel="stylesheet"/>
        <link href="<?= base_url('assets/css/demo.css'); ?>" rel="stylesheet" />
        <link href="<?= base_url('assets/css/font-awesome.min.css'); ?>" rel="stylesheet">
        <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
        <link href="<?= base_url('assets/css/themify-icons.css'); ?>" rel="stylesheet">

    </head>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="row">
                                <div class="header">
                                    <div class="col-md-12">
                                        <form>
                                            <div class="col-md-9">
                                                <h3>
                                                    <?php 
                                                        if($spn['numteams'] == 0){
                                                            echo "Nenhum time inscrito para a rodada!";
                                                        }
                                                        if($spn['numteams'] == 1){
                                                            echo "1 time inscrito para a rodada!";
                                                        }
                                                        if($spn['numteams'] > 1){
                                                            echo $spn['numteams']." times inscritos para a rodada!";
                                                        }
                                                    ?>
                                                </h3>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="content">
                                <div class="content table-responsive table-full-width">
                                    <table class="table table-hover">
                                        <?php if ($teams) { ?>
                                            <thead>
                                                <th title="Posição">#</th>
                                                <th title="Time">Time</th>
                                                <th title="Cartoleiro">Cartoleiro</th>
                                                <th title="Pontuação">Pontuação</th>
                                            </thead>
                                            <tbody>
                                                <?php $cont = 0;
                                                foreach ($teams as $team) { 
                                                    $cont++;?>
                                                    <tr <?php if($cont < 11) {  ?>
                                                        class="success"
                                                    <?php } ?>>
                                                        <td><?php echo $cont."º" ?></td>
                                                        <td><?php echo $team->ctrkteam ?></td>
                                                        <td><?php echo $team->ctrkcoach ?></td>
                                                        <td><?php echo number_format($team->ctrkaward, 2, '.', '') ?></td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        <?php } ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div><div class="col-md-4">
                        <div class="card">
                            <div class="content">
                                <div class="content table-responsive table-full-width">
                                    <table class="table table-hover">
                                        <?php if ($pc) { ?>
                                            <thead>
                                                <th title="Adm">Adm</th>
                                                <th title="Times adicionados">Add</th>
                                                <th></th>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($users as $user) { ?>
                                                    <tr>
                                                        <td><?php echo $user->nameuser ?></td>
                                                        <td>
                                                            <?php 
                                                                $cont = 0;
                                                                foreach ($balance as $bal) {
                                                                    if($bal->userid == $user->userid){
                                                                        $cont++;
                                                                    }
                                                                }
                                                                echo $cont;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <a href="<?= base_url('spindetail/admview/'.$spin.'-'.$user->userid); ?>" title="Detalhes" class="icon-info" >
                                                                <i class="ti-search"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        <?php } ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--   Core JS Files   -->
        <script src="<?= base_url('assets/js/jquery-1.10.2.js'); ?>" type="text/javascript"></script>
        <script src="<?= base_url('assets/js/bootstrap.min.js'); ?>" type="text/javascript"></script>
        <script src="<?= base_url('assets/js/bootstrap-checkbox-radio.js'); ?>"></script>
        <script src="<?= base_url('assets/js/chartist.min.js'); ?>"></script>
        <script src="<?= base_url('assets/js/bootstrap-notify.js'); ?>"></script>
        <script src="<?= base_url('assets/js/paper-dashboard.js'); ?>"></script>
        <script src="<?= base_url('assets/js/demo.js'); ?>"></script>

</html>
