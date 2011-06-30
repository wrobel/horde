<?php
/**
 * Handles the creation date attribute.
 *
 * PHP version 5
 *
 * @category Kolab
 * @package  Kolab_Format
 * @author   Gunnar Wrobel <wrobel@pardus.de>
 * @license  http://www.fsf.org/copyleft/lgpl.html LGPL
 * @link     http://pear.horde.org/index.php?package=Kolab_Format
 */

/**
 * Handles the creation date attribute.
 *
 * Copyright 2011 The Horde Project (http://www.horde.org/)
 *
 * See the enclosed file COPYING for license information (LGPL). If you did not
 * receive this file, see
 * http://www.gnu.org/licenses/old-licenses/lgpl-2.1.html.
 *
 * @since Horde_Kolab_Format 1.1.0
 *
 * @category Kolab
 * @package  Kolab_Format
 * @author   Gunnar Wrobel <wrobel@pardus.de>
 * @license  http://www.fsf.org/copyleft/lgpl.html LGPL
 * @link     http://pear.horde.org/index.php?package=Kolab_Format
 */
class Horde_Kolab_Format_Xml_Type_CreationDate
extends Horde_Kolab_Format_Xml_Type_AutomaticDate
{
    /**
     * Update the specified attribute.
     *
     * @param string  $name        The name of the the attribute
     *                             to be updated.
     * @param array   $attributes  The data array that holds all
     *                             attribute values.
     * @param DOMNode $parent_node The parent node of the node that
     *                             should be updated.
     * @param array   $params      The parameters for this write operation.
     *
     * @return DOMNode|boolean The new/updated child node or false if this
     *                         failed.
     *
     * @throws Horde_Kolab_Format_Exception If converting the data to XML failed.
     */
    public function save($name, $attributes, $parent_node, $params = array())
    {
        $this->checkParams($params, $name);
        $node = $params['helper']->findNodeRelativeTo(
            './' . $name, $parent_node
        );
        if ($node !== false && isset($attributes[$name])) {
            if (($old = $this->loadNodeValue($node, $params)) != $attributes[$name]) {
                if (!$this->isRelaxed($params)) {
                    throw new Horde_Kolab_Format_Exception(
                        sprintf(
                            'Not attempting to overwrite old %s %s with new value %s!',
                            $name,
                            Horde_Kolab_Format_Date::writeUtcDateTime($old),
                            Horde_Kolab_Format_Date::writeUtcDateTime($attributes[$name])
                        )
                    );
                }
            } else {
                return $node;
            }
        }
        $result = $this->saveNodeValue(
            $name,
            $this->generateWriteValue($name, $attributes, $params),
            $parent_node,
            $params,
            $node
        );
        return ($node !== false) ? $node : $result;
    }

    /**
     * Generate the value that should be written to the node. Override in the
     * extending classes.
     *
     * @param string  $name        The name of the the attribute
     *                             to be updated.
     * @param array   $attributes  The data array that holds all
     *                             attribute values.
     * @param array   $params      The parameters for this write operation.
     *
     * @return mixed The value to be written.
     */
    protected function generateWriteValue($name, $attributes, $params)
    {
        if (isset($attributes[$name])) {
            return Horde_Kolab_Format_Date::writeUtcDateTime(
                $attributes[$name]
            );
        } else {
            return Horde_Kolab_Format_Date::writeUtcDateTime(new DateTime());
        }
    }

}
