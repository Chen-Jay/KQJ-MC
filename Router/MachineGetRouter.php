<?php
class MachineGetRouter extends Router
{
    public function handle()
    {
        $this->route(NULL);
    }

    protected function route($json)
    {
        $getController=new GetController();
        $getController->handle();
    }
}