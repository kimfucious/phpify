<?php
/**
 * Simple exercise to demonstrate how to detect anagrams with PHP
 *
 * PHP version 7.2
 *
 * Directions
 * Check to see if two provided strings are anagrams of eachother.
 * One string is an anagram of another if it uses the same characters
 * in the same quantity. Only consider characters, not spaces
 * or punctuation.  Consider capital letters to be the same as lower case
 * --- Examples
 *   anagrams('rail safety', 'fairy tales') --> True
 *   anagrams('RAIL! SAFETY!', 'fairy tales') --> True
 *   anagrams('Hi there', 'Bye there') --> False
 *
 * @category Education
 * @package  Anagramify
 * @author   kimfucious <code@abts.io>
 * @license  https://www.gnu.org/licenses/gpl-3.0.txt GNU General Public License v3
 * @link     https://github.com/kimfucious/phpify.git
 */

session_start();
$_SESSION["page"] = "Anagrams";
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
    $str = strtolower($str);
    $str = preg_replace("/[\W]/", "", $str);
    $str = str_split($str);
    asort($str);
    $str = implode($str);
    return $str;
}

if (filter_has_var(INPUT_POST, "submit")) {
    $str1 = cleanString($_POST["string1"]);
    $str2 = cleanString($_POST["string2"]);
    $missingFieldMessage = "";
    if (!empty($str1) && !empty($str2)) {
        if ($str1 === $str2) {
            $msg = '"' . quasiClean($_POST["string1"]) . '"' .
            " is an anagram of " .
            '"' . quasiClean($_POST["string2"]) . '"';
            setFormSuccess($msg);
        } else {
            $msg = '"' . quasiClean($_POST["string1"]) . '"' .
            " is not an anagram of " .
            '"' . quasiClean($_POST["string2"]) . '"';
            setFormDanger($msg);
        }
    } else {
        $missingFieldMessage = "Please fill out both fields.";
    }
}

?>
<?php require_once "includes/header.php"?>
<?php require_once "includes/breadcrumbs.php"?>
  <div class="container d-flex flex-column mt-3">
  <h1 class="display-4 text-center">Anagramify</h1>
  <form action="<?php echo $_SERVER["PHP_SELF"] ?>"
        class="mb-3"
        method="POST"
        style="min-width: 300px;"
        >
    <div class="form-group <?php echo $formGroupClass ?>">
      <label
        class="form-control-label text-info"
        for="string1">
        Potential Anagram
      </label>
      <input
        class="form-control transparent-input <?php echo $formFieldClass ?>"
        type="text"
        name="string1"
        placeholder="Rail Safety"
        value=
        "<?php echo isset($_POST["string1"]) ? quasiClean($_POST["string1"]) : "" ?>"
      />
      <div class="<?php echo $feedbackClass ?>"><?php echo $fieldMessage ?></div>
        <?php if (!$hideHelperText): ?>
          <small
          class="form-text text-muted">
          Enter some text here.
          </small>
        <?php endif;?>
    </div>
    <div class="form-group <?php echo $formGroupClass ?>">
      <label
        class="form-control-label text-info"
        for="String 2">
        Potential Anagram
      </label>
      <input
        class="form-control transparent-input <?php echo $formFieldClass ?>"
        type="text"
        name="string2"
        placeholder="Fairy Tales"
        value=
        "<?php echo isset($_POST["string2"]) ? quasiClean($_POST["string2"]) : "" ?>"
      />
      <div class="<?php echo $feedbackClass ?>"><?php echo $fieldMessage ?></div>
        <?php if (!$hideHelperText): ?>
          <small
          class="form-text text-muted">
          Anything not text will be ignored.
          </small>
        <?php endif;?>
    </div>
    <br />
      <button
        class="btn btn-block btn-outline-info border border-info"
        name="submit"
        type="submit">
        CHECK FOR ANAGRAM MATCH
        </button>
        <button
          class="btn btn-block btn-outline-secondary border border-secondary"
          name="reset"
          type="submit">
          RESET INPUTS
        </button>
    <?php if ($missingFieldMessage !== "" && filter_has_var(INPUT_POST, "submit")): ?>
      <div class="alert alert-danger mt-3">
        <?php echo $missingFieldMessage; ?>
      </div>
    <?php endif;?>
    </div>
  </form>
<?php require_once "includes/footer.php"?>
