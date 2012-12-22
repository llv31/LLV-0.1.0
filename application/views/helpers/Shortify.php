<?php
/**
 * PHP Class azerty.php
 * PHP Version 5
 *
 * @category    : default
 * @package     : default
 * @license     : Not for free use
 * @date        : 15/12/12
 * @author      : aroy <contact@aroy.fr>
 */

class App_View_Helper_Shortify
    extends Zend_View_Helper_Abstract
{
    /**
     * @param     $pStr
     * @param int $pMaxLen
     *
     * @return string
     */
    public function shortify($pStr, $pMaxLen = 40)
    {
        // filter all the tags
        $filter = new Zend_Filter_StripTags();
        $pStr = trim($filter->filter($pStr));
        $returnStr = $this->cutstr($pStr, $pMaxLen, '…');
        return $returnStr;
    }

    /**
     * @param        $string
     * @param        $length
     * @param string $dot
     * @param string $encoding
     *
     * @return string
     */
    private function cutstr($string, $length, $dot = '', $encoding = 'utf8')
    {
        if (strlen($string) <= $length) {
            return $string;
        }

        $strcut = '';
        if (strtolower($encoding) == 'utf8') {
            $n = $tn = $noc = 0;
            while ($n < strlen($string)) {
                $t = ord($string[$n]);
                if ($t == 9 || $t == 10 || (32 <= $t && $t <= 126)) {
                    $tn = 1;
                    $n++;
                    $noc++;
                } elseif (194 <= $t && $t <= 223) {
                    $tn = 2;
                    $n += 2;
                    $noc += 2;
                } elseif (224 <= $t && $t < 239) {
                    $tn = 3;
                    $n += 3;
                    $noc += 2;
                } elseif (240 <= $t && $t <= 247) {
                    $tn = 4;
                    $n += 4;
                    $noc += 2;
                } elseif (248 <= $t && $t <= 251) {
                    $tn = 5;
                    $n += 5;
                    $noc += 2;
                } elseif ($t == 252 || $t == 253) {
                    $tn = 6;
                    $n += 6;
                    $noc += 2;
                } else {
                    $n++;
                }
                if ($noc >= $length) {
                    break;
                }
            }
            if ($noc > $length) {
                $n -= $tn;
            }
            $strcut = substr($string, 0, $n);
        } else {
            for ($i = 0; $i < $length - strlen($dot) - 1; $i++) {
                if (ord($string[$i]) > 127) {
                    $strcut .= $string[$i] . $string[++$i];
                } else {
                    $strcut .= $string[$i];
                }
            }
        }

        return $strcut . $dot;
    }
}