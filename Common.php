    <?php

    function generate_rid()
    {
        $last=Model::orderby('id','desc')->first('r_id');
        if($last)
        {
        $r_id= (int) filter_var($last->r_id, FILTER_SANITIZE_NUMBER_INT);
        $r_id= abs($r_id);
        $r_id=sprintf('%08d', $r_id+1);
        }
        else
        {
           $r_id=sprintf('%08d', 0);
        }

        $prefix="PIC-";
        return $prefix.$r_id;
    }