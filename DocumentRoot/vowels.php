<?php
/**
 * Simple exercise to demonstrate how to detect vowels in a string
 *
 * PHP version 7.2
 *
 * Directions
 * Write a function that returns the number of vowels used in a string.
 * Vowels are the characters 'a', 'e', 'i', 'o', and 'u' (and sometime 'y')
 * Let's call Sesame Street, unless you're too young to remember the number!
 * Examples
 * vowels('Hi There!') --> 3
 * vowels('Why do you ask?') --> 4
 * vowels('Why?') --> 0
 *
 * @category Education
 * @package  Vowelify
 * @author   kimfucious <code@abts.io>
 * @license  https://www.gnu.org/licenses/gpl-3.0.txt GNU General Public License v3
 * @link     https://github.com/kimfucious/phpify.git
 */

session_start();
$_SESSION["page"] = "Vowels";
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
    return preg_replace("/[\W]/", "", $str);
}

/**
 * Partial cleaning helper function for displaying strings
 * Strips out nasty characters, leaves spaces
 *
 * @param string $str is to be cleaned and returned
 *
 * @return string
 */

if (filter_has_var(INPUT_POST, "submit")) {
    $str1 = cleanString($_POST["string1"]);
    if (!empty($str1)) {
        preg_match_all("/[aeiou]/im", $str1, $matches, PREG_SET_ORDER, 0);
        $vowels = count($matches);
        if ($vowels > 0) {
            $msg = ($vowels === 1)
            ? "There is " . $vowels . " vowel in the above text."
            : "There are " . $vowels . " vowels in the above text.";
            setFormSuccess($msg);
        } else {
            $msg = "The are no vowels in the above text.";
            setFormDanger($msg);
        }
    } else {
        $msg = "Please enter something in the field.";
        setFormDanger($msg);
    }
}

?>
<?php require_once "includes/header.php"?>
<?php require_once "includes/breadcrumbs.php"?>
  <div class="container d-flex flex-column mt-3">
  <h1 class="display-4 text-center">Vowelify</h1>
  <form action="<?php echo $_SERVER["PHP_SELF"] ?>"
        class="mb-3"
        method="POST"
        style="min-width: 300px;"
        >
    <div class="form-group <?php echo $formGroupClass ?>">
      <label
        class="form-control-label text-info"
        for="String 1">
        Gimme 'dem Vowels
      </label>
      <input
        class="form-control transparent-input <?php echo $formFieldClass ?>"
        type="text"
        name="string1"
        placeholder=
        "Brute animals have the vowel sounds; man only can utter consonants."
        value=
        "<?php echo isset($_POST["string1"]) ? quasiClean($_POST["string1"]) : "" ?>"
      />
      <div class="<?php echo $feedbackClass ?>"><?php echo $fieldMessage ?></div>
        <?php if (!$hideHelperText): ?>
          <small
          class="form-text text-muted">
          Enter in your gutteral utterances.  Let's see what the cards say, shall we?
          </small>
        <?php endif;?>
    </div>
    <br />
      <button
        class="btn btn-block btn-outline-info border border-info"
        name="submit"
        type="submit">
        CHECK FOR VOWELS
        </button>
        <button
          class="btn btn-block btn-outline-secondary border border-secondary"
          name="reset"
          type="submit">
          RESET INPUT
        </button>
      </div>
    </div>
  </form>
<?php require_once "includes/footer.php"?>
