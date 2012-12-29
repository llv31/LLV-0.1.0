<?php
/**
 * PHP Class Route.php
 * PHP Version 5
 *
 * @category    : default
 * @package     : default
 * @license     : Not for free use
 * @date        : 27/12/12
 * @author      : aroy <contact@aroy.fr>
 */

class Llv_Router_Route
    extends Zend_Controller_Router_Route
{
    /**
     * @param string $path
     * @param bool   $partial
     *
     * @return array|bool|false
     */
    public function match($path, $partial = false)
    {
        $pathStaticCount = 0;
        $values = array();
        $matchedPath = '';

        if (!$partial) {
            $path = trim($path, $this->_urlDelimiter);
        }

        if ($path !== '') {
            $path = explode($this->_urlDelimiter, $path);

            foreach ($path as $pos => $pathPart) {
                // Path is longer than a route, it's not a match
                if (!array_key_exists($pos, $this->_parts)) {
                    if ($partial) {
                        break;
                    } else {
                        return false;
                    }
                }

                $matchedPath .= $pathPart . $this->_urlDelimiter;

                // If it's a wildcard, get the rest of URL as wildcard data and stop matching
                if ($this->_parts[$pos] == '*') {
                    $count = count($path);
                    for ($i = $pos; $i < $count; $i += 2) {
                        $var = urldecode($path[$i]);
                        if (
                            !isset($this->_wildcardData[$var])
                            && !isset($this->_defaults[$var]) && !isset($values[$var])
                        ) {
                            $this->_wildcardData[$var] = (isset($path[$i + 1])) ? urldecode($path[$i + 1]) : null;
                        }
                    }

                    $matchedPath = implode($this->_urlDelimiter, $path);
                    break;
                }

                $name = isset($this->_variables[$pos]) ? $this->_variables[$pos] : null;
                $pathPart = urldecode($pathPart);

                // Translate value if required
                $part = $this->_parts[$pos];
                if (
                    $this->_isTranslated && (substr($part, 0, 1) === '@'
                    && substr($part, 1, 1) !== '@' && $name === null) || $name !== null
                    && in_array($name, $this->_translatable)
                ) {
                    if (substr($part, 0, 1) === '@') {
                        $part = substr($part, 1);
                    }

                    if (($originalPathPart = $this->getTranslator()->getMessageId($pathPart)) !== false) {
                        $pathPart = $originalPathPart;
                    }
                }

                if (substr($part, 0, 2) === '@@') {
                    $part = substr($part, 1);
                }

                // If it's a static part, match directly
                if ($name === null && $part != $pathPart) {
                    return false;
                }

                // If it's a variable with requirement, match a regex. If not - everything matches
                if (
                    $part !== null
                    && !preg_match(
                        $this->_regexDelimiter . '^' . $part . '$' . $this->_regexDelimiter . 'iu', $pathPart
                    )
                ) {
                    return false;
                }

                // If it's a variable store it's value for later
                if ($name !== null) {
                    $values[$name] = $pathPart;
                } else {
                    $pathStaticCount++;
                }
            }
        }

        // Check if all static mappings have been matched
        if ($this->_staticCount != $pathStaticCount) {
            return false;
        }

        $return = $values + $this->_wildcardData + $this->_defaults;

        // Check if all map variables have been initialized
        foreach ($this->_variables as $var) {
            if (!array_key_exists($var, $return)) {
                return false;
            } elseif ($return[$var] == '' || $return[$var] === null) {
                // Empty variable? Replace with the default value.
                $return[$var] = $this->_defaults[$var];
            }
        }

        $this->setMatchedPath(rtrim($matchedPath, $this->_urlDelimiter));

        $this->_values = $values;

        return $return;

    }
}