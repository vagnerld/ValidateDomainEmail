<?php

class ValidateDomainEmail {

    private $domains_default = array(
        "yahoo", "hotmail", "gmail", "live", "outlook", "msn"
    );

    private function explodeEmail($email){
       $d = explode('@', $email);
        $name = $d[0];
        $e = explode('.', $d[1]);
        $domain = $e[0];
        $final = $e[1];
        if($e[2]){ $final .= ".".$e[2]; }
    
        return array(
                    'name'=>$name,
                    'domain'=>$domain,
                    'final'=>$final
                );
    }

    public function check($email) {
        $d = $this->explodeEmail($email);

        $name_email = $d['name'];
        $domain_email = $d['domain'];
        $final_email = $d['final'];

        foreach ($this->domains_default as $key => $value) {
            similar_text($domain_email, $value, $percent);
            echo $value.": ".$percent."%<br />";
            if($percent > 75) {
                $email = $name_email."@".$value.".".$final_email;
                //break;
            }
        }

        return $email;
    }
}

?>