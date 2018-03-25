<?php
class MachineController extends Controller
{
    public function handle()
    {
        global $json;
        $machine=new MachineModel();
        $machine->setSerial_number($_GET['sn']);
        $space=$json['space'];
        $user=$json['user'];
        $fingerprint=$json['fingerprint'];
        $machine->updateMachine($space,$user,$fingerprint);
    }
}