<?php
/**
 * Simple exercise to demonstrate how to reverse an integer, all things considered.
 *
 * PHP version 7.2
 *
 * - Directions
 * Given an integer, return an integer that is the reverse ordering of numbers.
 * - Examples
 * reverseInt(15) === 51
 * reverseInt(981) === 189
 * reverseInt(500) === 5
 * reverseInt(-15) === -51
 * reverseInt(-90) === -9
 *
 * @category Education
 * @package  ReverseIntify
 * @author   kimfucious <code@abts.io>
 * @license  https://www.gnu.org/licenses/gpl-3.0.txt GNU General Public License v3
 * @link     https://github.com/kimfucious/phpify.git
 */

session_start();
$_SESSION["page"] = "Reverse Integer";
require_once "includes/common_functions.php";
/**
 * Cleaning helper function
 *
 * @param string $str is to be stripped of all foul buggery and returned pristine
 *
 * @return string
 */
function cleanInt($str)
{
    $str = preg_replace("/[\D]/", "", $str);
    return $str;
}

/**
 *  This jammy-dodger reverses the order of an integer
 *
 * @param int $int shall be received and transformed, in all its glory, into the
 *                 upside-down world.  Where is Steve's hair when we need it?!
 *
 * @return int
 */
function reverseInt($int)
{
    $sign = ($int > 0) ? 1 : -1;
    $str = strrev(strval(abs($int)));
    return intval($str) * $sign;
}

if (filter_has_var(INPUT_POST, "submit")) {
    $str = filter_var($_POST["input_val"], FILTER_SANITIZE_NUMBER_INT);
    $sign = (intval($str >= 0)) ? 1 : -1;
    $str = cleanInt($str);
    $inRange = strlen($str) === strlen(strval(intval($str)));

    if (!empty($str)) {
        if (substr($str, 0, 1) === "0") {
            $msg = "Please don't start with a 0.";
            setFormDanger($msg);
        } elseif ($inRange) {
            $int = intval($str) * $sign;
            $reversedInt = reverseInt($int);
            $msg = "The reverse of the above integer is: '$reversedInt'";
            setFormSuccess($msg);
        } elseif (!$inRange) {
            $msg = "Min/Max values are -9223372036854775807 to 9223372036854775807";
            setFormDanger($msg);
        }
    } else {
        $msg = "Please put some numbers in this field.";
        setFormDanger($msg);
    }
}

if (array_key_exists("reset", $_POST)) {
    $_POST = array();
}

?>
<?php require_once "includes/header.php"?>
<?php require_once "includes/breadcrumbs.php"?>
  <div class="container d-flex flex-column mt-3">
  <h1 class="display-4 text-center">ReverseIntify</h1>
  <form action="<?php echo $_SERVER["PHP_SELF"] ?>"
        class="mb-3"
        method="POST"
        style="min-width: 300px;"
        >
    <div class="form-group <?php echo $formGroupClass ?>">
      <label class="form-control-label text-info" for="string1">
        Integer to be reversed
      </label>
      <input
        class="form-control transparent-input <?php echo $formFieldClass ?>"
        type="text"
        name="input_val"
        placeholder="Pure mathematics is, in its way, the poetry of logical ideas."
        value="<?php echo isset($_POST["input_val"]) ? $_POST["input_val"] : "" ?>"
      />
      <div class="<?php echo $feedbackClass ?>"><?php echo $fieldMessage ?></div>
        <?php if (!$hideHelperText): ?>
          <small
          class="form-text text-muted">
          Enter your number here.  Letters, dots, or otherwise sketchy
          characters need not apply.
          </small>
        <?php endif;?>
    </div>
    <br />
      <button
        class="btn btn-block btn-outline-info border border-info"
        name="submit"
        type="submit">
        GET REVERSE INTEGER
        </button>
        <button
          class="btn btn-block btn-outline-secondary border border-secondary"
          name="reset"
          type="submit">
          RESET INPUT
        </button>
    </div>
  </form>
<?php require_once "includes/footer.php"?>