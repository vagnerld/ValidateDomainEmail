<?php

    class ValidateDomainEmail {

        private $list_domains = array(
            "yahoo.com", "yahoo.com.br",
            "hotmail.com", "hotmail.com.br",
            "gmail.com",
            "live.com",
            "outlook.com", "outlook.com.br",
            "msn.com",
            "globo.com",
            "uol.com.br"
        );

        public $precision = 75;

        private function explodeEmail($email){
            $d = explode('@', $email);
            return array(
                        'name'=>$d[0],
                        'domain'=>$d[1]
                    );
        }

        public function check($email) {
            $d = $this->explodeEmail($email);
            $name_email = $d['name'];
            $domain_email = $d['domain'];

            $selected_domains = array();
            foreach ($this->list_domains as $domain) {
                similar_text($domain_email, $domain, $percent);
                if($percent >= $this->precision) {
                    $selected_domains[$domain] = $percent;
                }
            }
            if ($selected_domains) {
                arsort($selected_domains);
                $email = $name_email."@".key($selected_domains);
            } else {
                $email = $name_email."@".$domain_email;
            }
            return $email;
        }

        public function print_table($email) {

            $str .= "<table style='border-collapse: collapse; margin: 0px auto;'>";
            $str .= "<tr><td style='border: 1px solid #ccc; padding: 10px;' COLSPAN=2> <b>Precisão de ".$this->precision."% </b></td></tr>";
            $d = $this->explodeEmail($email);
            $domain_email = $d['domain'];

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

    }

?>