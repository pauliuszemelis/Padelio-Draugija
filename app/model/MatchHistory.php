<?php

namespace app\model;

    use app\model\interfaces\Destroyable;
    use app\model\interfaces\Manageable;

class MatchHistory extends CoreModel implements Manageable, Destroyable
{

    protected $table = 'match_history';
    public function create(array $data)
    {

        $query = $this->generateInsertQuery($data, true);
        print_r($this->query($query));

    }

    public function destroy()
    {
        // TODO: Implement destroy() method.
    }
}
