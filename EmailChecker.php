<?php

class ValidateDomainEmail {

    private $list_domains = array(
        "yahoo", "hotmail", "gmail", "live", "outlook", "msn", "globo", "uol"
    );
    public $precision = 70;

    private function explodeEmail($email){
        $d = explode('@', $email);
        $name = $d[0];
        $e = explode('.', $d[1]);
        $domain = $e[0];
        $final = $e[1];
        if($e[2]){ $final .= ".".$e[2]; }
        if($e[3]){ $final .= ".".$e[3]; }

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

        foreach ($this->list_domains as $domain) {
            similar_text($domain_email, $domain, $percent);
            if($percent > $this->precision) {
                if($domain == "gmail") {
                    $email = $name_email."@".$domain.".com";
                } else {
                    $email = $name_email."@".$domain.".".$final_email;
                }
                break;
            }
        }
        return $email;
    }

    public function print_table($email) {

        $str .= "<table style='border-collapse: collapse; margin: 0px auto;'>";
        $str .= "<tr><td style='border: 1px solid #ccc; padding: 10px;' COLSPAN=2> <b>Precisão de ".$this->precision."% </b></td></tr>";
        $d = $this->explodeEmail($email);

        $name_email = $d['name'];
        $domain_email = $d['domain'];
        $final_email = $d['final'];

        foreach ($this->list_domains as $domain) {
            similar_text($domain_email, $domain, $percent);
            if($percent > $this->precision) {
                $str .= "<tr style='background:#8BC34A;'><td style='border: 1px solid #ccc; padding: 10px;'>".$domain."</td><td style='border: 1px solid #ccc; padding: 10px;'>".$percent."% </td></tr>";
            } else {
                $str .= "<tr><td style='border: 1px solid #ccc; padding: 10px;'>".$domain."</td><td style='border: 1px solid #ccc; padding: 10px;'>".$percent."% </td></tr>";
            }
        }

        $str .= "</table>";

        return $str;
    }

    public function array_table($email) {
        $result = array();
        $d = $this->explodeEmail($email);

        $name_email = $d['name'];
        $domain_email = $d['domain'];
        $final_email = $d['final'];

        foreach ($this->list_domains as $domain) {
            similar_text($domain_email, $domain, $percent);
            $result[$domain] = $percent."%";
        }
        return $result;
    }


}

?>