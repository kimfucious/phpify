<?php
/**
 * Simple exercise to demonstrate how to capitalize all words in a string.
 *
 * PHP Version 5.6
 *
 *  Directions
 *  Write a function that accepts a string. The function should capitalize the
 *  first letter of each word in the string then return the capitalized string.
 *  Examples
 *  capitalize('a short sentence') --> 'A Short Sentence'
 *  capitalize('a lazy fox') --> 'A Lazy Fox'
 *  capitalize('look, it is working!') --> 'Look, It Is Working!'
 *
 * @category Education
 * @package  Capitalizeify
 * @author   kimfucious <code@abts.io>
 * @license  https://www.gnu.org/licenses/gpl-3.0.txt GNU General Public License v3
 * @link     https://github.com/kimfucious/phpify.git
 */

session_start();
$_SESSION["page"] = "Capitalize";
require_once "includes/common_functions.php";

if (filter_has_var(INPUT_POST, "submit")) {
    $str1 = htmlspecialchars($_POST["string1"]);
    if (!empty($str1)) {
        $str1 = ucwords($str1);
        $msg = "Dinner is served.";
        setFormSuccess($msg);
    } else {
        $msg = "Please enter something in the field.";
        setFormDanger($msg);
    }
}

?>
<?php require_once "includes/header.php"?>
<?php require_once "includes/breadcrumbs.php"?>
  <div class="container d-flex flex-column mt-3">
  <h1 class="display-4 text-center">Capitalizeify</h1>
  <form action="<?php echo $_SERVER["PHP_SELF"] ?>"
        class="mb-3"
        method="POST"
        style="min-width: 300px;"
        >
    <div class="form-group <?php echo $formGroupClass ?>">
      <label
        class="form-control-label text-info"
        for="string1">
        Words to capitalize
      </label>
      <input
        class="form-control transparent-input <?php echo $formFieldClass ?>"
        type="text"
        name="string1"
        placeholder="We'll do all right if we can capitalize on our mistakes."
        value=
        "<?php echo isset($_POST["string1"]) ? $str1 : "" ?>"
      />
      <div class="<?php echo $feedbackClass ?>"><?php echo $fieldMessage ?></div>
        <?php if (!$hideHelperText): ?>
          <small
          class="form-text text-muted">
          Enter in some text to be capitalized.
          </small>
        <?php endif;?>
    </div>
    <br />
      <button
        class="btn btn-block btn-outline-info border border-info"
        name="submit"
        type="submit">
        CAPITALIZE
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
