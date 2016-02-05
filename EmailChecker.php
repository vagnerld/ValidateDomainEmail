<?php

class ValidateDomainEmail {

    private $domains_list = array(
        "yahoo", "hotmail", "gmail", "live", "outlook", "msn", "globo", "uol"
    );

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

        foreach ($this->domains_list as $domain) {
            similar_text($domain_email, $domain, $percent);
            if($percent > 75) {
                $email = $name_email."@".$domain.".".$final_email;
                break;
            }
        }
        return $email;
    }

    public function print_table($email) {

        echo "<table style='border-collapse: collapse; margin: 0px auto;'>";

        $d = $this->explodeEmail($email);

        $name_email = $d['name'];
        $domain_email = $d['domain'];
        $final_email = $d['final'];

        foreach ($this->domains_list as $domain) {
            similar_text($domain_email, $domain, $percent);
            if($percent > 75) {
                echo "<tr style='background:#8BC34A;'><td style='border: 1px solid #ccc; padding: 10px;'>".$domain."</td><td style='border: 1px solid #ccc; padding: 10px;'>".$percent."% </td></tr>";
            } else {
                echo "<tr><td style='border: 1px solid #ccc; padding: 10px;'>".$domain."</td><td style='border: 1px solid #ccc; padding: 10px;'>".$percent."% </td></tr>";
            }
        }

        echo "</table>";

    }

}

?>