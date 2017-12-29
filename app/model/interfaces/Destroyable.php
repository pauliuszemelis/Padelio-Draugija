<?php

namespace app\model\interfaces;


interface Destroyable
{
    public function destroy ();

    public function delete ($id);
}