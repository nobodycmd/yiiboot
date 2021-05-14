<?php
//

trait a2{
    public function i(){
        echo 'a2';
    }
}
class a{
    public function i(){
        echo 'a';
    }

    use a2;
}

(new a())->i();