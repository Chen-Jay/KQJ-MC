<?php
class MachineController extends Controller
{
    public function handle()
    {
        global $json;
        $machine=new MachineModel();
        $machine->setSerial_number($_GET['sn']);
        $model=$json['model'];
        $space=$json['space'];
        $user=$json['user'];
        $fingerprint=$json['fingerprint'];
        $machine->updateMachine($model,$space,$user,$fingerprint);
        echo 'ok';

    }
}