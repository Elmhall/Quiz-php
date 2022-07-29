<?php

if (isset($_POST['name']) && isset($_POST['email'])){
     $nameValidate = preg_match("/^[a-zA-Z-' ]*$/", $_POST['name']);
     $emailValidate = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);

    if ($nameValidate && $emailValidate) {
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['name'] = $_POST['name'];

        header('location: ./result.php?quiz=' . $_GET['quiz']);

    }
}



echo '<form action="quiz.php?quiz=' . $_GET['quiz'] . '" method="post">';
echo '<input type="number" name="last_page" value="' . $current_page . '" hidden>';
if (isset($emailValidate) && !$emailValidate) echo '<div class="alert alert-danger" role="alert">Please enter a valid email</div>';
echo '<div class="form-group"><label for="email">Email address</label>';
echo '<input name="email" type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email" onchange="validate(this, `email`)">';
echo '</div>';
if (isset($nameValidate) && !$nameValidate) echo '<div class="alert alert-danger" role="alert">Please enter a valid name</div>';
echo '<div class="form-group"><label for="name">Name</label >';
echo '<input name="name" type="text" class="form-control" id="name" placeholder="Enter Name" onchange="validate(this, `name`)">';
echo '</div > ';
echo '<input type="submit" name="action" class="btn btn-secondary" value="Previous">';
echo '<input type="submit" name="action" class="btn btn-primary" value="Submit">';
echo '</form > ';


?>

<script>
    function validate(element, type) {
        var regEx = {
            name: /^[a-zA-Z\s]*$/g,
            email: /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/
        }

        let correctInput = regEx[type].test(element.value);
        let hasErrorClass = element.classList.contains("is-invalid")
        var shouldAdd = (!correctInput && !hasErrorClass);
        var shouldRemove = (correctInput && hasErrorClass);

        if (shouldAdd || shouldRemove) element.classList.toggle("is-invalid");


    }
</script>
