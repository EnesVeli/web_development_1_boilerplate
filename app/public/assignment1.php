<?php
// Initialize variables to hold form data and errors
$name = '';
$postalCode = '';
$language = '';
$options = [];
$remarks = '';
$errors = [];
$showResults = false;

// Check if the form was submitted via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // 1. Collect and Sanitize Data
    $name = htmlspecialchars(trim($_POST['name'] ?? ''));
    $postalCode = trim($_POST['postalcode'] ?? ''); // Don't sanitize yet, we need to check format
    $language = htmlspecialchars($_POST['language'] ?? '');
    $options = $_POST['options'] ?? []; // This will be an array if checkboxes are checked
    $remarks = htmlspecialchars(trim($_POST['remarks'] ?? ''));

    // 2. Validate Postal Code
    // Rule 1: Required
    if (empty($postalCode)) {
        $errors['postalcode'] = "Postal code is a required field.";
    } 
    // Rule 2: Format (4 numbers, space, 2 letters)
    // Regex explanation: ^ start, \d{4} four digits, space, [a-zA-Z]{2} two letters, $ end
    elseif (!preg_match('/^\d{4} [a-zA-Z]{2}$/', $postalCode)) {
        $errors['postalcode'] = "Invalid format. Use format: 1234 AB";
    }

    // If no errors, we can show the results
    if (empty($errors)) {
        $showResults = true;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assignment 1 Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" xintegrity="sha384-Zenh87qX5JnK2J10vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>
<body>
<div class="container">

    <?php if ($showResults): ?>
        <!-- RESULT VIEW -->
        <h1 class="pt-5">Form Results</h1>
        <div class="alert alert-success">
            <p><strong>Name:</strong> <?php echo $name; ?></p>
            <p><strong>Postal code:</strong> <?php echo htmlspecialchars($postalCode); ?></p>
            <p><strong>Chosen language:</strong> <?php echo $language; ?></p>
            
            <p><strong>Extra options:</strong> 
                <?php 
                // Checkboxes come in as an array. We join them with a comma.
                if (!empty($options)) {
                    echo implode(', ', array_map('htmlspecialchars', $options));
                } else {
                    echo "None selected";
                }
                ?>
            </p>
            
            <p><strong>Remarks:</strong><br>
                <?php 
                // Convert newlines (\n) to <br> tags
                echo nl2br($remarks); 
                ?>
            </p>
        </div>
        <a href="assignment1.php" class="btn btn-primary">Back to form</a>

    <?php else: ?>
        <!-- FORM VIEW -->
        <h1 class="pt-5">Assignment Form</h1>

        <form method="POST" action="assignment1.php">
            <br>
            
            <label>Full name: </label><br>
            <!-- We use 'value' to keep the input filled if there is an error (Sticky Form) -->
            <input type="text" name="name" placeholder="Full name" value="<?php echo $name; ?>" class="form-control w-50">
            <br>

            <label>Postal code: </label><br>
            <input type="text" name="postalcode" placeholder="1234 AB" value="<?php echo htmlspecialchars($postalCode); ?>" class="form-control w-25">
            <!-- Display Error Message for Postal Code -->
            <?php if (isset($errors['postalcode'])): ?>
                <div class="text-danger"><?php echo $errors['postalcode']; ?></div>
            <?php endif; ?>
            <br>

            <label>Preferred language: </label><br>
            <select name="language" class="form-select w-25">
                <option value="EN" <?php if($language == 'EN') echo 'selected'; ?>>English</option>
                <option value="NL" <?php if($language == 'NL') echo 'selected'; ?>>Dutch</option>
                <option value="DE" <?php if($language == 'DE') echo 'selected'; ?>>German</option>
                <option value="FR" <?php if($language == 'FR') echo 'selected'; ?>>French</option>
            </select>
            <br>

            <label>Extra options:</label><br>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="options[]" value="Vegetarian" id="veg" <?php if(in_array('Vegetarian', $options)) echo 'checked'; ?>>
                <label class="form-check-label" for="veg">Vegetarian</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="options[]" value="Gluten free" id="glut" <?php if(in_array('Gluten free', $options)) echo 'checked'; ?>>
                <label class="form-check-label" for="glut">Gluten free</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="options[]" value="Lactose free" id="lac" <?php if(in_array('Lactose free', $options)) echo 'checked'; ?>>
                <label class="form-check-label" for="lac">Lactose free</label>
            </div>
            <br>

            <label>Remarks:</label><br>
            <textarea name="remarks" cols="30" rows="5" class="form-control"><?php echo $remarks; ?></textarea>
            <br>

            <input type="submit" value="Submit" class="btn btn-primary">
        </form>
    <?php endif; ?>

</div>
</body>
</html>