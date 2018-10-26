<?php
/**
 * Common functions
 *
 * PHP Version 5.6
 *
 * @category Education
 * @package  PHPify
 * @author   kimfucious <code@abts.io>
 * @license  https://www.gnu.org/licenses/gpl-3.0.txt GNU General Public License v3
 * @link     https://github.com/kimfucious/phpify.git
 */

/**
 * Partial cleaning helper function for displaying strings
 * Strips out nasty characters, leaves spaces
 *
 * @param string $str is to be cleaned and returned
 *
 * @return string
 */
function quasiClean($str)
{
    $str = preg_replace("/[^a-zA-Z ]/", "", $str);
    return $str;
}

/**
 * Sets the field-group values (globally) for danger
 *
 * @param string $msg is the message to display on the form field helper text
 *
 * @return void
 */
function setFormDanger($msg)
{
    global $hideHelperText,
    $feedbackClass,
    $formGroupClass,
    $formFieldClass,
        $fieldMessage;

    $hideHelperText = true;
    $feedbackClass = "invalid-feedback";
    $formGroupClass = "has-danger";
    $formFieldClass = "is-invalid";
    $fieldMessage = $msg;
}

/**
 * Sets the field-group values (globally) for success
 *
 * @param string $msg message to display on the form field helper text
 *
 * @return void
 */
function setFormSuccess($msg)
{
    global
    $hideHelperText,
    $feedbackClass,
    $formGroupClass,
    $formFieldClass,
        $fieldMessage;

    $hideHelperText = true;
    $feedbackClass = "valid-feedback";
    $formGroupClass = "has-success";
    $formFieldClass = "is-valid";
    $fieldMessage = $msg;
}

if (array_key_exists("reset", $_POST)) {
    $_POST = array();
}
