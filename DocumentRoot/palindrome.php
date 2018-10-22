<?php
/**
 * Simple exercise to demonstrate how to detect palindromes with PHP
 *
 * PHP version 7.2
 *
 * Directions
 * Given a string, return true if the string is a palindrome
 * or false if it is not.  Palindromes are strings that
 * form the same word if it is reversed. *Do* include spaces
 * and punctuation in determining if the string is a palindrome.
 *
 * Examples:
 * palindrome("abba") === true
 * palindrome("abcdefg") === false
 *
 * @category Education
 * @package  Palindromify
 * @author   kimfucious <code@abts.io>
 * @license  https://www.gnu.org/licenses/gpl-3.0.txt GNU General Public License v3
 * @link     https://github.com/kimfucious/phpify.git
 */

session_start();
$_SESSION["page"] = "Palindrome";
require_once "includes/common_functions.php";

/**
 * String cleaning helper function
 *
 * @param string $str is to be cleaned and returned
 *
 * @return string
 */
function cleanString($str)
{
    return strtolower(preg_replace("/[\W]/", "", $str));
}

if (filter_has_var(INPUT_POST, "submit")) {
    $str1 = cleanString($_POST["string1"]);
    $missingFieldMessage = "";
    if (!empty($str1)) {
        if ($str1 === strrev($str1)) {
            $msg = '"' . quasiClean($_POST["string1"]) . '"'
                . " is a palindrome.";
            setFormSuccess($msg);
        } else {
            $msg = '"' . quasiClean($_POST["string1"]) . '"'
                . " is not a palindrome.";
            setFormDanger($msg);
        }
    } else {
        $missingFieldMessage = "Please enter something in the field.";
    }
}

?>
<?php require_once "includes/header.php"?>
<?php require_once "includes/breadcrumbs.php"?>
  <div class="container d-flex flex-column mt-3">
  <h1 class="display-4 text-center">Palindromify</h1>
  <form action="<?php echo $_SERVER["PHP_SELF"] ?>"
        class="mb-3"
        method="POST"
        style="min-width: 300px;"
        >
    <div class="form-group <?php echo $formGroupClass ?>">
      <label class="form-control-label text-info" for="string1">Potential Palindrome</label>
      <input
        class="form-control transparent-input <?php echo $formFieldClass ?>"
        type="text"
        name="string1"
        placeholder="Able was I ere I saw Elba."
        value="<?php echo isset($_POST["string1"]) ? quasiClean($_POST["string1"]) : "" ?>"
      />
      <div class="<?php echo $feedbackClass ?>"><?php echo $fieldMessage ?></div>
        <?php if (!$hideHelperText): ?>
          <small
          class="form-text text-muted">
          Enter your potential palindrome here.  Anything not text will be ignored.
          </small>
        <?php endif;?>
    </div>
    <br />
      <button
        class="btn btn-block btn-outline-info border border-info"
        name="submit"
        type="submit">
        CHECK FOR PALINDROME
        </button>
        <button
          class="btn btn-block btn-outline-secondary border border-secondary"
          name="reset"
          type="submit">
          RESET INPUT
        </button>
    <?php if ($missingFieldMessage !== "" && filter_has_var(INPUT_POST, "submit")): ?>
      <div class="alert alert-danger mt-3">
        <?php echo $missingFieldMessage; ?>
      </div>
    <?php endif;?>
    </div>
  </form>
<?php require_once "includes/footer.php"?>
