<?php

class Settings_model extends CI_Model{

    // replace config items
    public function edit_line($word, $replace) {
      $base_url = $this->config->base_url();
        $reading = fopen(APPPATH.'/config/config_custom.php', 'r');
        $writing = fopen('../application/config/myconf_tmp.php', 'w');

        $replaced = false;

        while (!feof($reading)) {
          $line = fgets($reading);
          if (stristr($line, $word)) {
            $line = "  '$word' => '$replace',\n";
            $replaced = true;
          }
          fputs($writing, $line);
        }
        fclose($reading); fclose($writing);
        // might as well not overwrite the file if we didn't replace anything
        if ($replaced)
        {
          rename($writing, $reading);
        } else {
          unlink($writing);
        }

    }

}