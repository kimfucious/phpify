<?php
/**
 * Simple exercise to demonstrate how find the most used character in a string
 *
 * PHP version 7.2
 *
 * --- Directions
 * Given a string, return the character that is most
 * commonly used in the string.
 * --- Examples
 * maxChar("abcccccccd") === "c"
 * maxChar("apple 1231111") === "1"
 *
 * @category Education
 * @package  MaxCharify
 * @author   kimfucious <code@abts.io>
 * @license  https://www.gnu.org/licenses/gpl-3.0.txt GNU General Public License v3
 * @link     https://github.com/kimfucious/phpify.git
 */

session_start();
$_SESSION["page"] = "MaxChar";
require_once "includes/common_functions.php";

/**
 * Returns the most used character in a string
 *
 * @param string $str to be tested for maxChar
 *
 * @return string
 */
function maxChar($str)
{
    $arr = str_split($str);
    $charMap = [];
    $max = 0;
    $winner = "";
    $arr = array_count_values($arr);
    arsort($arr);
    reset($arr);
    return key($arr);
}

if (filter_has_var(INPUT_POST, "submit")) {
    $missingFieldMessage = "";
    $str1 = htmlspecialchars($_POST["string1"]);
    if (!empty($str1)) {
        $maxChar = maxChar($str1);
        $msg = "The character most used in the above field is '$maxChar'.";
        setFormSuccess($msg);
    } else {
        $msg = "Please put something in the field";
        setFormDanger($msg);
    }
}

?>
<?php require_once "includes/header.php"?>
<?php require_once "includes/breadcrumbs.php"?>
  <div class="container d-flex flex-column mt-3">
  <h1 class="display-4 text-center">MaxCharify</h1>
  <form action="<?php echo $_SERVER["PHP_SELF"] ?>"
        class="mb-3"
        method="POST"
        style="min-width: 300px;"
        >
    <div class="form-group <?php echo $formGroupClass ?>">
      <label class="form-control-label text-info" for="string1">Chars</label>
      <input
        class="form-control transparent-input <?php echo $formFieldClass ?>"
        type="text"
        name="string1"
        placeholder="Knowledge comes, but wisdom lingers."
        value="<?php echo isset($_POST["string1"]) ? htmlspecialchars($str1) : "" ?>"
      />
      <div class="<?php echo $feedbackClass ?>"><?php echo $fieldMessage ?></div>
        <?php if (!$hideHelperText): ?>
          <small
          class="form-text text-muted">
          Enter the arena! If you enter in weird stuff, you'll get some back ;^P
          </small>
        <?php endif;?>
    </div>
    <br />
      <button
        class="btn btn-block btn-outline-info border border-info"
        name="submit"
        type="submit">
        GET MAX CHAR
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